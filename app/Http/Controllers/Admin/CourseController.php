<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Mentor;
use App\Models\Profession;

class CourseController extends Controller
{
    public function index()
    {
        $courses_awaiting= Course::where('state','-1')->get();
        $courses = Course::where('state','0')->take(10)->get();
        $mentor_name = Mentor::select('name', 'id')->whereIn('_id', $courses->pluck('mentor_id'))->get()->pluck('name', '_id');
        $category_name = Profession::select('name', 'id')->whereIn('_id', $courses->pluck('category'))->get()->pluck('name', '_id');
        return view('admin.course.course', compact('courses','courses_awaiting', 'mentor_name', 'category_name'));
    }
    public function detail($id)
    {
        $course = Course::find($id);
        $category_name = Profession::select('name')->where('_id', $course->category)->first()->name;
        $lessons = Lesson::where('course_id', $id)->get()->groupBy('chapter.1');
        $chapter = Chapter::select('infor')->where('course_id', $id)->first()->infor;
        return view('admin.course.detail', compact('course', 'category_name', 'lessons', 'chapter'));
    }

    public function acceptCourse ($id) {

        $course = Course::findOrFail($id);
      
        $course->state = '0'; 
       
        $course->save();
        
        return redirect()->route('list-course-admin');
    }

    public function delete($id) {
        Course::find($id)->delete();
        return redirect()->route('list-course-admin');
    } 

    // public function moderation($id) {
    //     $course = Course::find($id);
    //     $category_name = Profession::select('name')->where('_id', $course->category)->first()->name;
    //     $lessons = Lesson::where('course_id', $id)->get()->groupBy('chapter.1');
    //     $chapter = Chapter::select('infor')->where('course_id', $id)->first()->infor;
    //     return view('admin.course.detail', compact('course', 'category_name', 'lessons', 'chapter'));
    // }
}
