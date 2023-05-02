<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class HomeController extends Controller
{
    public function index() {
        $posts = Post::with('user', 'category')->where('status', 1)->orderBy('updated_at', 'DESC')->get();      
        return view('welcome', compact('posts'));
    }

    public function showCategory($id) {
        $category =  DB::table('categories')->where('id', $id)->select('name')->get();
        // $category =  Category::where('id', $id)->select('name');
        $posts = Post::with('user', 'category')->where('category_id', $id)->where('status', 1)->orderBy('updated_at', 'DESC')->paginate(10);
        $all_posts = Post::all()->where('status', 1);
        return view('frontend.category.category', compact('posts', 'all_posts','category'));
    }

    public function showPost($id) {
        $post = Post::with('user', 'category')->where('id', $id)->where('status', 1)->orderBy('updated_at', 'DESC')->first();
        $all_posts = Post::all()->where('status', 1);
        $comments = Comment::with('user')->where('post_id', $id)->oldest()->get();       

        return view('frontend.post.post', compact('post', 'all_posts','comments'));
    }

    public function userCreate() {
        $all_posts = Post::all()->where('status', 1);
        $categories = Category::all();
    

        return view('frontend.post.create', compact('all_posts', 'categories'));
    }

    public function userStore(Request $request) {
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
        return back()->with('message', 'Created successfully. Wait for the Admin to public your post!');
    }

    // public function edit($id) {
    //     $categories = Category::all();
    //     $post = Post::find($id);
    //     return view('post.edit', compact('post', 'categories'));
    // }

    // public function update(Request $request, $id) {
    //     $request->validate([
    //         'title' => ['required', 'min:3', 'max:255', Rule::unique('posts')->ignore($request->id),]
    //     ]);
    //     $post = Post::find($id);
    //     $post->title = $request->title;
    //     $post->content = $request->content;        
    //     $post->category_id = $request->category;       
    //     $post->user_id = $request->user()->id;        
    //     if ($request->has('cover_img')) {
    //         $file = $request->cover_img;
    //         $post->cover_image = $file->getClientOriginalName();            
    //         $file->move(base_path('public/cover_images'), $post->cover_image);
    //     }              

    //     $post->save();
    //     return redirect('/dashboard/post')->with('message', 'Updated successfully');     
    // }

    // public function destroy($id) {
    //     Post::destroy($id);
    //     return redirect('/dashboard/post')->with('message', 'Deleted successfully');  
    // }

    // public function update_status(Request $request, $id) {
    //     $post = Post::find($id);
    //     $post->status = $request->status;

    //     $post->save();
    //     return redirect('/dashboard/post')->with('message', 'Changed status successfully');     
    // }
}
