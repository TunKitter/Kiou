<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Profession;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function list()
    {
        return view('client.courses.course-list', ['courses' => $this->getCourseData()]);
    }
    public function load_ajax(Request $request)
    {
        $courses = (Course::orderBy('complete_course_rate', 'desc')->orderBy('user_attract_rate', 'desc')->orderBy('total_enrollment', 'desc')->skip($request->page)->take(10)->get());
        $a_length = count($courses) - 1;
        for ($i = 0; $i < $a_length; $i++) {
            $temp_i = $courses[$i];
            for ($j = $i + 1; $j < $a_length; $j++) {
                $temp_j = $courses[$j];
                if ((($temp_i->complete_course_rate * 2) + ($temp_i->user_attract_rate * 1.3) + ($temp_i->total_enrollment)) < ($temp_j->complete_course_rate * 2) + ($temp_j->user_attract_rate * 1.3) + ($temp_j->total_enrollment)) {
                    $temp = $courses[$i];
                    $courses[$i] = $courses[$j];
                    $courses[$j] = $temp;
                }
            }
        }

    }
    public function getCourseData($skip = 0, $take = 10)
    {
        $courses = (Course::orderBy('complete_course_rate', 'desc')->orderBy('user_attract_rate', 'desc')->orderBy('total_enrollment', 'desc')->skip($skip)->take($take)->get());
        $a_length = count($courses) - 1;
        // for ($i = 0; $i < $a_length; $i++) {
        // $temp_i = $courses[$i];
        // $temp_i = ($temp_i->user_attract_rate * 1.3) + ($temp_i->total_enrollment) / (($temp_i->meta['total_lesson'] == $temp_i->complete_course_rate) ? 1 : $temp_i->meta['total_lesson'] - $temp_i->complete_course_rate);
        // for ($j = 0; $j < $a_length - $i; $j++) {
        // $temp_j = $courses[$j];
        // if (($temp_i) > ($temp_j->user_attract_rate * 1.3) + ($temp_j->total_enrollment) / (($temp_j->meta['total_lesson'] == $temp_j->complete_course_rate) ? 1 : $temp_j->meta['total_lesson'] - $temp_j->complete_course_rate)) {
        // $temp = $courses[$j];
        // $courses[$j] = $courses[$j + 1];
        // $courses[$j + 1] = $temp;
        // }
        // }
        // }
        return $courses;
    }
    public function detail(string $id)
    {
        return view('client.courses.course-details');
    }
    public function learn(string $id)
    {
        return view('client.courses.course-learn');
    }
    public function explore($id = null)
    {
        $profession_name = Profession::where('slug', $id)->first();
        $profession_name ? $profession_name = $profession_name->name : redirect()->route('course-explore');
        return view('client.courses.course-explore', $profession_name ? ['id' => $profession_name] : []);
    }
}
