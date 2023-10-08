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
    public function index()
    {

        $user = Auth::user();
        return view('client.profile.profile', compact('user'));
    }

    public function update(ProfileRequest $request)
    {
        $data = [];
        $request->name ? $data['name'] = $request->name : '';
        $request->username ? $data['username'] = $request->username : '';
        $request->phone ? $data['phone'] = $request->phone : '';
        $request->email ? $data['email'] = $request->email : '';
        $imagePath = '';

        $request->validated();
        if ($request->avatar) {
            $imagePath = \uniqid() . '.' . $request->avatar->getClientOriginalExtension();
            $data['image.avatar'] = $imagePath;
        }
        $request->validated();
        $user = User::find(Auth::id());
        if ($request->avatar) {
            $this->upload_file($imagePath, public_path('user/avatar'), $request->avatar, true, $user->image['avatar']);
        }

        $user->update($data);
        return redirect()->back()->with('success', 'Update profile successful');
    }

    public function delete($id)
    {

        User::destroy($id);

        return view('client.home.home');
    }


    public function password()
    {
        $user = Auth::user();
        return view('client.profile.update-pass', compact('user'));
    }

    public function handlePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate(
            [
                'password' => ['required', 'string', 'min:6'],
                'new_password' => ['required', 'string', 'min:6'],
                'cf_password' => ['required', 'string', 'min:6'],
            ],
            [
                'password.required' => 'Password is required',
                'new_password.required' => 'New password is required',
                'cf_password.required' => 'Confirm password is required',
                'password.min' => 'Password must be at least 6 characters',
                'new_password.min' => 'New password must be at least 6 characters',
                'cf_password.min' => 'Confirm password must be at least 6 characters',
            ]
        );

        if (Hash::check($request->password, $user->password)) {
            if ($request->new_password == $request->cf_password) {
                $user->update([
                    'password' => Hash::make($request->new_password),
                ]);
                return redirect()->back()->with('success', 'Password updated successfully');
            } else {
                return redirect()->back()->with('error', 'Re-enter incorrect password');
            }

        } else {
            return redirect()->back()->with('error', 'Invalid password');
        }
    }
    public function deleteAvatar()
    {
        auth()->user()->update(['image.avatar' => 'avatar.jpg']);
        return 1;
    }

}
