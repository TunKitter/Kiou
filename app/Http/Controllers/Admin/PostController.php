<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostRequest;
class PostController extends Controller
{
    public function index () {

        $posts = Post::all();
       
        return view('admin.posts.list', compact('posts'));
    }

    public function create () {
        $postCategories = PostCategory::all();
        return view('admin.posts.add', compact('postCategories'));
    }
    public function upload (Request $request) {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName .'_'.time(). '.'. $extension;
            $request->file('upload')->move(public_path('posts'), $fileName);

            $url = asset('posts/'. $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }

    public function store (PostRequest $request) {
         $content = $request->content;
         $content_path = 'posts/'.Str::of($request->title)->slug('-').'.html';
         Storage::disk('public')->put($content_path, $content);
   
            Post::create([
                'title'=> $request->title,
                'slug' => Str::of($request->title)->slug('-').'',
                'description' => $request->description,
                'category_id' => $request->category_id,
                'content' => $content_path,
            ]);

        return redirect()->route('list-posts');
    }

    public function edit ($slug) {
        $post = Post::where('slug', $slug)->first();
        $content = Storage::disk('public')->get($post->content);
        $postCategories = PostCategory::all();
        return view('admin.posts.edit',compact('post', 'postCategories','content'));
    }

    public function update (Request $request, $slug) {
        Storage::disk('public')->delete('posts/'.$slug.'.html');
        $content = $request->content;
         $content_path = 'posts/'.Str::of($request->title)->slug('-').'.html';
         Storage::disk('public')->put($content_path, $content);
        Post::where('slug',$slug)->update([
                'title'=> $request->title,
                'slug' => Str::of($request->title)->slug('-').'',
                'description' => $request->description,
                'category_id' => $request->category_id,
                'content' => $content_path,
            ]);
            return redirect()->route('list-posts');
    }
    public function delete($id) {

        Post::find($id)->delete();
        return redirect()->back();
    }
}
