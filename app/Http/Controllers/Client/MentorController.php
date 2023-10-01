<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Mentor;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MentorController extends Controller
{
    public function overview()
    {
        return view('client.mentor.overview');
    }
    public function register()
    {
        $mentor_check = Mentor::where('user_id', auth()->id())->first();
        if ($mentor_check) {
            if ($mentor_check->name || $mentor_check->profession) {
                return redirect()->route('mentor-upload-id-card');
            }
        }
        $data = (((Profession::select('id', 'name')->get())));
        return view('client.mentor.register', ['professions' => (implode(',', $data->pluck('name')->toArray())), 'id_professions' => (implode(',', $data->pluck('id')->toArray()))]);
    }
    public function handleRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:2', 'max:40', 'regex:/[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]+$/'],
            'username' => ['required', 'string', 'min:3', 'alpha_dash:ascii', Rule::unique('users')],
        ],
            [
                'name.required' => 'Vui lòng nhập tên.',
                'name.min' => 'Tên ít nhất phải :min ký tự!',
                'name.max' => 'Tên không được vượt quá :max ký tự!',
                'name.regex' => 'Tên không được chứa ký tự đặc biệt!',
                'username.required' => 'Vui lòng nhập tên đăng nhập.',
                'username.min' => 'Tên đăng nhập phải chứa ít nhất :min ký tự!',
                'username.alpha_dash' => 'Tên đăng nhập không được chứa ký tự đặc biệt!',
                'username.unique' => 'Tên đăng nhập đã có người dùng!',
            ]);
        $temp_profession = [];
        foreach ($request->except('_token', 'username', 'name', 'profession') as $key => $value) {

            if ($temp_key = Profession::find($key)) {
                if ($temp_key->name == $value) {
                    $temp_profession[] = $key;
                } else {

                    return redirect()->back()->with('not_found_profession', 'Chuyên ngành không hợp lệ, vui lòng thử lại');
                }

            } else {
                return redirect()->back()->with('not_found_profession', 'Không tìm thấy chuyên ngành, vui lòng thử lại');
            }
        }
        Mentor::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'username' => $request->username,
            'profession' => $temp_profession,
        ]);

        return redirect()->route('mentor-upload-id-card');
    }

    public function handleProfile(ProfileRequest $request)
    {
        $request->validated();
        $update_data = [];
        $request->name ? $update_data['name'] = $request->name : '';
        $request->username ? $update_data['username'] = $request->username : '';
        $user = Auth::user();

        if ($request->avatar) {
            $imagePath = \uniqid() . '.' . $request->file('avatar')->getClientOriginalExtension();
            $this->upload_file($imagePath, public_path('mentor/avatar'), $request->file('avatar'), true, $user->image['avatar']);
            $update_data['image.avatar'] = $imagePath;

        }
        Mentor::where('user_id', $user->id)->update($update_data);
        return redirect()->route('mentor-profile')->with('success', 'Thông tin đã được cập nhật thành công.');
    }
    public function profile()
    {
        $mentor = Mentor::where('user_id', Auth::id())->first();
        return view('client.mentor.profile', compact('mentor'));
    }
    public function uploadIdCard()
    {
        $mentor_check = Mentor::where('user_id', auth()->id())->first();
        if ($mentor_check) {
            if ($mentor_check->image['front_card'] && $mentor_check->image['back_card']) {
                return redirect()->route('mentor-face-verify');
            }
        }
        return view('client.mentor.id-card-upload');
    }
    public function takingPicture()
    {
        $mentor_check = Mentor::where('user_id', auth()->id())->first();
        if ($mentor_check) {
            if ($mentor_check->image['front_card'] && $mentor_check->image['back_card']) {
                return redirect()->route('mentor-face-verify');
            }
            return view('client.mentor.online-take-picture-id-card-confirm');
        }
    }

    public function handleUploadIdCard(Request $request)
    {
        $front_card_name = uniqid() . '.' . $request->file('front_card')->getClientOriginalExtension();
        $back_card_name = uniqid() . '.' . $request->file('back_card')->getClientOriginalExtension();
        $request->front_card->move(storage_path('cccd'), $front_card_name);
        $request->back_card->move(storage_path('cccd'), $back_card_name);
        Mentor::where('user_id', auth()->id())->first()->update([
            'image.front_card' => $front_card_name,
            'image.back_card' => $back_card_name,
        ]);
        return redirect()->route('mentor-profile');
    }
    public function faceVerify()
    {
        return 'sdas';
    }
}
