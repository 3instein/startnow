<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchApiController extends Controller
{
    public function index() {
        return response()->json(
            Post::latest()
            ->filter(request(['search']))
            ->join('users', 'user_id', 'users.id')
            ->get([
                'posts.*', 'users.name'
            ]), 200);
    }
}
