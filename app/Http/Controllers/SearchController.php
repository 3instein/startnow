<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Type;
use App\Models\Startup;
use App\Models\Venture;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller {
    public function index() {
        return view('home', [
            'categories' => Category::all(),
            'types' => Type::all(),
            'hotPosts' => Post::orderBy('views', 'DESC')->take(5)->get(),
            'posts' => Post::latest()->filter(request(['search']))->paginate(10)->withQueryString(),
            'currentTimestamp' => Carbon::now()
        ]);
    }

    public function searchBusiness(Request $request) {
        if ($request->input('search-business') != '') {
            if ($request->input('type') === 'startup') {
                $results = $request->input('search-business') ? Startup::latest()->filter(request(['search-business']))->paginate(5)->withQueryString() : '';

                return view('join', [
                    'results' => $results,
                    'type' => 'startup',
                    'currentTimestamp' => Carbon::now()
                ]);
            } else {
                $results = $request->input('search-business') ? Venture::latest()->filter(request(['search-business']))->paginate(5)->withQueryString() : '';

                return view('join', [
                    'results' => $results,
                    'type' => 'venture',
                    'currentTimestamp' => Carbon::now()
                ]);
            }
        } else {
            if ($request->input('type') === 'startup') {
                return view('join', [
                    'results' => Startup::latest()->paginate(5)->withQueryString(),
                    'type' => 'startup',
                    'currentTimestamp' => Carbon::now()
                ]);
            } else {
                return view('join', [
                    'results' => Venture::latest()->paginate(5)->withQueryString(),
                    'type' => 'venture',
                    'currentTimestamp' => Carbon::now()
                ]);
            }
        }
    }
}
