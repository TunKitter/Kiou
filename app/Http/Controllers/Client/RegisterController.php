<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class RegisterController extends Controller
{
    public function index()
    {
        return view('client.auth.register.register');
        
    } 
    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:40',
            'phone' => 'required|string|regex:/^[0-9]{10,11}$/',
            'username' => [
                'required',
                'string',
                'min:6',
                Rule::unique('users'),
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users'), // Ensure email uniqueness in the 'users' table
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/^(?=.*\d).{6,}$/',
            ],
            
            'remember' => 'required|accepted',
        ],
        [
                // Custom error messages
                'name.required' => 'Vui lòng nhập tên.',
                'name.min' => 'Tên ít nhất phải :min ký tự.',
                'name.max' => 'Tên không được vượt quá :max ký tự.',
                'phone.required' => 'Vui lòng nhập số điện thoại.',
                'phone.regex' => 'Số điện thoại không hợp lệ.',
                'username.required' => 'Vui lòng nhập tên đăng nhập.',
                'username.max' => 'Tên đăng nhập không được vượt quá :max ký tự.',
                'email.required' => 'Vui lòng nhập địa chỉ email.',
                'email.email' => 'Địa chỉ email không hợp lệ.',
                'email.max' => 'Địa chỉ email không được vượt quá :max ký tự.',
                'email.unique' => 'Địa chỉ email đã tồn tại trong hệ thống.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự.',
                'remember.required' => 'Bạn phải đồng ý với các điều khoản và điều kiện.',
            ]);
       
        // Create a new user record in MongoDB
        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // Redirect to the home page or any other desired location
        return redirect('login')->withSuccess('Đăng ký thành công !');
    }
    
    
    
    public function home()
    {
        if(Auth::check()){
            return view('client.home.home');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function logOut() {
       Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    protected function _registerOrLoginUser($data){

        $user = User::where('email', '=', $data->email)->first();
        if(!$user){

            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->id = $data->id;
            $user->save();
        }

        Auth::login($user);
    }
}
