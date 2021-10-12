<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller {
    public function index() {
        return view('home', [
            'categories' => Category::all(),
            'hotPosts' => Post::orderBy('views', 'DESC')->take(4)->get(),
            'posts' => Post::latest()->filter(request(['search']))->paginate(7)->withQueryString(),
        ]);
    }

    public function byCategory() {

    }
}
