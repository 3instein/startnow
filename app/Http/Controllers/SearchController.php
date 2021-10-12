<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller {
    public function index() {
        return view('index', [
            'categories' => Category::all(),
            'hotPosts' => Post::orderBy('views', 'DESC')->take(4)->get(),
            "post" => Post::latest()->search(request(['search']))
        ]);
    }

    public function byCategory() {

    }
}
