<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkOrderDetailResource;
use App\Models\WorkOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkOrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Auth::user()->roles->first();
        //dd($roles->name);
        if ($roles->name == 'super_admin') {
            $workOrders = WorkOrderDetail::limit(200)
                ->get();
        }
        return response()->json(WorkOrderDetailResource::collection($workOrders), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $workOrderDetail = new WorkOrderDetail();
        $workOrderDetail['work_order_id'] = $request->work_order_id;
        $workOrderDetail['advance'] = $request->advance;
        $workOrderDetail['detail'] = $request->detail;
        $workOrderDetail['img1_url'] = $request->img1_url;
        $workOrderDetail['img2_url'] = $request->img2_url;

        $workOrderDetail->save();
        return response()->json(new WorkOrderDetailResource($workOrderDetail), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $workOrderDetail = WorkOrderDetail::findOrFail($id);

        return response()->json(new WorkOrderDetailResource($workOrderDetail), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $workOrderDetail = WorkOrderDetail::findOrFail($id);
        $workOrderDetail['work_order_id'] = $request->work_order_id;
        $workOrderDetail['advance'] = $request->advance;
        $workOrderDetail['detail'] = $request->detail;
        $workOrderDetail['img1_url'] = $request->img1_url;
        $workOrderDetail['img2_url'] = $request->img2_url;

        $workOrderDetail->save();

        return response()->json(new WorkOrderDetailResource($workOrderDetail), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
