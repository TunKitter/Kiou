<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Chapter;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(string $id_course, string $id_lesson)
    {
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
        }))[0]['path']);
        // dd($lessons);
        // usort($bookmarks, function ($a, $b) {
        // return $a['timeline'] - $b['timeline'];
        // });
        return view('client.lesson.course-learn', compact('bookmarks', 'chapters', 'lessons', 'path', 'id_lesson'));
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
}
