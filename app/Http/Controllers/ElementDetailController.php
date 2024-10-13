<?php

namespace App\Http\Controllers;

use App\Http\Resources\ElementDetailResource;
use App\Models\ElementDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ElementDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Auth::user()->roles->first();
        //dd($roles->name);
        if ($roles->name == 'super_admin') {
            $elementDetails = ElementDetail::limit(200)
                ->get();
        }
        return response()->json(ElementDetailResource::collection($elementDetails), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $elementDetails = new ElementDetail();
        $elementDetails['maintenance_round_detail_id'] = $request->maintenance_round_detail_id;
        $elementDetails['element_id'] = $request->element_id;
        $elementDetails['status'] = $request->status;
        $elementDetails['detail'] = $request->detail;
        $elementDetails->save();

        return response()->json($elementDetails->id, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $elementDetail = ElementDetail::findOrFail($id);

        return response()->json(new ElementDetailResource($elementDetail), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $elementDetail = ElementDetail::findOrFail($id);
        $elementDetail['maintenance_round_detail_id'] = $request->maintenance_round_detail_id;
        $elementDetail['element_id'] = $request->element_id;
        $elementDetail['status'] = $request->status;
        $elementDetail['detail'] = $request->detail;
        $elementDetail->save();
        return response()->json(new ElementDetailResource($elementDetail), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
