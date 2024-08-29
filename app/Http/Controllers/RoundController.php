<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoundResource;
use App\Models\Round;
use Illuminate\Http\Request;

class RoundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $message = 'Exito';
        $codeStatus = 201;
        try {
            $round = new Round();
            $round['register_round_id'] = $request->register_round_id;
            $round['latitude'] = $request->latitude;
            $round['longitude'] = $request->longitude;
            if ($request->img != null) {
                $round['img1_url'] = $this->transformImg($request->img, 'round/');
            }
            $round->save();
        } catch (\Throwable $th) {
            $codeStatus=500;
            return response()
                ->json(['message' => $th], $codeStatus);
        }


        return response()
            ->json(new RoundResource($round), $codeStatus);
    }
    private function transformImg($imgString, $folder)
    {
        $img = $imgString;
        $folderPath = 'storage/'.$folder;
        if (!file_exists($folderPath)) {
            mkdir($folderPath);
            //dd($resultado);
        }
        $image_parts = explode(";base64,", $img);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName1 = date("d.m.y") . "." . time() . uniqid() . '.png';
        $file = $folderPath . $fileName1;
        file_put_contents($file, $image_base64);
        return $folder.$fileName1;
    }
    /**
     * Display the specified resource.
     */
    public function show(Round $round)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Round $round)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Round $round)
    {
        //
    }
}
