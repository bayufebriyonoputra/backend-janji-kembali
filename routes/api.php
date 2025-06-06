<?php

use App\Http\Controllers\Api\BannerApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Auth\Auth;
use App\Http\Middleware\JwtVerify;
use App\Models\OrderHeader;
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

Route::get('/products', [ProductApiController::class, 'getAllProduct']);
Route::get('/product/{id}', [ProductApiController::class, 'getProductById']);

//Order
Route::middleware([JwtVerify::class])->group(function() {
    Route::post('/order', [OrderApiController::class, 'makeOrder']);
});

// banner
Route::get('/banners', [BannerApiController::class, 'list']);

Route::get('/testing-api', function(){
    return OrderHeader::with('details')->get();
});


