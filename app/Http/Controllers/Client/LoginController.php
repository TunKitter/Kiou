<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    protected function _registerOrLoginUser($data)
    {

        $user = User::where('email', '=', $data->email)->first();

        if (!$user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->image = ['avatar' => $data->avatar];
            $user->auth = ['google' => $data->id];
            $user->save();
        }
        Auth::login($user);
    }

    public function index()
    {
        $meta_title = "Log in and start learning";
        $meta_description = "KIOU is an online teaching platform and offers a variety of courses.";
        $meta_keywords = "kiou, online learning website, programming course";

        if (auth()->check()) {
            return redirect()->route('home');
        }

        return view('client.auth.login.login', compact('meta_title', 'meta_description', 'meta_keywords'));
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $this->_registerOrLoginUser($user);

        return redirect()->route('home');
    }

    public function redirectToGoogle()
    {

        return Socialite::driver('google')->redirect();
    }

    public function login(AuthRequest $request)
    {
        $request->validated();
        $findEmail = $request->email; // tìm mail người dùng nhập vào
        $ip = $request->ip(); //Lấy ip người dùng
        $limit = 4; // Giới hạng ip của 1 tài khoản

        // Lấy bản ghi đầu tiên thỏa mãn điều kiện
        $result = User::where('email', $findEmail)->first();
        $ip_user = [];
        if ($result) {
            //lấy nhiều ip trong 1 tài khoản
            $ip_user = $result->ip;
        }
        if (!$ip_user) {
            $ip_user = [];
        }
        // Đếm số ip cử 1 tài khoản
        $count_ip = count($ip_user);
        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->role[0] == '6523f9bcad8f1cf003fce14d') {

                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home');
            }
            //Kiểm tra thông tin trong ip user có ip đó chưa
            if (!(in_array($ip, $ip_user))) {
                //Kiểm tra số lượng ip người dùng đã đến giới hạn chưa
                if ($count_ip < $limit) {
                    User::where('email', $findEmail)->push(
                        'ip',
                        [$request->ip()]
                    );
                } else {
                    //Bắt lỗi tài khoản cộng đồng
                    User::where('email', $findEmail)->update(
                        ['role' => ['652a9a45835ceedb746a99ef']]
                    );
                }
            }

        } else {

            return redirect()->back()->withInput($request->only('email'))->withErrors([
                'email' => 'Login information is incorrect.',
            ]);

        }
        return redirect()->route('home')->with('success', 'Logged in successfully');
    }
}
