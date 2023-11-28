<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function vnpay_payment()
    {
        $user = auth()->user();
        $data = session($user->username);
        $count_data = count($data[0]);

        for ($i = 0; $i < $count_data; $i++) {
            $array_data[] = $data[0][$i];
        }
        $carts = Course::whereIn('_id', $array_data)->get();

        $productItems = [];

        foreach ($carts as $cart) {
            $price = $cart->price;
            $two0 = "00";
            $unit_amount = "$price$two0";

            $productItems[] = [
                'price_data' => [
                    'currency' => 'USD',
                    'unit_amount' => $unit_amount,
                ],
            ];

            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
            $vnp_TmnCode = "549LO489"; //Mã website tại VNPAY
            $vnp_HashSecret = "HZVHPGSKMAMFTYXLKQQOLZESXUTSARDS"; //Chuỗi bí mật

            $vnp_TxnRef = [$productItems]; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = "Thanh toán hóa đơn";
            $vnp_OrderType = "Thanh toán khóa học";
            $vnp_Amount = "$unit_amount" * 24000;
            $vnp_Locale = "VN";
            $vnp_BankCode = "";
            $vnp_IpAddr = "127.0.0.1";
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => "vn",
                "vnp_OrderInfo" => "thanh toán 10000",
                "vnp_OrderType" => "topup",
                "vnp_ReturnUrl" => route('success'),
                "vnp_TxnRef" => uniqid(),
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            return redirect($vnp_Url);
        }
    }
    public function success()
    {
        $enrollment_lesstion_id = Enrollment::where('user_id', auth()->user()->_id)->get();
        $chapter = Chapter::select('infor')->whereIn('course_id', session(auth()->user()->username)[0])->get()->toArray();
        $chapter = array_map(function ($chapter) {
            return array_key_first($chapter['infor']);
        }, $chapter);

        $lesson = Lesson::select('id', 'course_id')->whereIn('chapter.1', $chapter)->where('chapter.2', '0')->get()->pluck('_id', 'course_id');
        // dd( $lesson);
        // $enrollments = Enrollment::where('user_id', auth()->user()->_id)->whereIn('course_id', session(auth()->user()->username)[0])->get();
        $test = [];
        foreach (session(auth()->user()->username)[0] as $lesson2) {
            $test[] = Enrollment::where('user_id', auth()->user()->_id, 'course_id')->where('course_id', $lesson2)->first()->update([
                'lesson_id' => $lesson[$lesson2],
                'state' => '65347ec024cfaf917eaad1b1',
            ]);
        };
        // dd($test);

        // foreach ($enrollments as $enrollment) {
        //     $state = $enrollment->state;
        //     $enrollment['state'] = '65347ec024cfaf917eaad1b1';
        //     Enrollment::where('user_id', auth()->user()->_id)->update([
        //         'state' => '65347ec024cfaf917eaad1b1'
        //     ]);
        // }

        Session::forget(auth()->user()->username);
        return redirect(route('home'));
    }

    public function cancel()
    {
        Session::forget(auth()->user()->username);
        return redirect(route('cart'));
    }
}
