<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \stdClass;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('name', 'password'))) {
            return response()
                ->json(['message' => 'Sin autorizacion'], 401);
        }
        $user = User::where('name', $request['name'])->firstOrFail();
        //dd($user);
        $toke = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json([
                'message' => 'Hi',
                'accessToken' => $toke,
                'token_type' => 'Bearer',
                'user' => new UserResource($user),
            ]);
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Cerrado'
        ];
    }
}
