<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Mentor;
use App\Models\Profession;
use App\Models\Roadmap;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $mentor_with_total_enrollment_and_avatar = Cache::get('mentor_with_total_enrollment_and_avatar');
        $professions_name = Cache::get('professions_name');
        $total_course = Cache::get('total_course');
        $total_mentor = Cache::get('total_mentor');
        $total_roadmap = Cache::get('total_roadmap');
        $total_enrollment = Cache::get('total_enrollment');
        $top10_profession = Cache::get('top10_profession');
        return view('client.home.home', compact('total_course', 'total_mentor', 'total_roadmap', 'total_enrollment', 'mentor_with_total_enrollment_and_avatar', 'professions_name', 'top10_profession'));
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
    public function getInfor($type)
    {
        switch ($type) {
            case 'course':
                {
                    return response()->json([
                        'data' => Course::count(),
                    ]);
                    break;

                }
            case 'mentor':{
                    return response()->json([
                        'data' => Mentor::count(),
                    ]);
                    break;
                }
            case 'roadmap':{
                    return response()->json([
                        'data' => Roadmap::count(),
                    ]);
                    break;
                }
            case 'enrollment':{
                    return response()->json([
                        'data' => Course::sum('total_enrollment'),
                    ]);
                    break;
                }
            case 'top10Profession':{
                    $top10Professions = Course::select(['category'])->get()->toArray();
                    $top10ProfessionsResult = [];
                    foreach ($top10Professions as $key => $value) {
                        $top10ProfessionsResult[$value['category']]['quantity'] = (isset($top10ProfessionsResult[$value['category']]['quantity'])) ? $top10ProfessionsResult[$value['category']]['quantity'] += 1 : 1;
                    };
                    $profession_name = (Profession::whereIn('_id', array_keys($top10ProfessionsResult))->get()->pluck('name', '_id'));
                }
        }
    }
}
