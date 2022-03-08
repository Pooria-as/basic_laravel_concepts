<?php

use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\PostLikeController;
use App\Http\Controllers\UserPostController;
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

Route::get('/post', [PostController::class, 'index'])->name('post.index');
Route::get('/user/{user:username}/posts', [UserPostController::class, 'index'])->name(
    'user.post.index'
);

Route::post('/post', [PostController::class, 'store']);
Route::delete('/post/{post}/delete', [PostController::class, 'destroy'])->name(
    'post.destroy'
);

Route::post('/post/{post}/like', [PostLikeController::class, 'like'])->name(
    'post.like'
);
Route::delete('/post/{post}/Delete', [
    PostLikeController::class,
    'unLike',
])->name('post.dislike');

Auth::routes();

Route::get('/home', [
    App\Http\Controllers\HomeController::class,
    'index',
])->name('home');
