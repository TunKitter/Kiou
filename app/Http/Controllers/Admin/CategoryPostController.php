<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryPostController extends Controller
{
    public function listCategory()
    {
        $categories = PostCategory::all();

        return view('admin.category-posts.list', compact('categories'));
    }
    public function storeCategory(Request $request)
    {
        $input = $request->all();
    
        $validation = Validator::make($input, [
            'name' => ['required', 'min:3', 'max:40',Rule::unique('post_categories')]
        ],[
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'name.min' => 'Tên ít nhất phải :min ký tự!',
            'name.max' => 'Tên không được vượt quá :max ký tự!',
            'name.unique' => 'Tên danh mục đã tồn tại trong hệ thống!',
        ]);
    
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()]);
        }
    
        // Tạo slug từ tên danh mục
        $slug = Str::slug($input['name']);
    
        $input['slug'] = $slug;
    
        $data = PostCategory::create($input);
    
        return response()->json(['status' => true, 'message' => 'Thêm danh mục thành công', 'data' => $data]);
    }
    
    public function editCategory($id)
    {

        $data = PostCategory::find($id);

        return response()->json(['status' => true, 'message' => 'Cập nhật tài khoản thành công', 'data' => $data, 'url' => route('updateUser', $id)]);
    }
    public function updateCategory(Request $request, $id)
    {
        $input = $request->all();

        // $validation = Validator::make($input, [
        //     'name' => ['required', 'min:3', 'max:40', 'regex:/[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]+'],
        // ], [
        //     'name.required' => 'Vui lòng nhập tên.',
        //     'name.min' => 'Tên ít nhất phải :min ký tự!',
        //     'name.max' => 'Tên không được vượt quá :max ký tự!',
        // ]);

        // if ($validation->fails()) {
        //     return response()->json(['errors' => $validation->errors()]);
        // }

        // Lấy danh mục cần cập nhật
        $category = PostCategory::find($id);

        if ($category) {
            // Cập nhật trường name
            $category->name = $input['name'];

            // Tự động cập nhật trường slug dựa trên name
            $category->slug = Str::slug($input['name']);

            $category->save();

            return response()->json(['status' => true, 'message' => 'Cập nhật danh mục thành công', 'data' => $category]);
        } else {
            return response()->json(['status' => false, 'message' => 'Không tìm thấy danh mục', 'data' => null]);
        }
    }
    public function delete($id){
        PostCategory::find($id)->delete();

        return response()->json(['status' => true, 'message' => 'Xóa danh mục thành công']);
    }
    
}
