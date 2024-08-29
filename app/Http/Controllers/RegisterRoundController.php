<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegisterRoundResource;
use App\Models\RegisterRound;
use Illuminate\Http\Request;

class RegisterRoundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function points(){
        
    }
    public function index()
    {
        $message = 'Exito';
        $codeStatus = 200;
        $registerRounds = RegisterRound::select('*')
            ->orderBy('id', 'DESC')
            ->get();

        return response()
            ->json([
                'message' => $message,
                'registerRounds' => RegisterRoundResource::collection($registerRounds),
            ], $codeStatus);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = 'Exito';
        $codeStatus = 201;

        $registerRound = new RegisterRound();
        $registerRound['branche_id'] = $request->branche_id;
        $registerRound['place_id'] = $request->place_id;
        $registerRound['user_id'] = $request->user_id;

        $registerRound->save();
        return response()
            ->json(new RegisterRoundResource($registerRound), $codeStatus);
    }

    /**
     * Display the specified resource.
     */
    public function show(RegisterRound $registerRound)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RegisterRound $registerRound)
    {
        //$message = 'Exito';
        $codeStatus = 200;

        $registerRound = RegisterRound::find($request->id);
        $registerRound['date_time_closed'] = $request->date_time_closed;
        $registerRound['detail_close'] = $request->detail_close;

        $registerRound->save();
        return response()
            ->json(new RegisterRoundResource($registerRound), $codeStatus);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegisterRound $registerRound)
    {
        //
    }
}
