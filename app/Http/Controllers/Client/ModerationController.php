<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;


class ModerationController extends Controller
{
    public function index(Request $request)
    {
        // dd(count(auth()->user()->role));
        $user_id = auth()->user()->_id;
        $users = User::where('_id', $user_id)->first();
        $course_list = Course::whereIn('state', ["0", "-1"])->get();//Nhứng khóa học chưa được kiểm duyệt và đang kiểm duyệt;
        foreach ($course_list as $course){
            $test = false;
            if( $course->user_id == $user_id){
                 $test = true;
            }
        }
    
        foreach ($users->role as $role){
            $check_role = false;
            if($role == '65531d75139d10c7eb364114'){
                $check_role = true;
            }
        }
        
        if($check_role && $test){
            $course_lists = Course::where([
                ['user_id', $user_id],
            ])
            ->whereIn('state', ["0", "-1"])
            ->get();
          return view('client.moderation.moderation', compact('course_lists'));
        }
    }
}
