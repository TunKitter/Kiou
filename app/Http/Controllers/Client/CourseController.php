<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\Mentor;
use App\Models\Profession;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function list(Request $request)
    {
        // dd(request()->all());
        // dd($this->softMentorData(Mentor::all(), count(Mentor::all()) - 1));
        // dd(Mentor::orderBy('course.total_enrollment', 'desc')->get());
        //
        $meta_title = "Online Courses | KIOU";
        switch ($request->type) {
            case 'auto':
            case 'course':
                {
                    if ($request->q) {
                        $q = ($request->is_wrong_spell != '0' && $request->is_wrong_spell != '' ? $request->is_wrong_spell : $request->q);
                        $q = explode(' ', $q);
                        $result = [];
                        for ($i = 0; $i < count($q); $i++) {
                            $result[] = ['name', 'like', '%' . $q[$i] . '%'];
                        }
                        $is_free = false;
                        if ($request->price == 'free') {
                            $result[] = ['price', 0];
                            $is_free = true;
                        }
                        if (!$is_free) {
                            if ($request->min_value || $request->max_value) {
                                $result[] = ['price', '>=', (int) $request->min_value];
                                $result[] = ['price', '<=', (int) $request->max_value];
                            }
                        }

                        if ($request->level) {
                            if ($request->level != 'all') {
                                $result[] = ['level_id', (Level::select('_id')->where('name', 'like', '%' . ucfirst($request->level) . '%')->first()->_id)];
                            }
                        }
                        // dd($request->all());
                        $courses = $this->courseSoftCondition(request(), $result);

                        // $courses = Course::where([['price', '>=', (int) $request->min_value], ['price', '<=', ]])->get();
                        // dd($courses, $result);
                        return view('client.courses.course-list', ['courses' => count($courses) > 0 ? $courses : $this->getCourseData(), 'is_not_found' => count($courses) == 0, 'q' => $request->q, 'is_wrong_spell' => ($request->is_wrong_spell != '0' ? $request->is_wrong_spell : '0'), 'type' => $request->type]);
                    }

                    $courses = $this->courseSoftCondition(request(), []);

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
                    return view('client.courses.course-list', compact('meta_title'), ['mentors' => $this->softMentorData($mentors, count($mentors) - 1), 'type' => $request->type]);
                }

        }
        $result = [];
        $is_free = false;
        if ($request->price == 'free') {
            $result[] = ['price', 0];
            $is_free = true;
        }
        if (!$is_free) {
            if ($request->min_value || $request->max_value) {
                $result[] = ['price', '>=', (int) $request->min_value];
                $result[] = ['price', '<=', (int) $request->max_value];
            }
        }

        if ($request->level) {
            if ($request->level != 'all') {
                $result[] = ['level_id', (Level::select('_id')->where('name', 'like', '%' . ucfirst($request->level) . '%')->first()->_id)];
            }
        }
        return view('client.courses.course-list', ['courses' => $this->courseSoftCondition(request(), $result), 'type' => $request->type]);
    }
    public function courseSoftCondition($request, $result)
    {
        if ($request->soft_by || $request->soft_by != 'most_common') {
            if ($request->soft_by == 'buy_most') {
                $courses = Course::where($result)->orderBy('total_enrollment', 'desc')->get();
            } elseif ($request->soft_by == 'high_rating') {
                $courses = Course::where($result)->orderBy('complete_course_rate', 'desc')->get();

            } else {
                $courses = Course::where($result)->orderBy('total_enrollment', 'desc')->get();
            }
        } else {
            $courses = $this->getCourseData(0, 10, $result);
        }
        return $courses;
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
    public function getCourseDataBuyMost($skip = 0, $take = 10, $where = [])
    {
        $courses = (Course::where('category', request()->category)->where($where)->orderBy('total_enrollment', 'desc')->skip($skip)->take($take)->get());
        // $a_length = count($courses) - 1;
        // $courses = $this->softData($courses_buy_most, $a_length);
        return $courses;
    }
    public function getCourseDataCostMost($skip = 0, $take = 10, $where = [])
    {
        $courses = (Course::where('category', request()->category)->where('total_enrollment', '>', 0)->orderBy('price', 'asc')->skip($skip)->take($take)->get());
        $a_length = count($courses) - 1;
        $courses = $this->softData($courses, $a_length);
        return $courses;
    }
    public function getMentorData($skip = 0, $take = 10, $where = [])
    {
        if (request()->q) {
            $mentors = Mentor::where('name', 'like', '%' . request()->q . '%')->orWhere('username', 'like', '%' . request()->q . '%')->skip($skip)->take($take)->get();
            // return $mentors->course->sum('total_enrollment');
            for ($i = 0; $i < count($mentors); $i++) {
                $mentors[$i]->total_enrollment = $mentors[$i]->course->sum('total_enrollment');
                $mentors[$i]->total_course = $mentors[$i]->course->count();
            }

            return $mentors;
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
        $mentor_professions = implode(',', Profession::whereIn('_id', $course->mentor->profession)->pluck('name')->toArray());
        $category_profession = Profession::where('_id', $course->category)->first()->name;
        $lessons_db = (Lesson::where('course_id', $course->id)->get(['chapter', 'name'])->toArray());
        try {
            $overview_video_path = (Lesson::where('course_id', $course->id)->first(['path'])->toArray())['path'];
        } catch (\Throwable $th) {
            $overview_video_path = '';
        }
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
        // dd(Profession::all(['_id', 'name'])->toArray());
        $profession_id = $profession_name->_id;
        // dd($profession_id);

        $professions_others = Profession::whereIn('parent_profession', [$profession_id])->orWhere('_id', 'IN', [$profession_name->parent_profession])->get(['slug', 'name']);
        // dd($professions_others);
        $courses = Course::where('category', $profession_name->_id)->take(10)->get();
        $courses_buy_most = Course::where('category', $profession_name->_id)->orderBy('total_enrollment', 'asc')->take(10)->get();
        $courses_cost_most = Course::where('category', $profession_name->_id)->where('total_enrollment', '>', 0)->orderBy('price', 'asc')->take(10)->get();
        // soft $courses_buy_most sort by price asc
        $courses = $this->softData($courses, count($courses) - 1);
        // dd($courses);
        $profession_name ? $profession_name = $profession_name->name : redirect()->route('course-explore');
        return view('client.courses.course-explore', $profession_name ? ['id' => $profession_name] : [], ['courses' => $courses, 'courses_buy_most' => $courses_buy_most, 'profession_id' => $profession_id, 'professions_others' => $professions_others, 'courses_cost_most' => $courses_cost_most]);
    }
    public function updateInteractive()
    {
        $ids = rtrim(request()->ids, ',');
        Course::whereIn('_id', explode(',', $ids))->increment(request()->type);
        if (request()->type2) {
            Course::whereIn('_id', explode(',', \request()->ids2))->increment(request()->type2);
        }
        return response()->json(['status' => true]);
    }
    public function getMentorName()
    {
        return response()->json([
            'name' => Mentor::select('name')->where('_id', request()->id)->first()->name,
        ]);
    }
    public function detailPlainData()
    {
        $course = Course::where('slug', request()->slug)->first();
        return response()->json([
            'data' => $course,
            'mentor_name' => isset($course->mentor->name) ? $course->mentor->name : 'Not found',
            'slug' => request()->slug,
        ]);
    }
}
