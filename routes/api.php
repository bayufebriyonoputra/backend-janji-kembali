<?php

use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Auth\Auth;
use App\Http\Middleware\JwtVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Auth
Route::post('/login', [Auth::class, 'login']);
Route::post('/register', [Auth::class, 'register']);
Route::get('/me', [Auth::class, 'me'])->middleware(JwtVerify::class);
Route::post('/logout', [Auth::class, 'logout'])->middleware(JwtVerify::class);

// Products
Route::middleware([JwtVerify::class])->group(function() {
});
Route::get('/products', [ProductApiController::class, 'getAllProduct']);
Route::get('/product/{id}', [ProductApiController::class, 'getProductById']);

