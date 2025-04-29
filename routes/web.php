<?php

use App\Models\Member;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/hash/{string}', function ($string) {
    return bcrypt($string);
});

Route::get('/tes', function () {
    $member = Member::query()->first();
    return response()->json([
        'token' => $member->createToken('member-token', ['*'], now()->addWeek())->plainTextToken,
    ]);
});
