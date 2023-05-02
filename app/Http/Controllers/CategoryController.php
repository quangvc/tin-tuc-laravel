<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::orderBy('id', 'DESC')->search()->paginate(10);
        // DB::table('categories')
        return view('category.index', compact('categories'));
    }

    public function create() {
        $categories = Category::all();
        return view('category.create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|min:3|max:30|unique:categories,name'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;        

        $category->save();
        return redirect('/dashboard/category')->with('message', 'Created successfully');
    }

    public function edit($id) {
        $categories = Category::all();
        $category = Category::find($id);
        return view('category.edit', compact('category', 'categories'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => ['required', 'min:3', 'max:30', Rule::unique('categories')->ignore($request->id),]
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;   

        $category->save();  
        return redirect('/dashboard/category')->with('message', 'Updated successfully');      
    }

    public function destroy($id) {
        if (Post::where('category_id', $id)->count() > 0) {
            return redirect('/dashboard/category')->with('error', 'Cannot delete this category. You need to delete all posts in this category!');
        } else {
            Category::destroy($id);
            return redirect('/dashboard/category')->with('message', 'Deleted successfully');
        }
    }

}
