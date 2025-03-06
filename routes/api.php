<?php

use App\Http\Controllers\Auth\Auth;
use App\Http\Middleware\JwtVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [Auth::class, 'login']);
Route::post('/register', [Auth::class, 'register']);
Route::get('/me', [Auth::class, 'me'])->middleware(JwtVerify::class);
