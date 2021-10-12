<?php

namespace App\Models;

use App\Http\Controllers\AuthenticationApiController;
use App\Http\Controllers\PostApiController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchApiController;
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
    Route::resource('posts', PostApiController::class)->except('index');
    Route::post('/logout', [AuthenticationApiController::class, 'logout']);
});

