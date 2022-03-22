<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/secret', [HomeController::class, 'secret'])->name('secret')->middleware('can:secret.page');
Route::get('/posts/archive', [PostController::class, 'archive'])->name('posts.archive');
Route::get('/posts/all', [PostController::class, 'all'])->name('posts.all');
Route::patch('/posts/{id}/restore ', [PostController::class, 'restore']);
Route::delete('/posts/{id}/forceDelete ', [PostController::class, 'forceDelete']);
Route::resource('posts', PostController::class);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/posts/tag/{id} ', [PostTagController::class, 'index'])->name('posts.tag');
Route::post('posts/comments/{post} ', [PostCommentController::class,'store'])->name('posts.comment.store');

//User routes
Route::resource('users', UserController::class)->only(['show','edit','update']);
Route::resource('users.comments', UserCommentController::class)->only(['store']);