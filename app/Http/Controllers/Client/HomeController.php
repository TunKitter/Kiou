<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Mentor;
use App\Models\Roadmap;
use App\Models\Notification;
use App\Models\Profession;

class HomeController extends Controller
{
    public function index()
    {

        $MentorCount = Mentor::count();
        $CourseCount = Course::count();

        $RoadmapCount = Roadmap::count();

        $EnrollmentCount = Enrollment::where('state', '65347ec024cfaf917eaad1b1')->count();

        $courses = (Course::orderBy('complete_course_rate', 'desc')->orderBy('view', 'desc')->orderBy('click', 'desc')->orderBy('total_enrollment', 'desc')->skip(0)->take(10)->get());
        $courses = $this->softData($courses, count($courses) - 1);

        // dd($courses);
        $buylot = Course::where([])
            ->orderBy('total_enrollment', 'desc')
            ->take(10)
            ->get();

      if (!empty(auth()->user()->mentor->_id)){
            $notications = Notification::where('mentor_id',auth()->user()->mentor->_id)->orderBy('created_at', 'desc')->get();
      }else{
        $notications = [];
      }
       
        return view('client.home.home', compact('CourseCount', 'MentorCount', 'RoadmapCount', 'EnrollmentCount', 'buylot', 'courses', 'notications'));
    }

    public function softData($courses, $a_length)
    {
        for ($i = 0; $i <= $a_length; $i++) {
            $courses[$i]->mentor_name = $courses[$i]->mentor->name;
            for ($j = 0; $j < $a_length - $i; $j++) {
                $temp_j = $courses[$j];
                $temp_j_2 = $courses[$j + 1];
                if ($temp_j->complete_course_rate + (1 / (($temp_j->view - $temp_j->click) <= 0 ? 1 : $temp_j->view - $temp_j->click)) + (($temp_j->total_enrollment <= 0) ? 0 : $temp_j->total_enrollment / 2) < $temp_j_2->complete_course_rate + (1 / (($temp_j_2->view - $temp_j_2->click) <= 0 ? 1 : $temp_j_2->view - $temp_j_2->click)) + (($temp_j_2->total_enrollment <= 0) ? 0 : $temp_j_2->total_enrollment / 2)) {
                    $temp = $courses[$j];
                    $courses[$j] = $courses[$j + 1];
                    $courses[$j + 1] = $temp;
                }
            }
        }

        return $courses;

    }

}
