<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PostController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/login1', [AuthController::class, 'login1']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/user', [AuthController::class, 'user']);

    // Route::post('/sendMessage', [App\Http\Controllers\ChatController::class, 'sendMessage']);
    // Route::post('/checkSender', [App\Http\Controllers\ChatController::class, 'checkSender']);
    // Route::post('/getMess', [App\Http\Controllers\ChatController::class, 'showMessage']);
    // Route::post('/createChat', [App\Http\Controllers\ChatController::class, 'createChat']);
    // Route::post('/allChat', [App\Http\Controllers\ChatController::class, 'allChat']);
});

Route::get('/csrf-cookie', function (Request $request) {
    $token = csrf_token();
    
    // Устанавливаем cookie вручную
    $cookie = cookie(
        'XSRF-TOKEN', 
        $token, 
        60, // минуты
        null, // путь
        null, // домен
        $request->secure(), // secure flag
        true, // httpOnly false (чтобы JavaScript мог прочитать)
        false, // raw
        'lax' // sameSite
    );
    
    return response()->json([
        'success' => true,
        'message' => 'CSRF cookie установлен',
        'token' => $token,
        'timestamp' => now()->toISOString()
    ])->withCookie($cookie);
});

Route::post('/sendMessage', [ChatController::class, 'sendMessage']);
Route::post('/checkSender', [ChatController::class, 'checkSender']);
Route::post('/getMess', [ChatController::class, 'showMessage']);
Route::post('/createChat', [ChatController::class, 'createChat']);
Route::get('/allChat', [ChatController::class, 'allChat']);

Route::post('/create-post', [PostController::class, 'createPost']);
