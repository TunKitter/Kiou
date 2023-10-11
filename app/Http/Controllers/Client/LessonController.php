<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(string $id)
    {
        $bookmarks = Bookmark::where('lesson_id', '6522a000b9d4267db4cdf182')->first()->cards;
        usort($bookmarks, function ($a, $b) {
            return $a['timeline'] - $b['timeline'];
        });
        return view('client.lesson.course-learn', compact('bookmarks'));
    }
    public function addBookmark(Request $request)
    {
        Bookmark::find('6521649a95f9cadaf2e410fa')->push('cards', [
            'front_card' => $request->front_card,
            'back_card' => $request->back_card,
            'timeline' => $request->timeline,
        ]);
        return \response()->json([
            'status' => 'success',
            'message' => 'Add bookmark successfully',
        ]);
    }

}
