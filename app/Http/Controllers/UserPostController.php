<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index(){
        // return view('post.index', [
        //     'post' => Post::where('user_id', $user->id)->get(),
        //     'hotPosts' => Post::orderBy('views', 'DESC')->take(4)->get()
        // ]);
        return 'test';
    }
}
