<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profession;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Profession::all();
        $categories_name = $categories->pluck('name', 'id');
        return view('admin.category.category', compact('categories', 'categories_name'));
    }
    public function delete()
    {
        return response()->json(['status' => Profession::find(request()->id)->delete()]);
    }
    public function update()
    {
        $key = array_keys(request()->all())[1];
        $value = request()->all()[array_keys(request()->all())[1]];
        if ($key == 'parent_profession') {
            $value = json_decode($value);
        }
        Profession::find(request()->id)->update([
            $key => $value,
        ]);
        return response()->json(['value' => $value, "key" => $key, "id" => request()->id]);
    }
    public function add()
    {
        $aa = Profession::create([
            'name' => request()->name,
            'parent_profession' => \json_decode(request()->profession),
        ]);
        return response()->json(['data' => $aa]);
    }
}
