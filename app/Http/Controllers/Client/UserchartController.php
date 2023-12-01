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
}
