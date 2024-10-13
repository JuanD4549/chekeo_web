<?php

namespace App\Http\Controllers;

use App\Http\Resources\ElementResource;
use App\Http\Resources\SiteResource;
use App\Models\Element;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function elements($id)
    {
        $elements = Element::where('site_id', $id)->get();
        return response()->json(ElementResource::collection($elements), 200);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Auth::user()->roles->first();
        //dd($roles->name);
        if ($roles->name == 'super_admin') {
            $sites = Site::limit(200)
                ->get();
        }
        return response()->json(SiteResource::collection($sites), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $site = new Site();
        $site['name'] = $request->name;
        $site->save();

        return response()->json(new SiteResource($site), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $site = Site::findOrFail($id);

        return response()->json(new SiteResource($site), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $site = Site::findOrFail($id);
        $site['name'] = $request->name;
        $site->save();

        return response()->json(new SiteResource($site), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
