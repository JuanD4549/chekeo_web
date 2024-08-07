<?php

namespace App\Http\Controllers;

use App\Filament\Funcions\Logica;
use App\Models\Access;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessController extends Controller
{
    public function setIn(Request $request)
    {
        //dd($request);
        try {
            $user = User::select('id', 'avatar_url', 'branche_id', 'name')
                ->where('ci', $request['ci'])
                ->firstOrFail();
        } catch (\Throwable $th) {
            return response()
                ->json([
                    'message' => "Don't access",

                ], 404);
        }

        try {
            (new Logica)->saveAccessIn($user->branche_id, $user);
            $url = null;
            if ($user->avatar_url != null) {
                $url = url('storage/' . $user->avatar_url);
            }
        } catch (\Throwable $th) {
            return response()
                ->json([
                    'message' => "Don't branche",

                ], 500);
        }

        return response()
            ->json([
                'message' => 'Create',
                'user' => [
                    'avatar_url' => $url, 'name' => $user->name
                ]
            ], 200);
    }
}
