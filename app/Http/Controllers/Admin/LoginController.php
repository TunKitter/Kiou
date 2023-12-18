<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function index(){

        return view('admin.login.login');
    }
    public function login(Request $request){

            $request->validated();
        
            if (Auth::attempt($request->only('email', 'password'))) {
               
                if(Auth::user()->role[0] == '6523f9bcad8f1cf003fce14d'){

                return redirect()->route('dashboard')->with('success', 'Đăng nhập thành công');
            }
                   
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginAdmin');
    }
}
