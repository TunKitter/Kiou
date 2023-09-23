<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function getForgotPassword()
    {
        return view('client.auth.password.enter-email');
    }

    //Xử lý thông tin quên mật khẩu để gửi mã xác nhận qua Mail
    public function postForgotPassword(Request $request)
    {
        $findEmail =  $request->email;
        $checkmail = DB::collection('users')->where('email', $findEmail)->first();
        if ($checkmail) {
            //Số ngẫu nhiên gồm 6 chữ số
            $randomNumber = mt_rand(100000, 999999);
            session(['send_code' => $randomNumber]);
            $name = 'hello';
            session(['mail_forgotpassword' => $checkmail->email]);
            // Mail::to($checkmail)->send(new SendCodeMail($randomNumber));
            Mail::send('mail.send-code-mail', compact('name'), function ($email) use ($checkmail) {
                $email->subject('demo');
                $email->to($checkmail->email, 'Ma xac nhan mat khau');
            });
            return redirect(route('get-sendcode'))->with('success', 'Vui lòng check mail để lấy mã đổi mật khẩu');
        } else {
            echo "<script>alert('Email không tồn tại')</script>";
            return view("client.auth.password.enter-email");
        }
    }


    public function getSendCode()
    {
        return view('client.auth.password.confirm-code');
    }



    //Biến quy định số lần nhập sai mã xác nhận(send code)
    protected $maxWrongAttempts = 5;

    //Hàm tăng số lần nhập sai mã xác nhận(send code)
    protected function incrementWrongAttempts(Request $request)
    {
        // Lấy số lần nhập sai hiện tại từ session (hoặc database, cache, ...)
        $wrongAttempts = $request->session()->get('wrong_attempts', 0);


        // Tăng số lần nhập sai lên 1
        $wrongAttempts++;

        // Lưu lại số lần nhập sai mới vào session
        session(['wrong_attempts' => $wrongAttempts]);
    }

    //Hàm kiểm tra số lần nhập sai mã xác nhận(send code)
    protected function hasTooManyWrongAttempts(Request $request)
    {
        // Lấy số lần nhập sai từ session
        $wrongAttempts = $request->session()->get('wrong_attempts', 0);

        // Kiểm tra xem số lần nhập sai có vượt quá ngưỡng cho phép không
        return $wrongAttempts >= $this->maxWrongAttempts;
    }

    //Xử lý mã xác nhận(send code) lấy từ mail người dùng 
    public function postSendCode(Request $request)
    {
        $sendCode = $request->send_code;
        //Lấy xác nhận sai, tăng số lần nhập sai
        if ($sendCode == session('send_code')) {
            return redirect(route('get-change-fp'))->with('success', 'Đổi mật khẩu đi pro');
        }
        $this->incrementWrongAttempts($request);
        // dd($this->incrementWrongAttempts($request));
        if ($this->hasTooManyWrongAttempts($request)) {
            // Nếu nhập sai quá 5 lần, chuyển đến trang bị khóa
            session()->forget('wrong_attempts');
            return redirect()->route('get-fp')->with('error', 'Bạn đã nhập sai mã xác nhận hơn 5 lần hả nhập lại mail để lấy mã xác nhận mới');
        } else {
            return redirect()->route('get-sendcode')->with('error', 'Mã xác nhận không chính xác vui lòng nhập lại');
        }
    }

    public function getChangeFP()
    {
        return view('client.auth.password.new-password');
    }

    //Hàm xử lý đổi mật khẩu khi nhập đúng mã xác nhận(send code)
    public function postChangeFP(Request $request)
    {
        $findEmail =  session('mail_forgotpassword');
        $checkmail = DB::collection('users')->where('email', $findEmail)->first();
        //Bắt lỗi nhập input
        $validator = Validator::make($request->all(), [
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|same:newPassword',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            //tìm mail lúc đầu người dùng nhập để lấy mã xác nhận(send code) để đổi mật khẩu

            $data = [
                'password' => Hash::make($request->confirmPassword),
            ];
            DB::collection('users')
                ->where('email', $findEmail)
                ->update($data);
            return "đổi mật khẩu thành công";
        }
    }
}
