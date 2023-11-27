<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\Lesson;
class MyCoursesController extends Controller
{
    public function index(){

        $user = Auth::user();

        $myUser = auth()->user()->profession;

        $myCourses = Enrollment::where('user_id', $user->_id)->where('state','65347ec024cfaf917eaad1b1')->get();

        $Courses = Course::whereIn('_id', $myCourses->pluck('course_id'))->get();
        $lessons=  Lesson::whereIn('_id',($myCourses->pluck('lesson_id')))->get()->pluck('slug','course_id');

        return view('client.profile.mycourses',compact('user','Courses','lessons'));
    }
    
}
