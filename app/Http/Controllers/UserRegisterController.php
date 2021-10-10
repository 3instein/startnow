<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserRegisterController extends Controller {
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'max:100']
        ]);
    }
}
