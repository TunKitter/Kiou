<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Mentor;
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

    }
    public function getCourseData($skip = 0, $take = 10)
    {
        $courses = (Course::orderBy('complete_course_rate', 'desc')->orderBy('view', 'desc')->orderBy('click', 'desc')->orderBy('total_enrollment', 'desc')->skip($skip)->take($take)->get());
        $a_length = count($courses) - 1;
        // for ($i = 0; $i < $a_length; $i++) {
        // $temp_i = $courses[$i];
        // $temp_i = $temp_i->complete_course_rate + ($temp_i->user_attract_rate) + ($temp_i->total_enrollment / 2);
        // for ($j = 0; $j < $a_length - $i; $j++) {
        // $temp_j = $courses[$j];
        // if (($temp_i) > $temp_j->complete_course_rate + (($temp_j->view - $temp_j->click) / 10) + ($temp_j->total_enrollment / 2)) {
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
        $course = Course::where('slug', $id)->first();
        $chapter = $course->chapter;
        $mentor_professions = Profession::whereIn('_id', $course->mentor->profession)->orWhere('_id', $course->category)->distinct('name')->get()->toArray();
        $mentor_professions = implode(', ', array_map(function ($item) {
            return $item[0];
        }, $mentor_professions));
        $category_profession = substr($mentor_professions, strrpos($mentor_professions, ',') + 1);
        $lessons_db = (Lesson::where('course_id', $course->id)->get(['chapter', 'name'])->toArray());
        $lessons = [];
        array_map(function ($item) use (&$lessons) {
            $lessons[$item['chapter'][1]][] = $item['name'];
        }, $lessons_db);
        // dd($lessons['dasd']);
        return $course ? view('client.courses.course-details', compact('course', 'mentor_professions', 'category_profession', 'chapter', 'lessons')) : redirect()->route('course-list');
    }

    public function explore($id = null)
    {
        $profession_name = Profession::where('slug', $id)->first();
        $profession_name ? $profession_name = $profession_name->name : redirect()->route('course-explore');
        return view('client.courses.course-explore', $profession_name ? ['id' => $profession_name] : []);
    }
}
