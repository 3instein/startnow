<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;

class HomeController extends Controller {
    public function index() {
        return view('home', [
            'categories' => Category::all(),
            'hotPosts' => Post::orderBy('views', 'DESC')->take(5)->get(),
            'posts' => Post::orderBy('id', 'DESC')->paginate(10),
            'currentTimestamp' => Carbon::now()
        ]);
    }
}
