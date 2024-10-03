<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json(['message' => 'Sin autorizacion'], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();
        $toke = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json([
                'message' => 'Hi',
                'accessToken' => $toke,
                'token_type' => 'Bearer',
                'user' => $user
            ]);
    }
}
