<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index () {
        
        $userId = Auth::id();
        $carts = Enrollment::where('user_id',$userId)->get();
        
        return view('client.cart.cart', compact('carts'));
    }

    public function store(Request $request) {

        $data = [
            'course_id' => $request->course_id,
            'user_id' => Auth::id(),
            'price' => ['course' => $request->price],
        ];

        $userId = Auth::id();
        $course = Enrollment::where('user_id',$userId)->where('course_id', $request->course_id )->first(); 

        if ($course) {
            
            return redirect()->back()->with('error', 'The course already exists in the shopping cart.');
        }else {
            Enrollment::create($data);

            return redirect()->back()->with('success', 'Add to cart successfully');
        }
    }

    public function delete($id) {
        Enrollment::find($id)->delete();
        return redirect()->back()->with('success', 'Delete cart successfully');
  }

}
