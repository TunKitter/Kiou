<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        return view('client.auth.login.login');

    }
    public function customLogin(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ],[
        'email.required' => 'Vui lòng nhập địa chỉ email.',
        'email.email' => 'Địa chỉ email không hợp lệ.',
        'password.required' => 'Vui lòng nhập mật khẩu.',
        'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự.',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Đăng nhập thành công
        return redirect()->intended('/');
    } else {
        // Đăng nhập thất bại
        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'Thông tin đăng nhập không đúng.',
        ]);
    }
}
}



