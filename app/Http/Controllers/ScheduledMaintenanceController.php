<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScheduledMaintenanceResource;
use App\Models\ScheduledMaintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduledMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Auth::user()->roles->first();
        //dd($roles->name);
        if ($roles->name == 'super_admin') {
            $scheduledMaintenances = ScheduledMaintenance::limit(200)
                ->get();
        }
        return response()->json(ScheduledMaintenanceResource::collection($scheduledMaintenances), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $scheduledMaintenance = new ScheduledMaintenance();
        $scheduledMaintenance['site_id'] = $request->site_id;
        $scheduledMaintenance['priority'] = $request->priority;
        $scheduledMaintenance['description'] = $request->description;
        $scheduledMaintenance['for_days'] = $request->for_days;
        $scheduledMaintenance['in_day_time'] = $request->in_day_time;
        $scheduledMaintenance['days'] = $request->days;
        $scheduledMaintenance['months'] = $request->months;
        $scheduledMaintenance['days_num'] = $request->days_num;
        $scheduledMaintenance['the'] = $request->the;
        $scheduledMaintenance->save();

        return response()->json(new ScheduledMaintenanceResource($scheduledMaintenance), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $scheduledMaintenance = ScheduledMaintenance::findOrFail($id);

        return response()->json(new ScheduledMaintenanceResource($scheduledMaintenance), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $scheduledMaintenance = ScheduledMaintenance::findOrFail($id);
        $scheduledMaintenance['site_id'] = $request->site_id;
        $scheduledMaintenance['priority'] = $request->priority;
        $scheduledMaintenance['description'] = $request->description;
        $scheduledMaintenance['for_days'] = $request->for_days;
        $scheduledMaintenance['in_day_time'] = $request->in_day_time;
        $scheduledMaintenance['days'] = $request->days;
        $scheduledMaintenance['months'] = $request->months;
        $scheduledMaintenance['days_num'] = $request->days_num;
        $scheduledMaintenance['the'] = $request->the;
        $scheduledMaintenance->save();

        return response()->json(new ScheduledMaintenanceResource($scheduledMaintenance), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
