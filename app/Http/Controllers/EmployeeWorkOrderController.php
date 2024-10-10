<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeWorkOrderResource;
use App\Models\EmployeeWorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeWorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Auth::user()->roles->first();
        //dd($roles->name);
        if ($roles->name == 'super_admin') {
            $employeeWorkOrders = EmployeeWorkOrder::limit(200)
                ->get();
        }
        return response()->json(EmployeeWorkOrderResource::collection($employeeWorkOrders), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employeeWorkOrder = new EmployeeWorkOrder();
        $employeeWorkOrder['employee_id'] = $request->employee_id;
        $employeeWorkOrder['work_order_id'] = $request->work_order_id;
        $employeeWorkOrder['leader'] = $request->leader;
        $employeeWorkOrder->save();

        return response()->json(new EmployeeWorkOrderResource($employeeWorkOrder), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employeeWorkOrder = EmployeeWorkOrder::findOrFail($id);

        return response()->json(new EmployeeWorkOrderResource($employeeWorkOrder), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employeeWorkOrder = EmployeeWorkOrder::findOrFail($id);
        $employeeWorkOrder['employee_id'] = $request->employee_id;
        $employeeWorkOrder['work_order_id'] = $request->work_order_id;
        $employeeWorkOrder['leader'] = $request->leader;
        $employeeWorkOrder->save();

        return response()->json(new EmployeeWorkOrderResource($employeeWorkOrder), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
