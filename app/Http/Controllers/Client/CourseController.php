<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function list()
    {
        return view('client.courses.course-list');
    }
    public function detail(string $id)
    {
        return view('client.courses.course-details');
    }
    public function learn(string $id)
    {
        return view('client.courses.course-learn');
    }
}
