<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; 
use Validator;
class UserController extends Controller
{
    public function listUser(Request $request)
    {
        $users = User::orderBy('created_at', 'desc')->paginate(8);
        if($request->ajax()){
            $view = view('admin.users.data',compact('users'))->render();
            return response()->json(['html' => $view]);
        }

        return view('admin.users.list', compact('users'));
    }
    public function store(Request $request)
{
    $input = $request->all();

    $validation = Validator::make($input, [
        'name' => ['required', 'min:3', 'max:40', 'regex:/[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]+$/'],
        'phone' => ['required', 'string', 'alpha_dash:ascii', Rule::unique('users'), 'regex:/^0\d{9}$/'],
        'username' => [
            'required',
            'string',
            'min:6',
            'alpha_dash:ascii',
            Rule::unique('users'),
        ],

        'email' => [
            'email',
            'required',
            'string',
            'max:40',
            Rule::unique('users'),
        ],
        'password' => [
            'regex:/[!@#$%^&*()_+{}\[\]:;<>,.?~\\/\|]/',
            'required',
            'string',
            'min:6',
        ],
    ],[
        'email.required' => 'Vui lòng nhập địa chỉ email.',
        'email.email' => 'Địa chỉ email không hợp lệ!',
        'password.required' => 'Vui lòng nhập mật khẩu.',
        'password.min' => 'Mật khẩu phải chứa ít nhất :min ký tự!',
        'password.regex' => 'Mật khẩu phải chứa 1 ký tự đặc biệt!',
        'name.required' => 'Vui lòng nhập tên.',
        'name.min' => 'Tên ít nhất phải :min ký tự!',
        'name.max' => 'Tên không được vượt quá :max ký tự!',
        'phone.required' => 'Vui lòng nhập số điện thoại.',
        'phone.regex' => 'Số điện thoại không hợp lệ phải bắt đầu từ 0!',
        'username.required' => 'Vui lòng nhập tên đăng nhập.',
        'username.min' => 'Tên đăng nhập phải chứa ít nhất :min ký tự!',
        'username.max' => 'Tên đăng nhập không được vượt quá :max ký tự!',
        'username.unique' => 'Username đã tồn tại trong hệ thống!',
        'username.max' => 'Tên đăng nhập không được vượt quá :max ký tự!',
        'email.max' => 'Địa chỉ email không được vượt quá :max ký tự!',
        'email.unique' => 'Địa chỉ email đã tồn tại trong hệ thống!',
        'phone.unique' => 'Số điện thoại đã tồn tại trong hệ thống!',
        '*.alpha_dash' => ':attribute không được chứa ký tự đặc biệt!',
        'name.regex' => ':attribute không được chứa ký tự đặc biệt!',

    ]);

    if ($validation->fails()) {
        return response()->json(['errors' => $validation->errors()]);
    }

    $data = User::create($input);

    return response()->json(['status' => true, 'message' => 'Thêm tài khoản thành công', 'data' => $data]);
}
    public function editUser($id){

        $data = User::find($id);
        
        return response()->json(['status' => true, 'message' => 'Cập nhật tài khoản thành công', 'data' => $data,'url' => route('updateUser',$id)]);
    }
    public function updateUser(Request $request, $id){

        $input = $request->all();

        $validation = Validator::make($input, [
            'name' => ['required', 'min:3', 'max:40', 'regex:/[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]+$/'],
            'phone' => ['required', 'string', 'alpha_dash:ascii', Rule::unique('users'), 'regex:/^0\d{9}$/'],
            'username' => [
                'required',
                'string',
                'min:6',
                'alpha_dash:ascii',
                Rule::unique('users'),
            ],
    
            'email' => [
                'email',
                'required',
                'string',
                'max:40',
                Rule::unique('users'),
            ],
    ],[
        'email.required' => 'Vui lòng nhập địa chỉ email.',
        'email.email' => 'Địa chỉ email không hợp lệ!',
        'name.required' => 'Vui lòng nhập tên.',
        'name.min' => 'Tên ít nhất phải :min ký tự!',
        'name.max' => 'Tên không được vượt quá :max ký tự!',
        'phone.required' => 'Vui lòng nhập số điện thoại.',
        'phone.regex' => 'Số điện thoại không hợp lệ phải bắt đầu từ 0!',
        'username.required' => 'Vui lòng nhập tên đăng nhập.',
        'username.min' => 'Tên đăng nhập phải chứa ít nhất :min ký tự!',
        'username.max' => 'Tên đăng nhập không được vượt quá :max ký tự!',
        'username.unique' => 'Username đã tồn tại trong hệ thống!',
        'username.max' => 'Tên đăng nhập không được vượt quá :max ký tự!',
        'email.max' => 'Địa chỉ email không được vượt quá :max ký tự!',
        'email.unique' => 'Địa chỉ email đã tồn tại trong hệ thống!',
        'phone.unique' => 'Số điện thoại đã tồn tại trong hệ thống!',
        '*.alpha_dash' => ':attribute không được chứa ký tự đặc biệt!',
        'name.regex' => ':attribute không được chứa ký tự đặc biệt!',
    ]);

    if ($validation->fails()) {
        return response()->json(['errors' => $validation->errors()]);
    }

    User::find($id)->update($input);

    return response()->json(['status' => true, 'message' => 'Cập nhật tài khoản thành công', 'data' => $input,'id'=> $id]);
    }
    public function delete($id){
        User::find($id)->delete();

        return response()->json(['status' => true, 'message' => 'Xóa tài khoản thành công']);
    }

}
