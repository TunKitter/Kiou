<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    public function index()
    {
        return view('client.auth.password.enter-email');
    }
    public function confirm_code()
    {
        return view('client.auth.password.confirm-code');
    }
    public function new_password()
    {
        return view('client.auth.password.new-password');
    }
}
