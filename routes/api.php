<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PostController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/user', [AuthController::class, 'user']);
    Route::post('/me', [AuthController::class, 'me']);

    // Route::post('/sendMessage', [App\Http\Controllers\ChatController::class, 'sendMessage']);
    // Route::post('/checkSender', [App\Http\Controllers\ChatController::class, 'checkSender']);
    // Route::post('/getMess', [App\Http\Controllers\ChatController::class, 'showMessage']);
    // Route::post('/createChat', [App\Http\Controllers\ChatController::class, 'createChat']);
    // Route::post('/allChat', [App\Http\Controllers\ChatController::class, 'allChat']);
});

Route::get('/csrf-cookie', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::post('/sendMessage', [ChatController::class, 'sendMessage']);
Route::post('/checkSender', [ChatController::class, 'checkSender']);
Route::post('/getMess', [ChatController::class, 'showMessage']);
Route::post('/createChat', [ChatController::class, 'createChat']);
Route::get('/allChat', [ChatController::class, 'allChat']);

Route::post('/create-post', [PostController::class, 'createPost']);
