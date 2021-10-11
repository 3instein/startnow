<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthenticationApiController extends Controller
{
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required'], 
        ]);

        if(!Auth::attempt($validatedData)){
            return $this->error('Credentials not match', 401);
        }

        return ([
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ]);
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
