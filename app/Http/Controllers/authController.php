<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\RedirectResponse;



class AuthController extends Controller
{
    public function register(Request $request)
    {   
        $validated = $request->validate([
            'userName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'login' => 'required|string|max:255|unique:users,login',
            'password' => 'required|string|min:6|same:rePassword',
        ]);
        
        $user = User::create([
            'userName' => $validated['userName'],
            'email' => $validated['email'],
            'login' => $validated['login'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json(['message' => 'Registration successful'], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            
            return response()->json(['message' => __('Welcome!')]);
        }
        // if (! $user || ! Hash::check($request->password, $user->password)) {
        //     throw ValidationException::withMessages([
        //         'login' => ['Invalid credentials.'],
        //     ]);
        //     return responce()->json(["error"]);
        // }

        //$token = $user->createToken('API Token')->plainTextToken;
        // return response()->json(['TOKEN' => $token], 200);
        
    }
    
    public function login1(Request $request)
    { 
        return response()->json($request->all());
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