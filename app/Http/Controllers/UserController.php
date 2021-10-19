<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Routing\Controller;

class UserController extends Controller {
    public function index() {

    }

    public function show() {
        return view('profile', [
            'user' => auth()->user()
        ]);
    }
}
