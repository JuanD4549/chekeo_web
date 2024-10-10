<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScheduledMaintenanceEmployeeResource;
use App\Models\ScheduledMaintenanceEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduledMaintenanceEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Auth::user()->roles->first();
        //dd($roles->name);
        if ($roles->name == 'super_admin') {
            $scheduledMaintenanceEmployees = ScheduledMaintenanceEmployee::limit(200)
                ->get();
        }
        return response()->json(ScheduledMaintenanceEmployeeResource::collection($scheduledMaintenanceEmployees), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $scheduledMaintenanceEmployee = new  ScheduledMaintenanceEmployee();
        $scheduledMaintenanceEmployee['employee_id'] = $request->employee_id;
        $scheduledMaintenanceEmployee['scheduled_maintenance_id'] = $request->scheduled_maintenance_id;
        $scheduledMaintenanceEmployee['leader'] = $request->leader;
        $scheduledMaintenanceEmployee->save();

        return response()->json(new ScheduledMaintenanceEmployeeResource($scheduledMaintenanceEmployee), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $scheduledMaintenanceEmployee =  ScheduledMaintenanceEmployee::findOrFail($id);

        return response()->json(new ScheduledMaintenanceEmployeeResource($scheduledMaintenanceEmployee), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $scheduledMaintenanceEmployee =  ScheduledMaintenanceEmployee::findOrFail($id);
        $scheduledMaintenanceEmployee['employee_id'] = $request->employee_id;
        $scheduledMaintenanceEmployee['scheduled_maintenance_id'] = $request->scheduled_maintenance_id;
        $scheduledMaintenanceEmployee['leader'] = $request->leader;
        $scheduledMaintenanceEmployee->save();

        return response()->json(new ScheduledMaintenanceEmployeeResource($scheduledMaintenanceEmployee), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
