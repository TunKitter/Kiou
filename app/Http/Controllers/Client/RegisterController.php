<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $meta_title = "Sign up and start learning";
        $meta_description = "KIOU is an online teaching platform and offers a variety of courses.";
        $meta_keywords = "kiou, online learning website, programming course";
        if (auth()->check()) {
            return redirect()->route('home');
        }
        return view('client.auth.register.register', compact('meta_title', 'meta_description', 'meta_keywords'));

    }
    public function register(AuthRequest $request)
    {
        //Lấy IP từ mấy người dùng
        $ip = $request->ip();
        //Giới hạn 1 IP mấy tính có thể tạo được 5 tài khoản
        $limit = 10;
        //Đếm số tài khoản có IP giống nhau
        $count_account = User::whereIn('ip', [$ip])->count();
        // dd($count_account);
        if ($count_account > $limit) {
            return redirect('register')->with(['deny_register' => 'Registration failed !']);
        } else {
            $request->validated();
            User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'ip' => [$request->ip()],
            ]);
            return redirect('login')->withSuccess('Sign Up Success !');
        }
    }
}
