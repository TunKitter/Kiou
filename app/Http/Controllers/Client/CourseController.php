<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Mentor;
use App\Models\Profession;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function list(Request $request)
    {

        // dd(Mentor::all()->first()->course->sum('total_enrollment'));
        // dd($this->softMentorData(Mentor::all(), count(Mentor::all()) - 1));
        // dd(Mentor::orderBy('course.total_enrollment', 'desc')->get());
        switch ($request->type) {
            case 'auto':
            case 'course':
                {
                    if ($request->q) {
                        $q = ($request->is_wrong_spell != '0' ? $request->is_wrong_spell : $request->q);
                        $q = explode(' ', $q);
                        $result = [];
                        for ($i = 0; $i < count($q); $i++) {
                            $result[] = ['name', 'like', '%' . $q[$i] . '%'];
                        }
                        $courses = Course::where($result)->get();
                        $courses = $this->softData($courses, count($courses) - 1);
                        return view('client.courses.course-list', ['courses' => count($courses) > 0 ? $courses : $this->getCourseData(), 'is_not_found' => count($courses) == 0, 'q' => $request->q, 'is_wrong_spell' => ($request->is_wrong_spell != '0' ? $request->is_wrong_spell : '0'), 'type' => $request->type]);
                    }
                    $courses = $this->getCourseData();
                    return view('client.courses.course-list', ['courses' => $courses, 'type' => $request->type]);
                }
            case 'mentor':
                {
                    if ($request->q) {
                        $mentors = Mentor::where('name', 'like', '%' . $request->q . '%')->orWhere('username', 'like', '%' . $request->q . '%')->get();
                        $mentors = $this->softMentorData($mentors, count($mentors) - 1);
                        return view('client.courses.course-list', ['mentors' => count($mentors) > 0 ? $mentors : $this->getMentorData(), 'is_not_found' => count($mentors) == 0, 'q' => $request->q, 'type' => $request->type]);
                    }
                    $mentors = $this->getMentorData();
                    return view('client.courses.course-list', ['mentors' => $this->softMentorData($mentors, count($mentors) - 1), 'type' => $request->type]);
                }

        }
        return view('client.courses.course-list', ['courses' => $this->getCourseData(), 'type' => $request->type]);
    }
    public function getCourseData($skip = 0, $take = 10, $where = [])
    {
        if (request()->q) {
            return $this->softData($course = Course::where('name', 'like', '%' . request()->q . '%')->skip($skip)->take($take)->get(), count($course) - 1);
        }

        $courses = (Course::where($where)->orderBy('complete_course_rate', 'desc')->orderBy('view', 'desc')->orderBy('click', 'desc')->orderBy('total_enrollment', 'desc')->skip($skip)->take($take)->get());
        $a_length = count($courses) - 1;
        $courses = $this->softData($courses, $a_length);
        return $courses;
    }
    public function getMentorData($skip = 0, $take = 10, $where = [])
    {
        if (request()->q) {
            $mentors = Mentor::where('name', 'like', '%' . request()->q . '%')->skip($skip)->take($take)->get();
            // return $mentors->course->sum('total_enrollment');
            for ($i = 0; $i < count($mentors); $i++) {
                $mentors[$i]->total_enrollment = $mentors[$i]->course->sum('total_enrollment');
                $mentors[$i]->total_course = $mentors[$i]->course->count();
            }
        }
        $mentors = (Mentor::where($where)->skip($skip)->take($take)->get());
        $a_length = count($mentors) - 1;
        $mentors = $this->softMentorData($mentors, $a_length);
        return $mentors;
    }

    public function softMentorData($mentors, $a_length)
    {

        for ($i = 0; $i <= $a_length; $i++) {
            $mentors[$i]->total_enrollment = $mentors[$i]->course->sum('total_enrollment');
            $mentors[$i]->total_course = $mentors[$i]->course->count();
            for ($j = 0; $j < $a_length - $i; $j++) {
                $temp_j = $mentors[$j];
                $temp_j_2 = $mentors[$j + 1];
                if ($temp_j->course->sum('total_enrollment') < $temp_j_2->course->sum('total_enrollment')) {
                    $temp = $mentors[$j];
                    $mentors[$j] = $mentors[$j + 1];
                    $mentors[$j + 1] = $temp;
                }
            }
        }
        return $mentors;
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
    public function detail(string $id)
    {
        $course = Course::where('slug', $id)->first();
        $chapter = $course->chapter;
        $mentor_professions = Profession::whereIn('_id', $course->mentor->profession)->orWhere('_id', $course->category)->distinct('name')->get()->toArray();
        $mentor_professions = implode(', ', array_map(function ($item) {
            return $item[0];
        }, $mentor_professions));
        // dd($mentor_professions);
        $category_profession = substr($mentor_professions, strrpos($mentor_professions, ',') + 1);
        $lessons_db = (Lesson::where('course_id', $course->id)->get(['chapter', 'name'])->toArray());
        $overview_video_path = (Lesson::where('course_id', $course->id)->first(['path'])->toArray())['path'];
        $lessons = [];
        array_map(function ($item) use (&$lessons) {
            $lessons[$item['chapter'][1]][] = $item['name'];
        }, $lessons_db);
        // dd($lessons['dasd']);
        return $course ? view('client.courses.course-details', compact('course', 'mentor_professions', 'category_profession', 'chapter', 'lessons', 'overview_video_path')) : redirect()->route('course-list');
    }

    public function explore($id = null)
    {
        $profession_name = Profession::where('slug', $id)->first();
        $profession_name ? $profession_name = $profession_name->name : redirect()->route('course-explore');
        return view('client.courses.course-explore', $profession_name ? ['id' => $profession_name] : []);
    }
    public function updateInteractive()
    {
        $ids = rtrim(request()->ids, ',');
        Course::whereIn('_id', explode(',', $ids))->increment(request()->type);
        return response()->json(['status' => true]);
    }
}
