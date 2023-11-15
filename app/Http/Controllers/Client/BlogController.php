<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Models\Post;


class BlogController extends Controller
{
    public function blog(){

        $blogs = Post::paginate(4);
        $blog_categories  = PostCategory::all();
        
        return view("client.blog.blog", compact('blogs','blog_categories'));
    }


}
