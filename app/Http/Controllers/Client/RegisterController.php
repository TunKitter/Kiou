<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function index()
    {
        return view('client.auth.register.register');
    }
    public function register(AuthRequest $request)
    {
        //Lấy IP từ mấy người dùng
        $ip = $request->ip();
        //Giới hạn 1 IP mấy tính có thể tạo được 5 tài khoản 
        $limit = 5;
        //Đếm số tài khoản có IP giống nhau
        $count_account = User::where('ip', $ip)->count();
        // dd($count_account);
        if ($count_account > $limit) {
            return redirect('register')->withSuccess('Đăng ký thất bại !');
        } else {
            $request->validated();
            User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'ip' => [$request->ip()]
            ]);
            return redirect('login')->withSuccess('Đăng ký thành công !');
        }
    }

    public function home()
    {
        if (Auth::check()) {
            return view('client.home.home');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
