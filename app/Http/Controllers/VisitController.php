<?php

namespace App\Http\Controllers;

use App\Http\Resources\VisitResource;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $message = 'Exito';
        $codeStatus = 200;
        try {
            $visits = Visit::select('*')
                ->orderBy('id', 'DESC')
                ->get();
            //dd($registerRounds);

            return response()
                ->json([
                    'message' => $message,
                    'visits' => VisitResource::collection($visits),
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
        $visit = new Visit();
        $visit['name'] = $request->name;
        $visit['ci'] = $request->ci;
        $visit['cellphone'] = $request->cellphone;
        $visit['info_visit'] = $request->info_visit;

        $visit->save();

        return response()
            ->json(new VisitResource($visit), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $visits = Visit::where('name', 'like', "%{$request->valor}%")
            ->orWhere('ci', 'like', "%{$request->valor}%")
            ->get();

        //dd($visits);
        if ($visits->count() == 0) {
            return response()
                ->noContent();
        }
        //dd($registerRounds);

        return response()
            ->json(VisitResource::collection($visits), 200);
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
