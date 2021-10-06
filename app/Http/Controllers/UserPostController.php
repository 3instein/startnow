<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class UserPostController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user) {
        return view('post.user.index', [
            'posts' => $user->posts,
            'hotPosts' => Post::orderBy('views', 'DESC')->take(4)->get()
        ]);
    }

    public function create() {
        return view('post.user.create', [
            'hotPosts' => Post::orderBy('views', 'DESC')->take(4)->get()
        ]);
    }

    public function createSlug(Request $request) {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
