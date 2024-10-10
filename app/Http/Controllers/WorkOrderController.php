<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkOrderResource;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Auth::user()->roles->first();
        //dd($roles->name);
        if ($roles->name == 'super_admin') {
            $workOrders = WorkOrder::limit(200)
                ->get();
        }
        return response()->json(WorkOrderResource::collection($workOrders), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $workOrder = new WorkOrder();
        //$workOrder['auto_generated'] = $request->
        $workOrder['site_id'] = $request->site_id;
        $workOrder['description'] = $request->description;
        $workOrder['priority'] = $request->priority;
        //$workOrder['state'] = $request->state;
        $workOrder['img1_url'] = $request->img1_url;
        $workOrder['img2_url'] = $request->img2_url;
        $workOrder->save();

        return response()->json(new WorkOrderResource($workOrder), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $workOrder = WorkOrder::findOrFail($id);

        return response()->json(new WorkOrderResource($workOrder), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $workOrder = WorkOrder::findOrFail($id);
        //$workOrder['auto_generated'] = $request->
        $workOrder['site_id'] = $request->site_id;
        $workOrder['description'] = $request->description;
        $workOrder['priority'] = $request->priority;
        //$workOrder['state'] = $request->state;
        $workOrder['img1_url'] = $request->img1_url;
        $workOrder['img2_url'] = $request->img2_url;
        $workOrder->save();
        return response()->json(new WorkOrderResource($workOrder), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function closed(Request $request, string $id)
    {
        $workOrder = WorkOrder::findOrFail($id);
        $workOrder['date_time_closed'] = $request->date_time_closed;
        $workOrder['description_closed'] = $request->description_closed;
        $workOrder->save();

        return response()->json(new WorkOrderResource($workOrder), 200);
    }
}
