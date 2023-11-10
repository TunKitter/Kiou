<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Category;
use App\Models\Level;
use App\Models\Mentor;
use App\Models\MentorAssignment;
use App\Models\Profession;
use App\Models\UserAssignment;
use App\Models\UserSkill;
use Illuminate\Support\Facades\Storage;

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
                }
                $index2++;
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
    public function test()
    {
        $user_skills = UserSkill::where('user_id', auth()->user()->id)->get();
        // dd($user_skills);
        $categories = Category::select(['name', 'profession_id', 'slug'])->whereIn('_id', ($user_skills->pluck('category_id')))->get();
        $categories_id = ($categories->pluck('profession_id', '_id'));
        $categories_slug = ($categories->pluck('slug', '_id'));
        $professions = Profession::select('name')->whereIn('_id', $categories->pluck('profession_id'))->get()->pluck('name', '_id');
        $categories = $categories->pluck('name', '_id');
        return view('client.revision.test', compact('user_skills', 'categories', 'professions', 'categories_id', 'categories_slug'));
    }
    public function testCheck($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $user_skill = UserSkill::where('user_id', auth()->user()->id)->where('category_id', $category->_id)->first();
        return view('client.revision.test_check', compact('category', 'user_skill'));
    }
    public function updateTestCheck($slug)
    {
        $aa = \json_decode(request()->data);
        foreach ($aa as $key => $value) {
            UserSkill::where('_id', $key)->update(['infor' => $value]);
        }
        return \response()->json([
            'status' => $aa,
        ]);
    }
    public function code(string $id)
    {
        $mentor_assignment = (MentorAssignment::where('_id', $id)->first());
        $user_asm = (UserAssignment::where('user_id', auth()->user()->_id)->where('assignment_id', $id)->first());
        if ($user_asm->code_path) {
            $user_asm_code = Storage::disk('local')->get('user_code/' . $user_asm->code_path);
        } else {
            $user_asm_code = '';
            $user_asm->code_path = uniqid() . '.js';
            $user_asm->state = 0;
            $user_asm->save();
        }
        if ($user_asm_code) {
            $mentor_assignment_code = $user_asm_code;
        } else {
            $mentor_assignment_code = (Storage::disk('local')->get('mentor_code/' . $mentor_assignment->code_path));
        }
        if (!$mentor_assignment) {
            return view('client.errors.unrole', ['msg' => 'Can not find any mentor assignment!']);
        }
        if ($user_asm->count() == 0) {
            return view('client.errors.unrole', ['msg' => 'Can not find any user assignment!']);
        }

        $conditions = '{';
        $condition_code_array = $mentor_assignment->condition_code;
        foreach ($condition_code_array as $key => $value) {
            $conditions .= $key . ':"' . $value . '",';
        }
        $conditions .= '}';
        $mentor_name = Mentor::find($mentor_assignment->mentor_id)->name;
        return view('client.revision.code', compact('mentor_assignment', 'conditions', 'mentor_name', 'user_asm', 'mentor_assignment_code'));
    }
    public function codeUpdate($id)
    {
        $user = MentorAssignment::find($id)->category_id;
        $user = UserSkill::where('category_id', $user)->where('user_id', auth()->user()->id)->increment('infor.2', 2);
        UserAssignment::where('user_id', auth()->user()->_id)->where('assignment_id', $id)->update(['state' => '1']);
        return response()->json(['status' => $user]);
    }
    public function codeList()
    {
        $user_asm = (UserAssignment::where('user_id', auth()->user()->_id)->get());
        $mentor_asm = (MentorAssignment::whereIn('_id', $user_asm->pluck('assignment_id'))->get());
        $category_asm = (Category::select('name')->whereIn('_id', $mentor_asm->pluck('category_id'))->get()->pluck('name', '_id'));
        $mentor_info = (Mentor::select('name')->whereIn('_id', $mentor_asm->pluck('mentor_id'))->get()->pluck('name', '_id'));
        $level_asm = Level::all()->pluck('name', '_id');
        return view('client.revision.code_list', compact('user_asm', 'mentor_asm', 'mentor_info', 'category_asm', 'level_asm'));
    }
    public function saveCode()
    {
        // (Storage::disk('local')->get('mentor_code/demo.js'));
        // Storage::disk('local')->put('user_code', 'Hello This is Tunkit', 'demo.js');
        request()->code->storeAs('user_code', request()->code_name);
        return response()->json(['status' => request()->all()]);
    }
}
