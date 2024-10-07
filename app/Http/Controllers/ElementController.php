<?php

namespace App\Http\Controllers;

use App\Http\Resources\ElementResource;
use App\Models\Element;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ElementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Auth::user()->roles->first();
        //dd($roles->name);
        if ($roles->name == 'super_admin') {
            $elements = Element::limit(200)
                ->get();
        }

        return response()->json(ElementResource::collection($elements), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $element = new Element();
        $element['site_id'] = $request->site_id;
        $element['name'] = $request->name;
        $element->save();

        return response()->json(new ElementResource($element), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $element = Element::findOrFail($id);

        return response()->json(new ElementResource($element), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $element = Element::findOrFail($id);
        $element['site_id'] = $request->site_id;
        $element['name'] = $request->name;
        $element->save();

        return response()->json(new ElementResource($element), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
