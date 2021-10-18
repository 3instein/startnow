<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Startup;
use App\Models\Venture;
use Illuminate\Http\Request;

class SearchController extends Controller {
    public function index() {
        return view('home', [
            'categories' => Category::all(),
            'hotPosts' => Post::orderBy('views', 'DESC')->take(4)->get(),
            'posts' => Post::latest()->filter(request(['search']))->paginate(7)->withQueryString(),
        ]);
    }

    public function searchBusiness(Request $request) {
        if ($request->input('search-radio') === 'startup') {
            $results = $request->input('search-business') ? Startup::latest()->filter(request(['search-business']))->paginate(5)->withQueryString() : '';
            
            return view('join', [
                'results' => $results,
                'type' => 'startup'
            ]);
        } else {
            return view('join', [
                'results' => Venture::all(),
                'type' => 'venture'
            ]);
        }
    }
}
