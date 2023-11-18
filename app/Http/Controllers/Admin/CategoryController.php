<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profession;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Profession::all();
        return view('admin.category.category', compact('categories'));
    }
    public function delete()
    {
        return response()->json(['status' => Profession::find(request()->id)->delete()]);
    }
    public function update()
    {
        $key = array_keys(request()->all())[1];
        $value = request()->all()[array_keys(request()->all())[1]];
        Profession::find(request()->id)->update([
            $key => $value,
        ]);
        return response()->json(['value' => $value, "key" => $key, "id" => request()->id]);
    }
    public function add()
    {
        return response()->json(['data' => Profession::create(request()->all())]);
    }
}
