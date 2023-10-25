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
        $enrollment = (Enrollment::where([['user_id', auth()->user()->id], ['course_id', $id_course]])->first());
        if (!$enrollment) {
            return redirect()->route('course-detail', Course::where('_id', $id_course)->first()->slug);
        }
        $id_lesson_url = (Lesson::where('_id', $id_lesson)->first());
        $check_enrollment_lesson = (Lesson::where('_id', $enrollment->lesson_id)->first());
        if ($id_lesson_url->_id != $check_enrollment_lesson->_id) {
            if ($id_lesson_url->chapter[2] > $check_enrollment_lesson->chapter[2]) {
                return redirect()->route('lesson-learn', [$id_course, $check_enrollment_lesson->_id]);
            }
        }
        $bookmarks = Bookmark::where([['lesson_id', $id_lesson], ['user_id', auth()->user()->id]])->first();
        if ($bookmarks) {
            $bookmarks = $bookmarks->cards;
        } else {
            $bookmarks = [];
        }
        $chapters = (Chapter::where('course_id', $id_course)->first());
        // \dd(Lesson::where('chapter.0', '6522a0e3b9d4267db4cdf185')->get())
        $lessons = (Lesson::where('chapter.0', $chapters->_id)->orderBy('chapter.2')->get(['name', 'chapter', 'path']))->toArray();
        $chapters = ($chapters->infor);
        // dd($lessons['_id']);
        $path = ((array_filter($lessons, function ($e) use ($id_lesson) {
            return $e['_id'] == $id_lesson;
        })));
        $path = $path[array_key_first($path)]['path'];
        // dd($lessons);
        // usort($bookmarks, function ($a, $b) {
        // return $a['timeline'] - $b['timeline'];
        // });
        return view('client.lesson.course-learn', compact('bookmarks', 'chapters', 'lessons', 'path', 'id_lesson', 'id_lesson_url', 'id_course', 'check_enrollment_lesson'));
    }
    public function addBookmark(Request $request, string $id)
    {
        $bookmarks = Bookmark::where([['lesson_id', $id], ['user_id', auth()->user()->id]])->first();
        if ($bookmarks) {
            $bookmarks->push('cards', [
                'front_card' => $request->front_card,
                'back_card' => $request->back_card,
                'timeline' => $request->timeline,
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
        return response()->json([
            'status' => route('lesson-learn', [$id_course, request()->next_lesson]),
        ]);
    }
}