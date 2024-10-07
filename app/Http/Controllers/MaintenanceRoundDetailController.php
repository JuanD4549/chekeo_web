<?php

namespace App\Http\Controllers;

use App\Http\Resources\MaintenanceRoundDetailResource;
use App\Models\MaintenanceRoundDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceRoundDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Auth::user()->roles->first();
        //dd($roles->name);
        if ($roles->name == 'super_admin') {
            $maintenanceRoundDetails = MaintenanceRoundDetail::limit(200)
                ->get();
        }
        return response()->json(MaintenanceRoundDetailResource::collection($maintenanceRoundDetails), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $maintenanceRoundDetails = new MaintenanceRoundDetail();
        $maintenanceRoundDetails['maintenance_round_id'] = $request->maintenance_round_id;
        $maintenanceRoundDetails['site_id'] = $request->site_id;
        $maintenanceRoundDetails->save();

        return response()->json(new MaintenanceRoundDetailResource($maintenanceRoundDetails), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $maintenanceRoundDetails = MaintenanceRoundDetail::findOrFail($id);

        return response()->json(new MaintenanceRoundDetailResource($maintenanceRoundDetails), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $maintenanceRoundDetails = MaintenanceRoundDetail::findOrFail($id);
        $maintenanceRoundDetails['maintenance_round_id'] = $request->maintenance_round_id;
        $maintenanceRoundDetails['site_id'] = $request->site_id;
        $maintenanceRoundDetails->save();

        return response()->json(new MaintenanceRoundDetailResource($maintenanceRoundDetails), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
