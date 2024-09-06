<?php

namespace App\Http\Controllers;

use App\Http\Resources\VisitCarResource;
use App\Models\VisitCar;
use Illuminate\Http\Request;

class VisitCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $message = 'Exito';
        $codeStatus = 200;
        try {
            $visitCars = VisitCar::select('*')
                ->orderBy('id', 'DESC')
                ->get();
            //dd($registerRounds);

            return response()
                ->json([
                    'message' => $message,
                    'visit_cars' => VisitCarResource::collection($visitCars),
                ], $codeStatus);
        } catch (\Throwable $th) {
            return response()
                ->json([
                    'message' => $th,
                    //'registerRounds' => RegisterRoundResource::collection($registerRounds),
                ], 500);
        }
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
    public function show(Request $request)
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
