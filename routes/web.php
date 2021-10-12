<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StartupController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\UserStartupController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/search', [SearchController::class, 'index']);
Route::get('/post-viewers', [PostController::class, 'updatePostViewers'])->name('post-viewers');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('posts', PostController::class);
    Route::resource('startups', StartupController::class);
    Route::resource('comments', CommentController::class);
    Route::get('/defineSlug', [PostController::class, 'defineSlug']);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
