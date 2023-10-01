<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller

{
    public function edit($id) {
        
        $user = User::find($id);
        return view('client.profile.profile', compact('user'));
    }

    public function update(ProfileRequest $request, $id) {
        $request->validated();
        $data = [
            'name' =>$request->firstname." ".$request->lastname,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
        ];
        User::find($id)->update($data);
        return redirect()->back()->with('success', 'Update profile succeful');
    }

    public function delete ($id) {
        User::destroy($id);

        return view('client.home.home');
    }

    public function password($id) {
        $user = User::find($id);
        return view('client.profile.update-pass', compact('user'));
    } 

    public function updatePassword (ProfileRequest $request, $id) {
        $user = User::find($id);
        $request->validated();

        if(Hash::check($request->password, $user->password)){
            if($request->new_password == $request->cf_password){
                $user->update([
                    'password' => Hash::make($request->new_password)
                ]);
                return redirect()->back()->with('success', 'Password updated successfully');
            }else {
                return redirect()->back()->with('error', 'Re-enter incorrect password');
            }
          
        }else {
            return redirect()->back()->with('error', 'Invalid password');
        }
    }
}
