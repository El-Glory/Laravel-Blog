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
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/posts', [PostController::class, 'postIndex']);
Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');


Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/addPost', [addPostController::class, 'index'])->name('addPost');
Route::post('/addPost', [addPostController::class, 'store']);

Route::get('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/editPost/{post}', [PostController::class, 'edit'])->name('edit');
Route::post('/editPost/{post}', [PostController::class, 'update'])->name('post.update');

Route::get('/posts/{post:title}', [PostController::class, 'show'])->name('posts.show');
