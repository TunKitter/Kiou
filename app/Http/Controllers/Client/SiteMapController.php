<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Http\Response;
class SiteMapController extends Controller
{
    public function index (): Response {
        $courses = Course::latest()->get();

        return response()->view('client.sitemap.sitemap',['courses' => $courses])->header('Content-Type', 'text/xml');
    }
}
