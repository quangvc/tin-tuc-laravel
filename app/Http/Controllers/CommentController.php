<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Session;
use App\Mail\SendMail;

class CommentController extends Controller
{
    public function index() {
        $comments = Comment::orderBy('created_at', 'DESC')->get();
        // DB::table('categories')
        return view('category.index', compact('categories'));
    }

    // public function create() {
    //     $categories = Comment::all();
    //     return view('category.create', compact('categories'));
    // }

    public function store(Request $request, $id, $cmt_id) {
        $request->validate([
            'content' => 'required|min:3|max:255'
        ]);
// dd($cmt_id);
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = $request->user()->id;
        $comment->post_id = $id;
        $comment->parent_id = $cmt_id;      

        $comment->save();

        $email_post = $comment->post->user->email;
        $username_post = $comment->post->user->name;
        $username_cmt = $request->user()->name;
        $content = $comment->content;

        if ($comment->post->user->id != $request->user()->id) {
            
            Mail::send('emails.sendmail', compact('username_cmt', 'content' ), function($email) use ($username_cmt, $username_post, $email_post) {
             $email->subject("World: $username_cmt đã bình luận về bài viết của bạn");
             $email->to($email_post, $username_post);
           }); 
        }

        return redirect("/post/$id")->with('message', 'Commented successfully');
    }

    // public function edit($id) {
    //     $categories = Comment::all();
    //     $category = Comment::find($id);
    //     return view('category.edit', compact('category', 'categories'));
    // }

    // public function update(Request $request, $id) {
    //     $request->validate([
    //         'name' => ['required', 'min:3', 'max:30', Rule::unique('categories')->ignore($request->id),]
    //     ]);
    //     $category = Comment::find($id);
    //     $category->name = $request->name;
    //     $category->parent_id = $request->parent_id;   

    //     $category->save();  
    //     return redirect('/dashboard/category')->with('message', 'Updated successfully');      
    // }

    // public function destroy($id) {
    //     if (Post::where('category_id', $id)->count() > 0) {
    //         return redirect('/dashboard/category')->with('error', 'Cannot delete this category. You need to delete all posts in this category!');
    //     } else {
    //         Comment::destroy($id);
    //         return redirect('/dashboard/category')->with('message', 'Deleted successfully');
    //     }
    // }
}
