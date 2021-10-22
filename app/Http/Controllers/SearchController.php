<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Startup;
use App\Models\Venture;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller {
    public function index() {
        return view('home', [
            'categories' => Category::all(),
            'hotPosts' => Post::orderBy('views', 'DESC')->take(4)->get(),
            'posts' => Post::latest()->filter(request(['search']))->paginate(10)->withQueryString(),
            'currentTimestamp' => Carbon::now()
        ]);
    }

    public function searchBusiness(Request $request) {
        if ($request->input('search-radio') === 'startup') {
            $results = $request->input('search-business') ? Startup::latest()->filter(request(['search-business']))->paginate(5)->withQueryString() : '';
            
            return view('join', [
                'results' => $results,
                'type' => 'startup',
                'currentTimestamp' => Carbon::now()
            ]);
        } else {
            return view('join', [
                'results' => Venture::all(),
                'type' => 'venture',
                'currentTimestamp' => Carbon::now()
            ]);
        }
    }
}
