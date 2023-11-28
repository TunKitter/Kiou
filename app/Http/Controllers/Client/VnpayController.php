<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class VnpayController extends Controller
{
    public function create(Request $request)
    {
        $user = auth()->user();
        $data = session($user->username); //array
        $count_data = count($data[0]);

        for ($i = 0; $i < $count_data; $i++) {
            $array_data[] = $data[0][$i];
        }
        $carts = Course::whereIn('_id', $array_data)->sum('price');
        session(['cost_id' => $request->id]);
        session(['url_prev' => url()->previous()]);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
            $vnp_TmnCode = "549LO489"; //Mã website tại VNPAY
            $vnp_HashSecret = "HZVHPGSKMAMFTYXLKQQOLZESXUTSARDS"; //Chuỗi bí mật

            $vnp_TxnRef = ""; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = "Thanh toán hóa đơn";
            $vnp_OrderType = "Thanh toán khóa học";
            $vnp_Amount = $carts * 24000  * 100;
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
    public function return(Request $request)
{
    $url = session('url_prev','/');
    if($request->vnp_ResponseCode == "00") {
        $this->apSer->thanhtoanonline(session('cost_id'));
        return redirect($url)->with('success' ,'Đã thanh toán phí dịch vụ');
    }
    session()->forget('url_prev');
    return redirect($url)->with('errors' ,'Lỗi trong quá trình thanh toán phí dịch vụ');
}
}
