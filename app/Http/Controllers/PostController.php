<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function index() {
        // $posts = DB::table('posts')->paginate(10);
        $posts = Post::with('user')->orderBy('id', 'DESC')->search()->paginate(10);        
        // if ($key = request()->key) {
        //     $posts = Post::with('user')->where('title','like', "%$key%")->paginate(10);            
        // }
        return view('post.index', compact('posts'));
    }

    public function create() {
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|min:3|max:255|unique:posts,title'
        ]);
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;        
        $post->category_id = $request->category;       
        $post->user_id = $request->user()->id;        
        if ($request->has('cover_img')) {
            $file = $request->cover_img;
            $post->cover_image = $file->getClientOriginalName();            
            $file->move(base_path('public/cover_images'), $post->cover_image);
        }        

        $post->save();
        return redirect('/dashboard/post')->with('message', 'Created successfully');
    }

    public function edit($id) {
        $categories = Category::all();
        $post = Post::find($id);
        return view('post.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => ['required', 'min:3', 'max:255', Rule::unique('posts')->ignore($request->id),]
        ]);
        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;        
        $post->category_id = $request->category;       
        $post->user_id = $request->user()->id;        
        if ($request->has('cover_img')) {
            $file = $request->cover_img;
            $post->cover_image = $file->getClientOriginalName();            
            $file->move(base_path('public/cover_images'), $post->cover_image);
        }              

        $post->save();
        return redirect('/dashboard/post')->with('message', 'Updated successfully');     
    }

    public function destroy($id) {
        Post::destroy($id);
        return redirect('/dashboard/post')->with('message', 'Deleted successfully');  
    }

    public function update_status(Request $request, $id) {
        $post = Post::find($id);
        $post->status = $request->status;

        $post->save();
        return redirect('/dashboard/post')->with('message', 'Changed status successfully');     
    }

}
