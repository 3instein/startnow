<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index() {
        return view('home', [
            'categories' => Category::all(),
            'hotPosts' => Post::orderBy('views', 'DESC')->take(3)->get(),
            'posts' => Post::all()
        ]);
    }
}
