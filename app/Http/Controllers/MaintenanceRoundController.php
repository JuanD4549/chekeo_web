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
        $maintenanceRound = new MaintenanceRound();
        $maintenanceRoundDetails = new MaintenanceRoundDetail();
        $element_detail = new ElementDetail();

        $maintenanceRound['employee_id'] = $request->employee_id;
        $maintenanceRound->save();

        $maintenanceRoundDetails['maintenance_round_id'] = $maintenanceRound->id;
        $maintenanceRoundDetails['site_id'] = $request->site_id;
        $maintenanceRoundDetails->save();

        $element_detail['maintenance_round_detail_id'] = $maintenanceRoundDetails->id;
        $element_detail['element_id'] = $request->element_id;
        $element_detail['status'] = $request->status;
        $element_detail['detail'] = $request->detail;
        $element_detail->save();

        return response($maintenanceRound->id, 201);
    }

    public function update_complete(Request $request, $id)
    {
        $maintenanceRound = MaintenanceRound::findOrFail($id);
        $maintenanceRoundDetail = $maintenanceRound->maintenance_round_details->where('site_id', $request->site_id);
        $maintenanceRoundDetails = new MaintenanceRoundDetail();
        $element_detail = new ElementDetail();
        if ($maintenanceRoundDetail->count() > 0) {
            $maintenanceRoundDetailId = $maintenanceRoundDetail[0]->id;
            $element_details = ElementDetail::where('maintenance_round_detail_id', $maintenanceRoundDetailId)
                ->where('element_id', $request->element_id)
                ->get();
            if ($element_details->count() > 0) {
                return response('Ya registro este elemento', 208);
            }
            $element_detail['maintenance_round_detail_id'] = $maintenanceRoundDetailId;
            $element_detail['element_id'] = $request->element_id;
            $element_detail['status'] = $request->status;
            $element_detail['detail'] = $request->detail;
            $element_detail->save();
            return response('Elemento agregado', 201);
            //dd($element_details);
        }
        $maintenanceRoundDetails['maintenance_round_id'] = $request->maintenance_round_id;
        $maintenanceRoundDetails['site_id'] = $request->site_id;
        $maintenanceRoundDetails->save();

        $element_detail['maintenance_round_detail_id'] = $maintenanceRoundDetails->id;
        $element_detail['element_id'] = $request->element_id;
        $element_detail['status'] = $request->status;
        $element_detail['detail'] = $request->detail;
        $element_detail->save();
        //dd();

        return response('Lugar y elemento agregado', 201);
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
