<?php

use App\Http\Controllers\Auth\addPostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PostController;
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

Route::get('/admin/home', function () {
    return view('auth.home');
})->name('home');
Route::get('/admin/login', [LoginController::class, 'index'])->name('login');
Route::post('/admin/login', [LoginController::class, 'store']);

Route::get('/posts', [PostController::class, 'postIndex']);
Route::get('/admin/dashboard', [PostController::class, 'index'])->name('dashboard');


Route::get('/admin/register', [RegisterController::class, 'index'])->name('register');
Route::post('/admin/register', [RegisterController::class, 'store']);

Route::post('/admin/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/admin/addPost', [addPostController::class, 'index'])->name('addPost');
Route::post('/admin/addPost', [addPostController::class, 'store']);

Route::get('admin/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/admin/editPost/{post}', [PostController::class, 'edit'])->name('edit');
Route::post('/admin/editPost/{post}', [PostController::class, 'update'])->name('post.update');

Route::get('/posts/{post:title}', [PostController::class, 'show'])->name('posts.show');
