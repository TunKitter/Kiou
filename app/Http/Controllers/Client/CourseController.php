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
    public function list(Request $request)
    {
        if ($request->q) {
            $courses = Course::where('name', 'like', '%' . ($request->is_wrong_spell != '0' ? $request->is_wrong_spell : $request->q) . '%')->get();
            $courses = $this->softData($courses, count($courses) - 1);
            return view('client.courses.course-list', ['courses' => count($courses) > 0 ? $courses : $this->getCourseData(), 'is_not_found' => count($courses) == 0, 'q' => $request->q, 'is_wrong_spell' => ($request->is_wrong_spell != '0' ? $request->is_wrong_spell : '0')]);
        }
        return view('client.courses.course-list', ['courses' => $this->getCourseData()]);
    }
    public function getCourseData($skip = 0, $take = 10, $where = [])
    {
        $courses = (Course::where($where)->orderBy('complete_course_rate', 'desc')->orderBy('view', 'desc')->orderBy('click', 'desc')->orderBy('total_enrollment', 'desc')->skip($skip)->take($take)->get());
        $a_length = count($courses) - 1;
        $courses = $this->softData($courses, $a_length);
        return $courses;
    }
    public function softData($courses, $a_length)
    {
        for ($i = 0; $i < $a_length; $i++) {
            $courses[$i]->mentor_name = $courses[$i]->mentor->name;
            for ($j = 0; $j < $a_length - $i; $j++) {
                $temp_j = $courses[$j];
                $temp_j_2 = $courses[$j + 1];
                if ($temp_j->complete_course_rate + (1 / ($temp_j->view - $temp_j->click + 1)) + ($temp_j->total_enrollment / 2) < $temp_j_2->complete_course_rate + (1 / ($temp_j_2->view - $temp_j_2->click + 1)) + ($temp_j_2->total_enrollment / 2)) {
                    $temp = $courses[$j];
                    $courses[$j] = $courses[$j + 1];
                    $courses[$j + 1] = $temp;
                }
            }
        }
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
