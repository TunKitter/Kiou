<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class CheckoutController extends Controller
{
    public function index(Request $request){

        $data = json_decode('[' . $request->infomation_cart . ']');

        $user = Auth::user();

        foreach ($data as $key) {

            $array_coures_id[] = $key->courses->_id;

            session([$user->username =>[$array_coures_id]]);
        }
        return view('client.checkout.checkout', ['carts' => $data]);
    }
    public function checkout(Request $request){

        $user = User::findOrFail(Auth::user()->id);

        $userId = Auth::id();

        $carts = Enrollment::where('user_id', $userId)->get();

        $course = Enrollment::where('user_id', $userId)->where('course_id', $request->course_id)->first();
        
        return view("client.checkout.checkout", compact("user","carts","course"));
    }

}
