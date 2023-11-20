<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{
    public function stripe(Request $request)
    {

        $user = auth()->user();
        $data = session($user->username); //array
        $count_data = count($data[0]);

        for ($i = 0; $i < $count_data; $i++) {
            $array_data[] = $data[0][$i];
        }
        $carts = Course::whereIn('_id', $array_data)->get();

        $productItems = [];
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        foreach ($carts as $cart) {
            $name  = $cart->name;
            $price = $cart->price;
            $qty   = 1;

            $two0 = "00";
            $unit_amount = "$price$two0";


            $productItems[] = [
                'price_data' => [
                    'product_data' => [
                        'name' => $name,
                    ],
                    'currency'     => 'USD',
                    'unit_amount'  => $unit_amount,
                ],
                'quantity' => $qty
            ];
        }

        $checkoutSession = \Stripe\Checkout\Session::create([
            'line_items'            => [$productItems],
            'mode'                  => 'payment',
            'allow_promotion_codes' => true,
            'metadata'              => [
                'user_id' => "0001"
            ],
            'customer_email' => $user->email, //$user->email,
            'success_url' => route('success'),
            'cancel_url'  => route('cancel'),
        ]);
        return redirect()->away($checkoutSession->url);
    }


    public function success()
    {
        $enrollment_lesstion_id = Enrollment::where('user_id', auth()->user()->_id)->get();
        $chapter = Chapter::select('infor')->whereIn('course_id',session(auth()->user()->username)[0])->get()->toArray();
        $chapter = array_map(function ($chapter) {
            return array_key_first($chapter['infor']);
        },$chapter);
        
        $lesson = Lesson::select('id', 'course_id')->whereIn('chapter.1',$chapter)->where('chapter.2','0')->get()->pluck('_id','course_id');
        // dd( $lesson);
        // $enrollments = Enrollment::where('user_id', auth()->user()->_id)->whereIn('course_id', session(auth()->user()->username)[0])->get();
        $test = [];
        foreach(session(auth()->user()->username)[0] as $lesson2){
            $test[] =  Enrollment::where('user_id', auth()->user()->_id,'course_id')->where('course_id', $lesson2)->first()->update([
                'lesson_id' => $lesson[$lesson2],
                'state' => '65347ec024cfaf917eaad1b1'
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
        return view('client.stripe.pay-success');
    }

    public function cancel()
    {
        Session::forget(auth()->user()->username);
        return redirect(route('cart'));
    }
}
