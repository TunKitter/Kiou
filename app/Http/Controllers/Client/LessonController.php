<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(string $id_course, string $id_lesson)
    {
        $id_course = Course::where('slug', $id_course)->first();
        if (!$id_course) {
            return redirect('/course/nothing-course');
        }
        $enrollment = (Enrollment::where([['user_id', auth()->user()->id], ['course_id', $id_course->id]])->first());
        if (!$enrollment) {
            return redirect('/course/not-found-user-course');
        }
        $id_lesson = Lesson::where('slug', $id_lesson)->first();
        if (!$id_lesson) {
            return redirect('/course/nothing-lesson');
        }
        $check_enrollment_lesson = (Lesson::where('_id', $enrollment->lesson_id)->first());
        if ($id_lesson->_id != $check_enrollment_lesson->_id) {
            // dd($id_lesson->chapter[2], $check_enrollment_lesson->chapter[2]);
            if ($id_lesson->chapter[2] > $check_enrollment_lesson->chapter[2]) {
                return redirect()->route('lesson-learn', [$id_course->slug, $check_enrollment_lesson->slug]);
            }
        }
        $bookmarks = Bookmark::where([['lesson_id', $id_lesson->id], ['user_id', auth()->user()->id]])->first();
        if ($bookmarks) {
            $bookmarks = $bookmarks->cards;
        } else {
            $bookmarks = [];
        }
        $chapters = (Chapter::where('course_id', $id_course->id)->first());
        // \dd(Lesson::where('chapter.0', '6522a0e3b9d4267db4cdf185')->get())
        $lessons = (Lesson::where('chapter.0', $chapters->_id)->orderBy('chapter.2')->get(['name', 'chapter', 'path', 'slug']))->toArray();
        $chapters = ($chapters->infor);
        // dd($lessons['_id']);
        $path = ((array_filter($lessons, function ($e) use ($id_lesson) {
            return $e['_id'] == $id_lesson->id;
        })));
        $path = $path[array_key_first($path)]['path'];
        // dd($lessons);
        // usort($bookmarks, function ($a, $b) {
        // return $a['timeline'] - $b['timeline'];
        // });
        return view('client.lesson.course-learn', compact('bookmarks', 'chapters', 'lessons', 'path', 'id_lesson', 'id_course', 'check_enrollment_lesson'));
    }
    public function addBookmark(Request $request, string $id)
    {
        $bookmarks = Bookmark::where([['lesson_id', $id], ['user_id', auth()->user()->id]])->first();
        if ($bookmarks) {
            $bookmarks->push('cards', [
                'front_card' => $request->front_card,
                'back_card' => $request->back_card,
                'timeline' => $request->timeline,
                'repetition' => ["interval" => strval(round(microtime(true) * 1000)), 'index' => '0'],
            ]);
        } else {
            Bookmark::create([
                'lesson_id' => $id,
                'user_id' => auth()->user()->id,
                'cards' => [
                    [
                        'front_card' => $request->front_card,
                        'back_card' => $request->back_card,
                        'timeline' => $request->timeline,
                        'repetition' => ["interval" => strval(round(microtime(true) * 1000)), 'index' => '0'],
                    ],
                ],
            ]);
        }
        return \response()->json([
            'status' => 'success',
            'message' => 'Add bookmark successfully',
        ]);
    }
    public function deleteBookmark(Request $request, string $id)
    {
        $bookmarks = Bookmark::where([['lesson_id', $id], ['user_id', auth()->user()->id]])->first()->cards;
        array_map(function ($bookmark) use ($request, $id) {
            if ($bookmark['timeline'] == $request->timeline) {
                Bookmark::where([['lesson_id', $id], ['user_id', auth()->user()->id]])->first()->pull('cards', $bookmark);
            }
        }, $bookmarks);
        return response()->json([
            'status' => 'success',
            'message' => 'Delete bookmark successfully',
        ]);
    }
    public function updateBookmark(Request $request, string $id)
    {
        $bookmarks = Bookmark::where([['lesson_id', $id], ['user_id', auth()->user()->id]])->first()->cards;
        array_map(function ($bookmark) use ($request, $id) {
            if ($bookmark['timeline'] == $request->timeline) {
                Bookmark::where([['lesson_id', $id], ['user_id', auth()->user()->id]])->first()->pull('cards', $bookmark);
                Bookmark::where([['lesson_id', $id], ['user_id', auth()->user()->id]])->first()->push('cards', [
                    'front_card' => $request->front_card,
                    'back_card' => $request->back_card,
                    'timeline' => $request->timeline,
                    'repetition' => ["interval" => strval(round(microtime(true) * 1000)), 'index' => '0'],
                ]);
            }
        }, $bookmarks);
        return response()->json([
            'status' => 'success',
            'message' => 'Delete bookmark successfully',
        ]);
    }
    public function lessonUpdate(string $id_course, string $id_lesson)
    {
        Enrollment::where([['course_id', $id_course], ['user_id', auth()->user()->id]])->first()->update([
            'lesson_id' => request()->next_lesson,
        ]);
        $id_course = Course::where('_id', $id_course)->first()->slug;
        $id_lesson = Lesson::where('_id', request()->next_lesson)->first()->slug;
        return response()->json([
            'status' => route('lesson-learn', [$id_course, $id_lesson]),
        ]);
    }
    public function getLessonData()
    {
        return response()->json([
            'result' => Lesson::where('name', 'like', '%' . request()->name . '%')->where('allow_buy_seperate', true)->with('course')->get(),
            'name' => \request()->name,
        ]);
    }
    public function editInteractive($lesson_slug)
    {
        $lesson = Lesson::where('slug', $lesson_slug)->first();
        return view('client.mentor.update_interactive_lesson', compact('lesson'));
    }
}
