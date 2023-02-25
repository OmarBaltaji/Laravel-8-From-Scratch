<?php

// use App\Http\Controllers\NewsLetterController;

// use App\Http\Controllers\AdminPostController;
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
// Route::post('comments', [PostCommentController::class, 'store']);

Route::post('newsletter', NewsLetterController::class);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create'])->middleware('guest');
Route::post('sessions', [SessionController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::middleware('can:admin')->group(function() {
  // Route::get('admin/posts', [AdminPostController::class, 'index']);
  // Route::get('admin/posts/create', [AdminPostController::class, 'create']);
  // Route::post('admin/posts', [AdminPostController::class, 'store']);
  // Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
  // Route::patch('admin/posts/{post}', [AdminPostController::class, 'update']);
  // Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy']);
  Route::resource('admin/posts', AdminPostController::class)->except('show');
});

// Laravel Breeze
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';
