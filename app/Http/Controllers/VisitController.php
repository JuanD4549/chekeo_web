<?php

namespace App\Http\Controllers;

use App\Http\Resources\VisitResource;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Auth::user()->roles->first();
        //dd($roles->name);
        if ($roles->name == 'super_admin') {
            $visits = Visit::select('*')
                ->orderBy('id', 'DESC')
                ->limit(200)
                ->get();
            //dd($visits);
        }
        return response()
            ->json(
                VisitResource::collection($visits),
                200
            );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $visit = new Visit();
        $visit['name'] = $request->name;
        $visit['ci'] = $request->ci;
        $visit['cellphone'] = $request->cellphone;
        $visit['info_visit'] = $request->info_visit;
        $visit['img1_url'] = $request->img1_url;
        //dd($visit);
        $visit->save();
        return response()
            ->json(new VisitResource($visit), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $visit = Visit::findOrFail($id);
        return response()->json(new VisitResource($visit), 200);
    }

    public function search(Request $request)
    {
        $visits = new Visit;

        if (ctype_digit($request->valor)) {
            $visits->where('ci', 'like', "%{$request->valor}%");
        } else {
            $minusculas = strtolower($request->valor);
            $visits->whereRaw('LOWER(name) = ?', [$minusculas]);
            //dd($minusculas);
        }

        //dd($visits);
        if ($visits->get()->count() == 0) {
            return response()
                ->noContent();
        }
        //dd($visits->get());

        return response()
            ->json(VisitResource::collection($visits->get()), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visit $visit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visit $visit)
    {
        //
    }
}
