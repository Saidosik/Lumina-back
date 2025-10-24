<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\apiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/form', [apiController::class, 'form'])->name('form');

Route::get('/catalog', function (Request $request) {
    return response()->json([
        'data' => [
            ['id' => 1, 'name' => 'name 1'],
            ['id' => 2, 'name' => 'name 2'],
        ]
    ]);
});

Route::post('/forma', [apiController::class, 'forma'])->name('forma');