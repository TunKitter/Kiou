<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Mentor;
use App\Models\Roadmap;

class RoadmapController extends Controller
{
    public function index()
    {
        $roadmap = Roadmap::all();
        $mentor_name = Mentor::select('name')->whereIn('_id', $roadmap->pluck('mentor_id'))->get()->pluck('name', '_id');
        return view('admin.roadmap.roadmap', \compact('roadmap', 'mentor_name'));
    }
    public function showChild($arr, $aa = '', $bb = '')
    {
        $result = [];
        foreach ($arr as $value2) {
            if ($value2['type'] == 'course' || $value2['type'] == 'lesson') {
                // $result['multiple'][] = ["description" => $value2['type_description'], 'type' => $value2['type'], 'type_id' => $value2['type_id']];
                if ($value2['type'] == 'course') {
                    $aa .= $value2['type_id'] . ',';
                } elseif ($value2['type'] == 'lesson') {
                    $bb .= $value2['type_id'] . ',';
                }
            } else {
                $aa .= $this->showChild($arr['type_id'])[0];
                $bb .= $this->showChild($arr['type_id'])[1];
            }
        }
        return [$aa, $bb];
    }
    public function detail(string $slug)
    {
        $roadmap = Roadmap::where('slug', $slug)->first();
        $aa = '';
        $bb = '';
        // $cc = [];
        $index = 0;
        foreach ($roadmap['content'] as $value) {
            if ($value['type'] == 'course') {
                $aa .= $value['type_id'] . ',';
            } elseif ($value['type'] == 'lesson') {
                $bb .= $value['type_id'] . ',';
            } else {
                foreach ($value['type_id'] as $value2) {
                    if ($value2['type'] == 'course') {
                        $aa .= $value2['type_id'] . ',';
                    } elseif ($value2['type'] == 'lesson') {

                        $bb .= $value2['type_id'] . ',';
                    } else {
                        $aa .= $this->showChild($value2['type_id'])[0];
                        $bb .= $this->showChild($value2['type_id'])[1];
                    }
                }

            }
            $index++;
        }
        // return $aa;
        // dd($roadmap->pluck('name', '_id')->toArray());
        // dd($aa, $bb);

        $course_database = (Course::whereIn('_id', explode(',', rtrim($aa, ',')))->get());
        $course_name = [];
        $index_course_name = 0;
        array_map(function ($course) use (&$course_name, $course_database, &$index_course_name) {
            $course_name[$course['_id']] = ['name' => $course['name'], 'total_lesson' => $course['meta']['total_lesson'], 'total_time' => $course['meta']['total_time'], 'price' => $course['price'], 'mentor_username' => $course_database[$index_course_name]->mentor->username, 'thumbnail' => $course_database[$index_course_name]->image, 'slug' => $course_database[$index_course_name]->slug];
            $index_course_name++;
        }, $course_database->toArray());
        $lesson_name = (Lesson::whereIn('_id', explode(',', rtrim($bb, ',')))->get());
        $aa = [];
        // dd($course_name);
        $index_lesson = 0;
        array_map(function ($lesson) use (&$aa, $lesson_name, &$index_lesson) {
            $temp_course = $lesson_name[$index_lesson]->course;
            $aa[$lesson['_id']] = ['name' => $lesson['name'], 'course_name' => $temp_course->name, 'total_lesson' => $temp_course->meta['total_lesson'], 'total_time' => $temp_course->meta['total_time'], 'course_slug' => $temp_course->slug, 'mentor_username' => $temp_course->mentor->username, 'thumbnail' => $temp_course->image, 'course_price' => $temp_course->price, 'course_slug' => $temp_course->slug];
            $index_lesson++;
        }, $lesson_name->toArray());
        // dd(Lesson::all()->first()->course);
        $lesson_name = $aa;
        return view('admin.roadmap.detail', compact('roadmap', 'course_name', 'lesson_name'));
    }
}
