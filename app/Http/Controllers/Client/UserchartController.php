<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profession;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\UserSkill;


class UserchartController extends Controller
{
    public function index()
    {
        $user_skills = UserSkill::where('user_id', auth()->user()->_id)->get();
        // dd(count($user_skills));
        $count_data = count($user_skills);
        $category_skills = Category::all();

        $user = Auth::user();
        $professions = Profession::all();
        // dd( $professions);
        // dd($user->toArray()['profession']);
        $user_professions = array_map(function ($profession_id) use ($professions) {
            return array_filter($professions->toArray(), function ($profession) use ($profession_id) {
                return $profession['_id'] == $profession_id;
            });
        }, $user->toArray()['profession']);
        $user_professions = implode(',', array_map(function ($profession) {
            return $profession[array_key_first($profession)]['name'];
        }, $user_professions));

        return view('client.profile.user-chart', compact('user_skills', 'user', 'professions', 'user_professions', 'category_skills'));
    }

    public function tableCategory()
    {
        $categorys = Category::groupBy('profession_id')->get();
        for ($i = 0; $i < count($categorys); $i++) {
            $array_profession[] =  $categorys[$i]->profession_id;
        };
        $professions_categorys = Profession::whereIn('_id', $array_profession)->get();
        // dd($professions_categorys);

        $user = Auth::user();
        $professions = Profession::all();
        $user_professions = array_map(function ($profession_id) use ($professions) {
            return array_filter($professions->toArray(), function ($profession) use ($profession_id) {
                return $profession['_id'] == $profession_id;
            });
        }, $user->toArray()['profession']);
        $user_professions = implode(',', array_map(function ($profession) {
            return $profession[array_key_first($profession)]['name'];
        }, $user_professions));

        return view('client.profile.table-category', compact('categorys', 'user', 'professions', 'user_professions', 'professions_categorys'));
    }
    public function postTableCategory(Request $request, $slug)
    {
        $professions_categorys = Profession::where('slug',  $slug)->get();
        $user_skills = UserSkill::where('user_id', auth()->user()->_id)->get();
        $categorys = Category::where('profession_id', $professions_categorys[0]->_id)->get();
        $count_data = count($user_skills);
        if (count($user_skills) != 0) {
            for ($i = 0; $i < $count_data; $i++) {
                $array_data[] = $user_skills[$i]->category_id;
            }
        }else{
            $array_data[] = 0;
        }
        // dd($array_data);
        foreach ($categorys as $category) {
            if (in_array($category->_id, $array_data)) {
                $user_skill_cate[] = UserSkill::where('user_id', auth()->user()->_id)
                    ->where('category_id', $category->_id)
                    ->get();
            }
        }
        if (empty($user_skill_cate)) {
            $user_skill_cate = 0;
        }
        $user = Auth::user();
        $professions = Profession::all();
        $user_professions = array_map(function ($profession_id) use ($professions) {
            return array_filter($professions->toArray(), function ($profession) use ($profession_id) {
                return $profession['_id'] == $profession_id;
            });
        }, $user->toArray()['profession']);
        $user_professions = implode(',', array_map(function ($profession) {
            return $profession[array_key_first($profession)]['name'];
        }, $user_professions));

        return view('client.profile.user-chart-detail', compact('user', 'professions', 'user_professions', 'categorys', 'user_skills', 'user_skill_cate', 'array_data'));
    }
}
