<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // validasi data form
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid login',
            ], 401);
        }

        // cocokin datanya sama di database
        if (Auth::attempt($request->only(['username', 'password']))) {
            $user = Auth::user();
            $token = $user->createToken('token');

            return response()->json([
                'token' => $token->plainTextToken,
            ]);
        }

        // kalo loginnya gagal
        return response()->json([
            'message' => 'invalid login',
        ], 401);
    }

    public function logout()
    {
        // ambil user yg lagi login
        $user = Auth::user();

        // delete token
        $user->tokens()->delete();

        return response()->json([
            'message' => 'logout success',
        ]);
    }
}
