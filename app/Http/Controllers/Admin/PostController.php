<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function listPost()
    {

        $posts = Post::all();

        return view("admin.posts.list", compact("posts"));
    }
    public function addPost()
    {

        return view("admin.posts.add");
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'html' => '',
        ]);
    
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
    
        // Lưu hình ảnh nếu được tải lên
        if ($request->hasFile('html')) {
            $image = $request->file('html');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/posts/html', $imageName);
            $post->html = 'public/posts/html/' . $imageName;
        }
    
        $post->save();
    
        // Tạo và lưu file HTML vào thư mục "storage/posts"
        $slug = Str::slug($post->title, '-');
        $html = '<html><head><title>' . $post->title . '</title></head><body>';
        $html .= "<h2>{$post->title}</h2>";
        $html .= "<p>{$post->content}</p>";
    
        // Thêm hình ảnh nếu có
        if ($post->html) {
            $html .= "<img src='" . asset($post->html) . "' alt='Hình ảnh'>";
        }
    
        $html .= '</body></html>';
    
        $htmlFileName = 'posts/' . $slug . '.html';
    
        Storage::put($htmlFileName, $html);
    
        // Cập nhật đường dẫn trang HTML vào cơ sở dữ liệu
        $post->content_path = $htmlFileName;
        $post->save();
    
        return redirect()->route('listPost');
    }
    public function generateHtml()
{
    $posts = Post::all();

    foreach ($posts as $post) {
        $slug = Str::slug($post->title, '-');
        $htmlFileName = 'posts/' . $slug . '.html';

        $html = '<html><head><title>' . $post->title . '</title></head><body>';
        $html .= "<p>{$post->content}</p>";

        // Thêm hình ảnh nếu có
        if (!empty($post->images)) {
            $html .= "<img src='" . asset($post->images) . "' alt='Hình ảnh'>";
        }

        $html .= '</body></html>';

        // Lưu nội dung vào thư mục "storage/posts"
        Storage::put($htmlFileName, $html);

        // Cập nhật đường dẫn trang HTML vào cơ sở dữ liệu
        $post->content_path = $htmlFileName;
        $post->save();
    }

    return view('admin.posts.list', ['posts' => $posts]);
}
}
