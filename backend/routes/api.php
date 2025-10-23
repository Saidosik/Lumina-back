<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/catalog', function (Request $request) {
    return response()->json([
        'data' => [
            ['id' => 1, 'name' => 'Товар 1'],
            ['id' => 2, 'name' => 'Товар 2'],
        ]
    ]);
});