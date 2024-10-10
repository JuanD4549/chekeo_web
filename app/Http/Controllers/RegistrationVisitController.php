<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegistrationVisitIndexResource;
use App\Http\Resources\RegistrationVisitResource;
use App\Models\RegistrationVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Auth::user()->roles->first();
        //dd($roles->name);
        if ($roles->name == 'super_admin') {
            $registerVisits = RegistrationVisit::limit(200)
                ->orderBy('id', 'DESC')
                ->get();
            //dd($registerRounds);
        }
        return response()
            ->json(
                RegistrationVisitIndexResource::collection($registerVisits),
                200
            );
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
        //dd($request);
        $registerVisit = new RegistrationVisit();
        $registerVisit['employee_id'] = $request->employee_id;
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
    public function show($id)
    {
        $register_visit = RegistrationVisit::findOrFail($id);
        return response()->json(new RegistrationVisitResource($register_visit), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $registerVisit = RegistrationVisit::findOrFail($id);
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
