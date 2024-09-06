<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoveltyRegistrationResource;
use App\Models\NoveltyRegistration;
use Illuminate\Http\Request;

class NoveltyRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $message = 'Exito';
        $codeStatus = 200;
        try {
            $registerNoveltys = NoveltyRegistration::select('*')
                ->orderBy('id', 'DESC')
                ->get();
        } catch (\Throwable $th) {
            $codeStatus = 500;
            return response()
                ->json([
                    'message' => $th,
                    //'registerNoveltys' => NoveltyRegistrationResource::collection($registerNoveltys),
                ], $codeStatus);
        }
        try {
            $json = NoveltyRegistrationResource::collection($registerNoveltys);
        } catch (\Throwable $th) {
            $codeStatus = 400;
            return response()
                ->json([
                    'message' => $th,
                    //'registerNoveltys' => NoveltyRegistrationResource::collection($registerNoveltys),
                ], $codeStatus);
        }
        return response()
            ->json([
                'message' => $message,
                'registerNoveltys' => $json,
            ], $codeStatus);
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
        $codeStatus = 201;
        try {
            $registerNovelty = new  NoveltyRegistration();
            $registerNovelty['branche_id'] = $request->branche_id;
            $registerNovelty['user_id'] = $request->user_id;
            $registerNovelty['user_notificad_id'] = $request->user_notificad_id;
            $registerNovelty['novelty_id'] = $request->novelty_id;
            $registerNovelty['detail_created'] = $request->detail_created;
            $registerNovelty['latitude'] = $request->latitude;
            $registerNovelty['longitude'] = $request->longitude;
            if ($request->img1_url != null) {
                $registerNovelty['img1_url'] = $this->transformImg($request->img1_url, 'novelty/');
            }
            if ($request->img2_url != null) {
                $registerNovelty['img2_url'] = $this->transformImg($request->img2_url, 'novelty/');
            }
            if ($request->img3_url != null) {
                $registerNovelty['img3_url'] = $this->transformImg($request->img3_url, 'novelty/');
            }
            if ($request->img4_url != null) {
                $registerNovelty['img4_url'] = $this->transformImg($request->img4_url, 'novelty/');
            }
            $registerNovelty->save();
            return response()
                ->json(
                    //new NoveltyRegistrationResource($registerNovelty),
                    $codeStatus
                );
        } catch (\Exception $th) {
            $codeStatus = 500;
            return response()
                ->json([
                    'message' => $th,
                    //'registerNoveltys' => NoveltyRegistrationResource::collection($registerNoveltys),
                ], $codeStatus);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(NoveltyRegistration $noveltyRegistration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NoveltyRegistration $noveltyRegistration)
    {
        $codeStatus = 200;
        try {
            $registerNovelty =  NoveltyRegistration::find($request->id);
            $registerNovelty['date_time_close'] = $request->date_time_close;
            $registerNovelty['detail_closed'] = $request->detail_closed;
            //$registerNovelty['detail_created'] = $request->detail_created;
            //$registerNovelty['latitude'] = $request->latitude;
            //$registerNovelty['longitude'] = $request->longitude;
            //$registerNovelty['user_notificad_id'] = $request->user_notificad_id;
            //$registerNovelty['novelty_id'] = $request->novelty_id;
            
            $registerNovelty->save();
            return response()
                ->json(
                    new NoveltyRegistrationResource($registerNovelty),
                    $codeStatus
                );
        } catch (\Exception $th) {
            $codeStatus = 500;
            return response()
                ->json([
                    'message' => $th,
                    //'registerNoveltys' => NoveltyRegistrationResource::collection($registerNoveltys),
                ], $codeStatus);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NoveltyRegistration $noveltyRegistration)
    {
        //
    }
}
