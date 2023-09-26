<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class ProfileController extends Controller
{
    public function edit($id) {
        
        $user = User::find($id);
        return view('client.profile.profile', compact('user'));
    }
}
