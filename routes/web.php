<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StartupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentureController;
use App\Models\Venture;
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

Route::get('/search', [SearchController::class, 'index']);

Route::post('/posts/{post:slug}/vote', [PostController::class, 'updateVote'])->name('posts.vote');

Route::get('/filter', [PostController::class, 'filter'])->name('posts.filter');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('posts', PostController::class);
    Route::get('/startups/{startup}/members', [StartupController::class, 'members'])->name('startups.members');
    Route::delete('/startups/members/{user}/remove', [StartupController::class, 'membersRemove'])->name('startups.members.remove');
    Route::delete('/ventures/members/{user}/remove', [VentureController:: class, 'membersRemove'])->name('ventures.members.remove');
    Route::get('/startups/{startup}/join', [StartupController::class, 'join'])->name('startups.join');
    Route::get('/ventures/{venture}/join', [VentureController::class, 'join'])->name('ventures.join');
    Route::get('/startups/{startup}/requests', [StartupController::class, 'requests'])->name('startups.requests');
    Route::get('/ventures/{venture}/requests', [VentureController::class, 'requests'])->name('ventures.requests');
    Route::get('/startups/requests/{joinRequest}/accept', [StartupController::class, 'requestsAccept'])->name('startups.requests.accept');
    Route::delete('/startups/requests/{joinRequest}/reject', [StartupController::class, 'requestsReject'])->name('startups.requests.reject');
    Route::get('/ventures/requests/{joinRequest}/accept', [VentureController::class, 'requestsAccept'])->name('ventures.requests.accept');
    Route::delete('/ventures/requests/{joinRequest}/reject', [VentureController::class, 'requestsReject'])->name('ventures.requests.reject');
    Route::resource('startups', StartupController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('ventures', VentureController::class);
    Route::get('/ventures/{venture}/members', [VentureController::class, 'members'])->name('ventures.members');
    Route::get('/defineSlug', [PostController::class, 'defineSlug']);
    Route::get('/join', function () {
        return view('join');
    })->name('join');
    Route::post('/join', [SearchController::class, 'searchBusiness'])->name('search');
    Route::get('/profile', [UserController::class, 'show'])->name('users.profile');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
