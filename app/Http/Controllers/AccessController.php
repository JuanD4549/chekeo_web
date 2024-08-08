<?php

namespace App\Http\Controllers;

use App\Filament\Funcions\Logica;
use App\Models\Access;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessController extends Controller
{
    public function setIn(Request $request)
    {
        //dd($request);
        $message = 'Permitido';
        $codeStatus = 200;
        $url = null;
        try {
            $user = User::select('id', 'avatar_url', 'branche_id', 'name')
                ->where('ci', $request['ci'])
                ->firstOrFail();
        } catch (\Throwable $th) {
            $message = 'Usario no existe';
            $codeStatus = 401;
        }

        try {
            $message = (new Logica)->saveAccessIn($user->branche_id, $user);
        } catch (\Throwable $th) {
            $codeStatus = 500;
        }

        if ($user->avatar_url != null) {
            $url = url('storage/' . $user->avatar_url);
        }
        return response()
            ->json([
                'message' => $message,
                'user' => [
                    'avatar_url' => $url, 'name' => $user->name
                ]
            ], $codeStatus);
    }

    public function setOut(Request $request)
    {
        $message = 'Hasta luego';
        $codeStatus = 200;
        $url = null;
        try {
            $user = User::select('id', 'avatar_url', 'branche_id', 'name')
                ->where('ci', $request['ci'])
                ->firstOrFail();
            if ($user->avatar_url != null) {
                $url = url('storage/' . $user->avatar_url);
            }
        } catch (\Throwable $th) {
            $message = 'Usuario no existe';
            $codeStatus = 401;
        }
        try {
            $today = Carbon::today();
            $access = Access::select('id', 'user_id','date_time_out')
                ->where('user_id', $user->id)
                ->whereDate('created_at', $today)
                ->where('date_time_out', null)
                ->latest()
                ->firstOrFail();
            $access['date_time_out'] = Carbon::now();
            $access->save();
        } catch (\Throwable $th) {
            $message = 'Sin Registro previo';
            $codeStatus = 401;
        }
        return response()
            ->json([
                'message' => $message,
                'user' => [
                    'avatar_url' => $url, 'name' => $user->name
                ]
            ], $codeStatus);
    }
}
