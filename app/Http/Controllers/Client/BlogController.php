<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function post(){

        $posts = Post::all();

        return view("client.blog.blog",compact('posts'));
    }
    public function showPost(string $slug)
{
    $post = Post::where('content_path', 'posts/' . $slug . '.html')->first();

    if (!$post) {
        // Xử lý trường hợp không tìm thấy bài viết, ví dụ: chuyển hướng hoặc hiển thị thông báo lỗi
        return view('client.blog.blog');
    }

    return view('client.blog.detail', compact('post'));
}

}
