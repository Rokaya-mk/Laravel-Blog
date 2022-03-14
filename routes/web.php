<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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
Route::resource('/posts', PostController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
