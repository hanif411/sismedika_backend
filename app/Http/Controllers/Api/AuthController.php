<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate(['email'=>"required|email", "password"=>"required"]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' =>'Invalid login'
            ],401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success'=>true,
            'message' => 'Login Succes',
            'token' => $token,
            'user' => $user,
            'role' => $user->role,
            'token_type' => 'Bearer',
        ], 200);
    }
}
