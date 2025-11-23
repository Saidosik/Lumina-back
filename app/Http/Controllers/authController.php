<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cookie;


class AuthController extends Controller
{
    public function register(Request $request)
    {   
        $validated = $request->validate([
            'userName' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        //  return response()->json(['loginCheck' => $request], 201);
        $user = User::create([
            'userName' => $validated['userName'],
            'login' => $validated['login'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json(['message' => 'Registration successful'], 201);
    }

    public function login(Request $request)
    {
        // $request->validate([
        //     'login' => 'required|string',
        //     'password' => 'required|string',
        // ]);

        // // Авторизация по email или username
        // $user = User::where('email', $request->login)
        //             ->orWhere('userName', $request->login)
        //             ->first();

        // if (! $user || ! Hash::check($request->password, $user->password)) {
        //     throw ValidationException::withMessages([
        //         'login' => ['Invalid credentials.'],
        //     ]);
        //     return responce()->json(["error"]);
        // }

        // $token = $user->createToken('API Token')->plainTextToken;
        // return response()->json(['TOKEN' => $token], 200);


        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        if(Auth::attempt($credentials)){
            return response()->json(['message'=>Auth::user()->userName], 200);
        }
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