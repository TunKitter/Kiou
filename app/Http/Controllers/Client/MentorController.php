<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use App\Http\Requests\MentorRequest;
use App\Models\Profession;
use App\Models\Mentor;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;



class MentorController extends Controller
{
    public function overview()
    {
        return view('client.mentor.overview');
    }
    public function register()
    {
        $data = (((Profession::select('id', 'name')->get())));
        return view('client.mentor.register', ['professions' => (implode(',', $data->pluck('name')->toArray())), 'id_professions' => (implode(',', $data->pluck('id')->toArray()))]);
    }
    public function handleRegister(MentorRequest $request)
    {
        $request->validated();
         // Kiểm tra nếu người dùng đã đăng ký mentor
    if (Mentor::where('user_id', auth()->id())->exists()) {
        return redirect()->route('mentor-overview')->withSuccess('Bạn đã đăng ký là Mentor.');
    }
    // Tạo mentor mới và lưu vào cơ sở dữ liệu
    Mentor::create([
        'user_id' => auth()->id(),
        'name' => $request->name,
        'profession' =>$request->profession,
    ]);

    return redirect()->route('mentor-overview')->with('success','Đăng ký Mentor thành công.');
    }
    public function edit()
    {
    $mentor = Mentor::where('user_id', Auth::id())->first();
    return view('client.mentor.profile', compact('mentor'));
    }
    public function update(Request $request)
    {
    // Get the mentor record
    $mentor = Mentor::where('user_id', Auth::id())->first();

    // Update mentor name
    $mentor->name = $request->input('name');

    // Update mentor image if provided
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('mentor_images', 'public');
        $mentor->image = $imagePath;
    }

    $mentor->save();

    // Update user username
    $user = User::find(Auth::id());
    $user->username = $request->input('username');
    $user->save();

    return redirect()->route('edit-profile')->with('success', 'Thông tin đã được cập nhật thành công.');
}
    public function profile()
    {
        return view('client.mentor.profile');
    }
}
