<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Profession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $professions = Profession::all();
        // dd($user->toArray()['profession']);
        $user_professions = array_map(function ($profession_id) use ($professions) {
            return array_filter($professions->toArray(), function ($profession) use ($profession_id) {
                return $profession['_id'] == $profession_id;
            });
        }, $user->toArray()['profession']);
        $user_professions = implode(',', array_map(function ($profession) {
            return $profession[array_key_first($profession)]['name'];
        }, $user_professions));
        return view('client.profile.profile', compact('user', 'professions', 'user_professions'));
    }

    public function update(ProfileRequest $request)
    {
        $data = [];
        $request->name ? $data['name'] = $request->name : '';
        $request->username ? $data['username'] = $request->username : '';
        $request->phone ? $data['phone'] = $request->phone : '';
        $request->email ? $data['email'] = $request->email : '';
        $request->profession ? $data['profession'] = explode(',', $request->profession) : '';
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
        if ($user->password == null) {
            return \redirect()->route('profile');
        }
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
        return \response()->json(['status' => 'success']);
    }

}
