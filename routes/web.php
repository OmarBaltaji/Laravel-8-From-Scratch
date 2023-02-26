<?php

use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
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

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentController::class, 'store']);

Route::post('newsletter', NewsLetterController::class);

Route::middleware('guest')->group(function () {
  Route::get('register', [RegisterController::class, 'create']);
  Route::post('register', [RegisterController::class, 'store']);
  
  Route::get('login', [SessionController::class, 'create']);
  Route::post('sessions', [SessionController::class, 'store']); 
});

Route::middleware('auth')->group(function() {
  Route::post('logout', [SessionController::class, 'destroy']);
  Route::post('follow/{user}', [FollowerController::class, 'store']);
});

Route::middleware('can:admin')->group(function() {
  Route::resource('admin/posts', AdminPostController::class)->except('show');
});

Route::feeds();