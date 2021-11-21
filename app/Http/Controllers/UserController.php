<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Type;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller {
    public function show() {
        return view('update', [
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request) {
        $user = $request->user();

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', Rule::unique('users')->ignore($user->username, 'username'), 'max:30'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', Rule::unique('users')->ignore($user->email, 'email')],
        ]);

        if ($request->file('profile_photo_path')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['profile_photo_path'] = $request->file('profile_photo_path')->store('public/user-images');
        }

        $user->update($validatedData);
        return redirect()->route('home')->with('success', 'Profil berhasil diperbarui!');
    }
}
