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
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('/');
        } else {
            return redirect()->back()->withInput($request->only('email'))->withErrors([
                'email' => 'Thông tin đăng nhập không đúng.',
            ]);
        }
    }
}
