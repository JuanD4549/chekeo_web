<?php

namespace App\Http\Controllers;

use App\Http\Resources\VisitCarResource;
use App\Models\VisitCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Auth::user()->roles->first();
        //dd($roles->name);
        if ($roles->name == 'super_admin') {
            $visitCars = VisitCar::select('*')
                ->orderBy('id', 'DESC')
                ->limit(200)
                ->get();
            //dd($registerRounds);
        }
        return response()
            ->json(
                VisitCarResource::collection($visitCars),
                200
            );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $visitCar = new VisitCar();
        $visitCar['license_plate'] = $request->license_plate;

        $visitCar->save();

        return response()
            ->json(new VisitCarResource($visitCar), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $visitCars = VisitCar::findOrFail($id);

        //dd($registerRounds);

        return response()
            ->json(new VisitCarResource($visitCars), 200);
    }

    public function search(Request $request)
    {
        $visitCars = VisitCar::where('license_plate', 'like', "%{$request->valor}%")
            ->get();

        //dd($visits);
        if ($visitCars->count() == 0) {
            return response()
                ->noContent();
        }
        //dd($registerRounds);

        return response()
            ->json(VisitCarResource::collection($visitCars), 200);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VisitCar $visitCar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisitCar $visitCar)
    {
        //
    }
}
