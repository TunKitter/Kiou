<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
{
    public function blog(){

        $blogs = Post::paginate(4);
        $blog_categories  = PostCategory::all();
        
        return view("client.blog.blog", compact('blogs','blog_categories'));
    }

    public function blogDetail($slug) {
        $blog = Post::where('slug', $slug)->first();
       
        $content = Storage::disk('public')->get($blog->content);
       
        return view("client.blog.blog-detail", compact('blog', 'content'));
    }

    public function blogInCategory ($slug) {
         $slug = PostCategory::select('_id')->where('slug',$slug)->first();
         $blogInCategory = Post::where('category_id',$slug->_id)->paginate(4);
         $blog_categories  = PostCategory::all();
         return view('client.blog.blog-in-category', compact('blogInCategory','blog_categories'));
    }


}
