<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

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
        return view('client.auth.login.login');
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
        $findEmail =  $request->email; // tìm mail người dùng nhập vào
        $ip = $request->ip(); //Lấy ip người dùng
        $limit = 4; // Giới hạng ip của 1 tài khoản

        // Lấy bản ghi đầu tiên thỏa mãn điều kiện
        $result = User::where('email', $findEmail)->first();
        if ($result) {
            //lấy nhiều ip trong 1 tài khoản
            $ip_user = $result->ip;
            $count_ip = count($ip_user);
        } else {
            $ip_user = null;
        }
        // Đếm số ip cử 1 tài khoản
       
        if (Auth::attempt($request->only('email', 'password'))) {
            //Kiểm tra thông tin trong ip user có ip đó chưa
            if (!(in_array($ip, $ip_user))) {
                //Kiểm tra số lượng ip người dùng đã đến giới hạn chưa
                if ($count_ip < $limit) {
                    User::where('email', $findEmail)->push(
                        'ip',
                        [$request->ip()]
                    );
                } else {
                    //Bắt lỗi tài khoảng cộng đồng
                    User::where('email', $findEmail)->update(
                        ['role' => ['652a9a45835ceedb746a99ef']]
                    );
                }
            }
           
        } else {

            return redirect()->back()->withInput($request->only('email'))->withErrors([
                'email' => 'Thông tin đăng nhập không đúng. '
            ]);

        }
        return redirect()->route('home')->with('success', 'Đăng nhập thành công');
    }
}
