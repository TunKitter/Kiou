<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return view('client.auth.register.register');
    }
}
