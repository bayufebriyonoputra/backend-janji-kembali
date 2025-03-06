<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Auth extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return Response::api(400, 'Failed', [
                $validator->errors()
            ]);
        }

        if (!$token = auth()->guard('api')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return Response::api(404, 'Failed', [
                'message' => 'Credentials not found'
            ]);
        }

        return Response::api(data: [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'email|required|unique:members,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return Response::api(400, 'Bad Request', [
                $validator->errors()
            ]);
        }

        $member = Member::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'join_date' => now()->toDateString()
        ]);

        $token = auth()->guard('api')->attempt(['email' => $request->email, 'password' => $request->password]);
        $res = [
            'token' => $token,
            'type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60,
            'user_data' => $member
        ];
        return Response::api(data: $res);
    }

    public function me()
    {
        return Response::api(data: [
            auth()->guard('api')->user()
        ]);
    }

    public function logout()
    {
        auth()->guard('api')->logout();
        return Response::api(data: [
            'message' => 'Logout Successfull'
        ]);
    }
}
