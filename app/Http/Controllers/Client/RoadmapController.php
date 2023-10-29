<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Roadmap;

class RoadmapController extends Controller
{
    public function index()
    {
        // $courses = Course::all();
        // dd(Roadmap::all());
        $roadmap = Roadmap::all();
        $aa = '';
        $bb = '';
        (array_map(function ($course) use (&$aa, &$bb) {
            $index = 0;
            foreach ($course['content'] as $value) {
                if ($value['type'] == 'course') {
                    $aa .= $value['type_id'] . ',';
                } else {
                    $bb .= $value['type_id'] . ',';
                }
                $index++;
            }
            return $aa;
        }, $roadmap->toArray()));
        $course_database = (Course::whereIn('_id', explode(',', rtrim($aa, ',')))->get(['_id', 'name', 'meta'])->toArray());
        $course_name = [];
        array_map(function ($course) use (&$course_name, $course_database) {
            $course_name[$course['_id']] = ['name' => $course['name'], 'total_lesson' => $course['meta']['total_lesson'], 'total_time' => $course['meta']['total_time']];
        }, $course_database);
        $lesson_name = (Lesson::whereIn('_id', explode(',', rtrim($bb, ',')))->get());
        $aa = [];
        // dd($lesson_name->toArray());
        $index_lesson = 0;
        array_map(function ($lesson) use (&$aa, $lesson_name, &$index_lesson) {
            $temp_course = $lesson_name[$index_lesson]->course;
            $aa[$lesson['_id']] = ['name' => $lesson['name'], 'course_name' => $temp_course->name, 'total_lesson' => $temp_course->meta['total_lesson'], 'total_time' => $temp_course->meta['total_time']];
            $index_lesson++;
        }, $lesson_name->toArray());
        // dd(Lesson::all()->first()->course);
        $lesson_name = $aa;
        // dd(Course::whereIn('_id', $roadmap)->get(['co'])->toArray());
        return view('client.roadmap.roadmap', compact('roadmap', 'course_name', 'lesson_name'));
    }
}
