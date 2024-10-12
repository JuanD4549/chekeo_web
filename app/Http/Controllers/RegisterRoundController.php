<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegisterRoundIndexResource;
use App\Http\Resources\RegisterRoundResource;
use App\Models\RegisterRound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterRoundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Auth::user()->roles->first();
        //dd($roles->name);
        if ($roles->name == 'super_admin') {
            $registerRounds = RegisterRound::select('*')
                ->orderBy('id', 'DESC')
                ->limit(200)
                ->get();
            //dd($registerRounds);

            return response()
                ->json(RegisterRoundIndexResource::collection($registerRounds), 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branche_id' => 'required|string',
            'place_id' => 'required|string',
            'security_guard_id' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $registerRound = new RegisterRound();
        $registerRound['branche_id'] = $request->branche_id;
        $registerRound['place_id'] = $request->place_id;
        $registerRound['security_guard_id'] = $request->security_guard_id;

        $registerRound->save();
        return response()
            ->json($registerRound->id, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //dd($id);
        $register_round = RegisterRound::findOrFail($id);
        return response()->json(new RegisterRoundResource($register_round), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $registerRound = RegisterRound::findorFail($id);
        $registerRound['date_time_closed'] = $request->date_time_closed;
        $registerRound['detail_close'] = $request->detail_close;

        $registerRound->save();
        return response()->isOk();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegisterRound $registerRound)
    {
        //
    }
}
