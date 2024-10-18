<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkOrderIndexResource;
use App\Http\Resources\WorkOrderResource;
use App\Models\EmployeeWorkOrder;
use App\Models\WorkOrder;
use App\Models\WorkOrderDetail;
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
                ->orderBy('id', 'desc')
                ->get();
        }
        return response()->json(WorkOrderIndexResource::collection($workOrders), 200);
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
        $workOrder['date_time_finished'] = $request->date_time_finished;
        $workOrder['date_time_ejecuted'] = $request->date_time_executed;
        //$workOrder['state'] = $request->state;
        $workOrder['img1_url'] = $request->img1_url;
        $workOrder['img2_url'] = $request->img2_url;
        $workOrder->save();

        foreach ($request->workers as $value) {
            $worker = new EmployeeWorkOrder();
            $worker['work_order_id'] = $workOrder->id;
            $worker['employee_id'] = $value['employee'];
            $worker['leader'] = $value['leader'];
            $worker->save();
        }

        return response("Se creó la orden de trabajo", 201);
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

    public function add(Request $request, string $id)
    {
        $workOrder = WorkOrder::findOrFail($id);
        if ($workOrder->work_order_details->count() == 0) {
            $workOrder['state'] = 'in_process';
            $workOrder->save();
        }
        //$workOrder['auto_generated'] = $request->
        $workOrderDetail = new WorkOrderDetail();
        $workOrderDetail['work_order_id'] = $id;
        $workOrderDetail['advance'] = $request->advance;
        $workOrderDetail['detail'] = $request->detail;
        $workOrderDetail['img1_url'] = $request->img1_url;
        $workOrderDetail['img2_url'] = $request->img2_url;

        $workOrderDetail->save();
        return response("Agregado exitosamente", 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function closed(Request $request, string $id)
    {
        $workOrder = WorkOrder::findOrFail($id);
        if ($workOrder->work_order_details->count() > 0) {
            $workOrder['date_time_closed'] = $request->date_time_closed;
            $workOrder['description_closed'] = $request->description_closed;
            $workOrder['state'] = 'completed';

            $workOrder->save();
            return response('Termino la tarea', 200);
        }
        return response('Agrege un detalle', 406);
    }
}
