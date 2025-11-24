<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/user', [AuthController::class, 'user']);
});

Route::post('/sendMessage', [App\Http\Controllers\ChatController::class, 'sendMessage']);
Route::post('/checkSender', [App\Http\Controllers\ChatController::class, 'checkSender']);
Route::post('/getMess', [App\Http\Controllers\ChatController::class, 'showMessage']);
Route::post('/createChat', [App\Http\Controllers\ChatController::class, 'createChat']);
Route::post('/allChat', [App\Http\Controllers\ChatController::class, 'allChat']);