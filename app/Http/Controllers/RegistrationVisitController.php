<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegistrationVisitResource;
use App\Models\RegistrationVisit;
use Illuminate\Http\Request;

class RegistrationVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $message = 'Exito';
        $codeStatus = 200;
        try {
            $registerVisits = RegistrationVisit::select('*')
                ->orderBy('id', 'DESC')
                ->get();
            //dd($registerRounds);

            return response()
                ->json([
                    'message' => $message,
                    'registerVisits' => RegistrationVisitResource::collection($registerVisits),
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
    private function transformImg($imgString, $folder)
    {
        $img = $imgString;
        $folderPath = 'storage/' . $folder;
        if (!file_exists($folderPath)) {
            mkdir($folderPath);
            //dd($resultado);
        }
        $image_parts = explode(";base64,", $img);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName1 = date("d.m.y") . "." . time() . uniqid() . '.png';
        $file = $folderPath . $fileName1;
        file_put_contents($file, $image_base64);
        return $folder . $fileName1;
    }

    public function store(Request $request)
    {
        //
        $registerVisit = new RegistrationVisit();
        $registerVisit['user_id'] = $request->user_id;
        $registerVisit['branche_id'] = $request->branche_id;
        $registerVisit['visit_id'] = $request->visit_id;
        $registerVisit['visit_car_id'] = $request->visit_car_id;
        $registerVisit['date_time_in'] = $request->date_time_in;
        if ($request->img1_url != null) {
            $registerVisit['img1_url'] = $this->transformImg($request->img1_url, 'visit/');
        }
        if ($request->img2_url != null) {
            $registerVisit['img2_url'] = $this->transformImg($request->img2_url, 'visit/');
        }
        $registerVisit->save();
        return response()
            ->json(new RegistrationVisitResource($registerVisit), 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(RegistrationVisit $registrationVisit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RegistrationVisit $registrationVisit)
    {
        $registerVisit = RegistrationVisit::find($request->id);
        $registerVisit['date_time_out'] = $request->date_time_out;
        //$registerVisit['date_time_in'] = $request->date_time_in;

        $registerVisit->save();
        return response()
            ->json(new RegistrationVisitResource($registerVisit), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegistrationVisit $registrationVisit)
    {
        //
    }
}
