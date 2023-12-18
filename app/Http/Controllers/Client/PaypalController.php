<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\Chapter;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
class PaypalController extends Controller
{
    public function handlePayment(Request $request)
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

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success.payment'),
                "cancel_url" => route('cancel.payment'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $carts
                    ]
                ]
                    ],
            'shipping_address' => false
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('cancel.payment')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('create.payment')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function paymentCancel()
    {
        return redirect()
            ->route('create.payment')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }

    public function paymentSuccess(Request $request)
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
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('home')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('checkout')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
}
