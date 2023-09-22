<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function index()
    {
         $locale = App::currentLocale();
        return view('client.home.home', compact('locale'));
    }
}
