<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        
        $validated = $request->validate([
            'userName' => 'required|string|max:255|unique:users,userName',
            'email' => 'required|string|email|max:255|unique:users,email',
            'pass' => 'required|string|min:6|same:rePass',
        ]);
        
        $user = User::create([
            'name' => $validated['userName'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['pass']),
        ]);

        return response()->json(['message' => 'Registration successful'], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'pass' => 'required|string',
        ]);

        // Авторизация по email или username
        $user = User::where('email', $request->login)
                    ->orWhere('name', $request->login)
                    ->first();

        if (! $user || ! Hash::check($request->pass, $user->password)) {
            throw ValidationException::withMessages([
                'login' => ['Invalid credentials.'],
            ]);
        }

        // Создание токена
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ]);
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