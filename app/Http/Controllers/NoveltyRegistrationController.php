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
        $registerNoveltys = NoveltyRegistration::select('*')
            ->orderBy('id', 'DESC')
            ->get();

        return response()
            ->json([
                'message' => $message,
                'registerNoveltys' => NoveltyRegistrationResource::collection($registerNoveltys),
            ], $codeStatus);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NoveltyRegistration $noveltyRegistration)
    {
        //
    }
}
