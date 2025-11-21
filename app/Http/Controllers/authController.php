<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cookie;


class AuthController extends Controller
{
    public function register(Request $request)
    {   
        $validated = $request->validate([
            'userName' => 'required|string|max:255|unique:users,userName',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|same:rePassword',
        ]);
        
        $user = User::create([
            'userName' => $validated['userName'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json(['message' => 'Registration successful'], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Авторизация по email или username
        $user = User::where('email', $request->login)
                    ->orWhere('userName', $request->login)
                    ->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'login' => ['Invalid credentials.'],
            ]);
        }

        // Создание токена
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['message' => 'Login successful'])->cookie(
            'auth_token',
            $token,
            config('sanctum.expiration', 60 * 24 * 7), // используем настройки Sanctum
            '/',
            env('SESSION_DOMAIN'), // из конфига
            true,  // secure - true для production
            true,  // httpOnly - защита от XSS
            false,
            'none'  // или 'strict' для большей безопасности
        );

        
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