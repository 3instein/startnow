<?php

namespace App\Models;

use App\Http\Controllers\AuthenticationApiController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentApiController;
use App\Http\Controllers\PostApiController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchApiController;
use App\Http\Controllers\StartupApiController;
use App\Http\Controllers\VentureApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthenticationApiController::class, 'register']);
Route::post('/login', [AuthenticationApiController::class, 'login']);

Route::post('/search', [SearchApiController::class, 'index']);

Route::get('/posts', [PostApiController::class, 'index']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/posts/users',[PostApiController::class, 'users']);
    Route::post('/posts/{post:id}/vote', [PostApiController::class, 'vote']);
    Route::resource('posts', PostApiController::class)->except('index');
    Route::resource('comments', CommentApiController::class);
    Route::get('/startups/{startup}/members', [StartupApiController::class, 'members']);
    Route::get('/ventures/{venture}/members', [VentureApiController::class, 'members']);
    Route::resource('startups', StartupApiController::class);
    Route::resource('ventures', VentureApiController::class);
    Route::post('/logout', [AuthenticationApiController::class, 'logout']);
});

