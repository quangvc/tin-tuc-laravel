<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/category/{id}', [HomeController::class, 'showCategory']);
Route::get('/post/{id}', [HomeController::class, 'showPost']);



Route::get('/create/post', [HomeController::class, 'userCreate'])->name('user.createpost')->middleware('auth:sanctum');
Route::post('/create/post/store', [HomeController::class, 'userStore'])->name('user.storepost')->middleware('auth:sanctum');

Route::post('/comment/store/{id}/{cmt_id}', [CommentController::class, 'store'])->name('comment_create')->middleware('auth:sanctum');


Route::middleware([
    'check_admin',
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']
    // function () {        
        // return view('dashboard');
    // }
    )->name('dashboard');
    Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('dashboard.create');
    Route::post('/dashboard/store', [DashboardController::class, 'store'])->name('admin.create');
    Route::get('/dashboard/edit/{id}', [DashboardController::class, 'edit']);
    Route::post('/dashboard/update/{id}', [DashboardController::class, 'update'])->name('admin.update');
    Route::get('/dashboard/delete/{id}', [DashboardController::class, 'destroy']);
});


Route::middleware([
    'check_admin',
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/dashboard/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/dashboard/category/store', [CategoryController::class, 'store'])->name('category.create');
    Route::get('/dashboard/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('/dashboard/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/dashboard/category/delete/{id}', [CategoryController::class, 'destroy']);
});

Route::middleware([
    'check_admin',
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard/post', [PostController::class, 'index'])->name('post');
    Route::get('/dashboard/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/dashboard/post/store', [PostController::class, 'store'])->name('post.create');
    Route::get('/dashboard/post/edit/{id}', [PostController::class, 'edit']);
    Route::post('/dashboard/post/update/{id}', [PostController::class, 'update'])->name('post.update');
    Route::get('/dashboard/post/delete/{id}', [PostController::class, 'destroy']);

    Route::get('/dashboard/post/update_status/{id}&{status}', [PostController::class, 'update_status'])->name('update_status');
});