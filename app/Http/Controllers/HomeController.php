<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostVoter;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index(Request $request) {
        $type = $request->query('type');
        $category = $request->query('category');

        $posts = Post::query()
            ->when($type, fn($builder) => $builder->whereTypeId($type))
            ->when($category, fn($builder) => $builder->whereCategoryId($category))
            ->orderBy('id', 'DESC')
            ->paginate(10)
            ->withQueryString();
        
        return view('home', [
            'categories' => Category::all(),
            'types' => Type::all(),
            'hotPosts' => Post::orderBy('views', 'DESC')->take(5)->get(),
            'posts' => $posts,
            'currentTimestamp' => Carbon::now(),
            'postVoters' => PostVoter::all()
        ]);
    }
}
