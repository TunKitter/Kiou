<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Mentor;
use App\Models\Roadmap;
use App\Models\Profession;
use DB;

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

        
        $top10Professions = Course::select(['category'])->get()->toArray();
        $top10ProfessionsResult = [];
        foreach($top10Professions as $key => $value) {
            $top10ProfessionsResult[$value['category']]['quantity'] = (isset($top10ProfessionsResult[$value['category']]['quantity'])) ? $top10ProfessionsResult[$value['category']]['quantity']+=1 : 1; 
/*
  */       }
        $profession_name = (Profession::whereIn('_id',array_keys($top10ProfessionsResult))->get()->pluck('name','_id' ));
        $top10Mentors = Mentor::raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$lookup' => [
                        'from' => 'courses',
                        'localField' => '_id',
                        'foreignField' => 'mentor_id',
                        'as' => 'courses',
                    ],
                ],
                [
                    '$unwind' => '$profession', // Giải mảng profession để tiếp tục liên kết
                ],
                [
                    '$lookup' => [
                        'from' => 'professions',
                        'localField' => 'profession',
                        'foreignField' => '_id',
                        'as' => 'profession_info',
                    ],
                ],
                [
                    '$project' => [
                        'name' => 1,
                        'image' => '$image',
                        // 'profession' => '$profession'
                    ],
                ],
                [
                    '$limit' => 10,
                ],
            ]);
        });
        // Top 10 excellent mentors
        $total_enrollment_mentor =  Course::raw(function ($collection) {
            return $collection->aggregate([
                ['$group' => [
                    '_id' => '$mentor_id',
                    'total_enrollment' => ['$sum' => '$total_enrollment'],
                ]],
                ['$sort' => ['total_enrollment' => -1]],
                ['$limit' => 10,],
            ]);
        });
        // dd( $total_enrollment_mentor);
        $total_enrollment_mentor = $total_enrollment_mentor->pluck('total_enrollment', '_id')->toArray();
        // dd($top10Mentors);
        // dd(( ));
        $mentor_name = Mentor::whereIn('_id',array_unique($top10Mentors->pluck('_id')->toArray()))->pluck('profession','_id');
        $professions = Profession::all()->pluck('name', '_id');

        // dd($profession);

        return view('client.home.home', compact('CourseCount', 'MentorCount', 'RoadmapCount', 'EnrollmentCount', 'buylot', 'courses', 'top10Mentors', 'total_enrollment_mentor', 'mentor_name', 'professions','top10ProfessionsResult','profession_name'));
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
