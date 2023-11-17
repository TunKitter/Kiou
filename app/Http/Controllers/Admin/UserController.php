<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listUser(Request $request)
    {
        // $users = User::orderBy('created_at', 'desc')->paginate(8);
        // if($request->ajax()){
        // $view = view('admin.users.data',compact('users'))->render();
        // return response()->json(['html' => $view]);
        // }
        $users = User::take(10)->get();
        $roles = Role::all()->pluck('name', 'id');
        // dd($roles);
        return view('admin.user.user', compact('users', 'roles'));
    }
    public function userMore($take, $skip)
    {
        return \response()->json(User::select('id', 'name', 'email', 'phone', 'created_at')->take($take)->skip($skip)->get());
    }
    public function store(Request $request)
    {
        $new_user = User::create($request->all());
        // $data = User::create($input);
        return response()->json(['data' => $new_user]);
    }
    public function editUser()
    {

        $data = User::find($id);

        return response()->json(['status' => true, 'message' => 'Cập nhật tài khoản thành công', 'data' => $data, 'url' => route('updateUser', $id)]);
    }
    public function updateUser()
    {
        $key = array_keys(request()->all())[1];
        $value = request()->all()[array_keys(request()->all())[1]];
        User::find(request()->id)->update([
            $key => $value,
        ]);
        return response()->json(['value' => 45, "key" => "123", "id" => request()->id]);

    }
    public function delete()
    {
        User::find(request()->id)->delete();
        return response()->json(['status' => true, 'message' => 'Delete user successfully']);
    }

}
