<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    public function imageUpload(Request $request) {

        $file = $request->thumbnail;
           
        $extension = $file->extension();

        $file_name = time().'-'.'avatar.'.$extension;
        
        $file->move(public_path('uploads/user/avatar'), $file_name);
        
        $img_url = 'uploads/posts/'.$file_name;

        return $img_url;
    }
}
