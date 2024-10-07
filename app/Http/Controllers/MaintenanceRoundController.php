<?php

namespace App\Http\Controllers;

use App\Http\Resources\MaintenanceRoundResource;
use App\Models\MaintenanceRound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceRoundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Auth::user()->roles->first();
        //dd($roles->name);
        if ($roles->name == 'super_admin') {
            $maintenanceRounds = MaintenanceRound::select()
                ->limit(200)
                ->get();
        }

        return response()->json(MaintenanceRoundResource::collection($maintenanceRounds), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $maintenanceRound = new MaintenanceRound();
        $maintenanceRound['employee_id'] = $request->employee_id;
        $maintenanceRound->save();

        return response()->json(new MaintenanceRoundResource($maintenanceRound), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $maintenanceRound =  MaintenanceRound::findOrFail($id);

        return response()->json(new MaintenanceRoundResource($maintenanceRound), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $maintenanceRound =  MaintenanceRound::findOrFail($id);
        $maintenanceRound['employee_id'] = $request->employee_id;
        $maintenanceRound->save();

        return response()->json(new MaintenanceRoundResource($maintenanceRound), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
