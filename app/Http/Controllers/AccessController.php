<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessController extends Controller
{
    public function setIn(Request $request)
    {

        $access = new Access();
        $access['branche_id'] = $request['branche_id'];
        $access['user_id'] = $request['user_id'];
        $access['date_time_in'] = $request['date_time_in'];
        
        $access->save();

        return response()
            ->json(['message' => 'Create'],200);
    }
}
