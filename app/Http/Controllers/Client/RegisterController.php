<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('client.auth.register.register');

    }
    public function register(AuthRequest $request)
    {
        $request->validated();
        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect('login')->withSuccess('Đăng ký thành công !');
    }

    public function home()
    {
        if (Auth::check()) {
            return view('client.home.home');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
