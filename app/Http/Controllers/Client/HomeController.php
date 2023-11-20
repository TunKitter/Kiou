<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use App\Models\Enrollment;
use App\Models\Roadmap;

class HomeController extends Controller
{
    public function index()
    {
        return view('client.home.home');
    }

    
}
