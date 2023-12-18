<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    public function enterEmail()
    {
        return view('client.auth.password.enter-email');
    }

    public function handleEnterEmail(Request $request)
    {
        $request_mail = $request->email;
        $user_from_request_mail = User::where('email', $request_mail)->first();
        if ($user_from_request_mail) {
            $randomNumber = mt_rand(100000, 999999);
            $token_id = uniqid();
            Session::push($token_id, [$request_mail, $randomNumber]);
            Mail::send('mail.send-code-mail', compact('randomNumber'), function ($email) use ($user_from_request_mail) {
                $email->subject('demo');
                $email->to($user_from_request_mail->email, 'Ma xac nhan mat khau');
            });
            return redirect(route('confirm-code', ['token_id' => $token_id]));
        } else {
            return redirect()->route("enter-email")->with('no_user', 'Không tìm thấy người dùng');
        }
    }

    public function confirmCode(Request $request)
    {
        if (!$request->token_id) {
            return redirect()->route('enter-email')->with('no_confirm_code', 'Không có mã xác nhận');
        }
        return view('client.auth.password.confirm-code', ['token_id' => $request->token_id]);
    }

    public function handleConfirmCode(Request $request)
    {
        $confirmCode = $request->confirmCode;
        if ($confirmCode == session($request->token_id)[0][1]) {
            return redirect(route('new-password', ['token_id' => $request->token_id]));
        } else {
            return redirect()->route('confirm-code', ['token_id' => $request->token_id])->with('wrong_code', 'Mã xác nhận không chính xác');
        }
    }

    public function newPassword(Request $request)
    {
        return view('client.auth.password.new-password', ['id_token' => $request->token_id]);
    }

    //Hàm xử lý đổi mật khẩu khi nhập đúng mã xác nhận(send code)
    public function handleNewPassword(Request $request)
    {
        $findEmail = \session($request->id_token)[0][0];
        $checkmail = User::where('email', $findEmail)->first();
        //Bắt lỗi nhập input
        $validator = Validator::make($request->all(), [
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|same:newPassword',
        ],
            [
                'newPassword.required' => 'Mật khẩu không được để trống',
                'confirmPassword.required' => 'Xác nhận mật khẩu không được để trống',
                'confirmPassword.same' => 'Mật khẩu không trùng nhau',
            ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            //tìm mail lúc đầu người dùng nhập để lấy mã xác nhận(send code) để đổi mật khẩu
            session([$request->id_token => true]);
            $data = [
                'password' => Hash::make($request->confirmPassword),
            ];
            User::where('email', $findEmail)->update($data);
            return redirect()->route('login')->with('success', 'Đổi mật khẩu thành công');
        }
    }

    // public function sentSmsOtp(){
    //     $otp = request()->otp;
    //     $username =  request()->username;

    //     $request_mail = $request->email;
    //     $user_from_request_mail = User::where('email', $request_mail)->first();
    //     if ($user_from_request_mail) {
    //         $randomNumber = mt_rand(100000, 999999);
    //         $token_id = uniqid();
    //         Session::push($token_id, [$request_mail, $randomNumber]);
    //         return redirect(route('confirm-code', ['token_id' => $token_id]));
    //     } else {
    //         return redirect()->route("enter-email")->with('no_user', 'Không tìm thấy người dùng');
    //     }




    // }
}
