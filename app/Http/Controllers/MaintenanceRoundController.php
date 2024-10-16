<?php

namespace App\Http\Controllers;

use App\Http\Resources\MaintenanceRoundIndexResource;
use App\Http\Resources\MaintenanceRoundResource;
use App\Models\ElementDetail;
use App\Models\MaintenanceRound;
use App\Models\MaintenanceRoundDetail;
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
                ->orderBy('id', 'DESC')
                ->limit(200)
                ->get();
        }

        return response()->json(MaintenanceRoundIndexResource::collection($maintenanceRounds), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $maintenanceRound = new MaintenanceRound();
        $maintenanceRound['employee_id'] = $request->employee_id;
        $maintenanceRound->save();

        return response()->json($maintenanceRound->id, 201);
    }

    public function store_complete(Request $request)
    {
        //dd($request->all());
        $maintenanceRound = new MaintenanceRound();
        $maintenanceRoundDetails = new MaintenanceRoundDetail();

        $maintenanceRound['employee_id'] = $request->employee_id;
        $maintenanceRound->save();

        $maintenanceRoundDetails['maintenance_round_id'] = $maintenanceRound->id;
        $maintenanceRoundDetails['site_id'] = $request->site_id;
        $maintenanceRoundDetails->save();
        foreach ($request->element_ids as $key => $value) {
            //dd($request->status[$key], $value);
            $element_detail = new ElementDetail();
            $element_detail['maintenance_round_detail_id'] = $maintenanceRoundDetails->id;
            $element_detail['element_id'] = $value;
            $element_detail['status'] = $request->status[$key];
            $element_detail['detail'] = $request->details[$key];
            $element_detail->save();
        }

        return response($maintenanceRound->id, 201);
    }

    public function update_complete(Request $request, $id)
    {
        $maintenanceRound = MaintenanceRound::findOrFail($id);
        $maintenanceRoundDetail = $maintenanceRound->maintenance_round_details->where('site_id', $request->site_id);
        if ($maintenanceRoundDetail->count() > 0) {
            return response('Ya registro este sitio', 208);
        }
        $maintenanceRoundDetails = new MaintenanceRoundDetail();
        $maintenanceRoundDetails['maintenance_round_id'] = $request->maintenance_round_id;
        $maintenanceRoundDetails['site_id'] = $request->site_id;
        $maintenanceRoundDetails->save();

        foreach ($request->element_ids as $key => $value) {
            //dd($request->status[$key], $value);
            $element_detail = new ElementDetail();
            $element_detail['maintenance_round_detail_id'] = $maintenanceRoundDetails->id;
            $element_detail['element_id'] = $value;
            $element_detail['status'] = $request->status[$key];
            $element_detail['detail'] = $request->details[$key];
            $element_detail->save();
        }
        //dd();

        return response('Lugar y elementos agregados', 201);
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
