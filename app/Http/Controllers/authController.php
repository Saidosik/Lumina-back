<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;


use Illuminate\Http\RedirectResponse;



class AuthController extends Controller
{
    public function register(Request $request)
    {   
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create($validated);

        if(!empty($user)){
            Auth::login($user);
            $request->session()->regenerate();

            return response()->json(['message' => 'Registration successful'], 201);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $request->session()->regenerate();
            
            return response()->json(['message' => __('Welcome!')]);
        }

        return response()->json(['message' =>'Неправильный пароль или имя'], 419);
    }


    public function me(Request $request)
    {
        return response()->json($request->user());
    }
   

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}