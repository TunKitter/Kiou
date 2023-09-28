<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use Illuminate\Http\Request;

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
    public function handleRegister(Request $request)
    {
        return dd($request->all());
    }
    public function profile()
    {
        return view('client.mentor.profile');
    }
    public function uploadIdCard()
    {
        return view('client.mentor.id-card-upload');
    }
    public function takingPicture()
    {
        return view('client.mentor.online-take-picture-id-card-confirm');
    }

    public function handleUploadIdCard(Request $request)
    {
        return view('client.mentor.handle-id-card-confirm', ['image' => ($request->file('image')->getClientOriginalName())]);

    }
}
