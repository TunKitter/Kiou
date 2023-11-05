<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;

class RevisionController extends Controller
{
    public $interval_time = [0, 600000, 3600000, 18000000, 86400000, 604800000, 2505600000, 5011200000, 12528000000];

    public function bookmark()
    {
        $bookmarks = (Bookmark::where('user_id', auth()->user()->id)->get());
        $result = [];
        foreach ($bookmarks as $bookmark) {
            $result[$bookmark->lesson->course->name][] = [$bookmark->lesson->name, $bookmark->cards];
        }
        // dd($result);
        return view('client.revision.bookmark', compact('bookmarks', 'result'));
    }
    public function all()
    {
        return view('client.revision.all', ['bookmarks' => Bookmark::where('user_id', auth()->user()->id)->get()]);
    }
    public function revise()
    {

        $bookmarks = (Bookmark::where([['user_id', auth()->user()->id], ['cards.repetition.interval', '<', strval(round(microtime(true) * 1000))]])->get());
        // dd(strval(round(microtime(true) * 1000)));
        // dd($bookmarks);
        $arr_cards = '';
        $lesson = '';
        $courses = '';
        $bookmarks_id = '';
        $arr_index = '';
        $index = 0;
        foreach ($bookmarks as $bookmark) {
            $temp_bookmark = $bookmark->_id;
            $index2 = 0;
            foreach ($bookmark->cards as $value) {
                if ($value['repetition']['interval'] < "" . round(microtime(true) * 1000) . "") {
                    $arr_cards .= '["' . $value['front_card'] . '","' . $value['back_card'] . '"],';
                    $lesson .= '"' . $bookmark->lesson->name . '",';
                    $bookmarks_id .= '"' . $temp_bookmark . '_' . $index2 . '",';
                    $courses .= '"' . $bookmark->lesson->course->name . '",';
                    $arr_index .= $value['repetition']['index'] . ',';
                    $index2++;
                }
            }

        }
        // dd($arr_cards);
        $arr_cards = (\rtrim($arr_cards, ','));
        // dd($bookmarks_id);
        $lesson = (\rtrim($lesson, ','));
        $courses = (\rtrim($courses, ','));
        $arr_index = (\rtrim($arr_index, ','));
        // dd(rtrim($arr_index, ','));
        return view('client.revision.revise', compact('arr_cards', 'arr_index', 'lesson', 'courses', 'bookmarks_id'));
    }
    public function updateRevise()
    {
        // $bookmarks = (Bookmark::where('user_id', auth()->user()->id)->where('')->get());

        $demo = [];
        $ids = request()->ids;
        $ids = trim($ids, "[]");
        $data = request()->data;
        $data = trim($data, "[]");
        $data = explode(',', $data);
        $ids_change = request()->ids_change;
        $ids_change = trim($ids_change, "[]");
        $ids_change = explode(',', $ids_change);
        $bb = [];
        array_map(function ($value) use (&$bb, &$demo) {
            $temp = explode("_", $value);
            $bb[] = ltrim($temp[0], '"');
            $demo[] = rtrim($temp[1], '"');
        }, explode(',', $ids));
        $database = Bookmark::whereIn('_id', $bb)->get()->pluck('cards', '_id')->toArray();
        $database2 = [];
        $index = 0;
        array_map(function ($value) use (&$database2, &$index, &$demo, &$bb, $database, $data, $ids_change) {
            $database2[$bb[$index]][] = [$database[$bb[$index]][$demo[$index]]['repetition']['interval']];
            // if ($index == 0) {
            Bookmark::where('_id', $bb[$index])->update(['cards.' . $demo[$index] . '.repetition.interval' => $data[$index], 'cards.' . $demo[$index] . '.repetition.index' => $ids_change[$index]]);
            // }
            $index++;
        }, $bb);
        return \response()->json(['time_interval' => $data, 'data' => $database2, 'bb' => $bb, 'demo' => $demo, 'index' => $index]);
    }
}
