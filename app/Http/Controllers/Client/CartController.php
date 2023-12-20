<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $meta_title = "Cart | KIOU";
        $userId = Auth::id();
        $carts = Enrollment::where('user_id', $userId)->where('state','65337ecc289241e845e578d9')->get();
        return view('client.cart.cart', compact('carts', 'meta_title'));
    }

    public function store(Request $request)
    {
        request()->session()->forget(auth()->id());
        $data = [
            'course_id' => $request->course_id,
            'user_id' => Auth::id(),
            'price' => ['course' => $request->price],
            'state' => '65337ecc289241e845e578d9',
        ];

        $userId = Auth::id();
        $course = Enrollment::where('user_id', $userId)->where('course_id', $request->course_id)->first();

        if ($course) {

            return redirect()->back()->with('cart_already', 'The course already exists in the shopping cart.');
        } else {
            Enrollment::create($data);
            return redirect()->back()->with('success', 'Add to cart successfully');
        }
    }

    public function delete($id)
    {
        Enrollment::find($id)->delete();
        request()->session()->forget(auth()->id());
        return redirect()->back()->with('success', 'Delete cart successfully');
    }

}
