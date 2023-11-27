<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {

        $data = json_decode('[' . $request->information_cart . ']');
        $user = Auth::user();
        foreach ($data as $key) {
            $array_coures_id[] = $key->courses->_id;
            session([$user->username => [$array_coures_id]]);
        }

        return view('client.checkout.checkout', ['carts' => $data]);
    }
}
