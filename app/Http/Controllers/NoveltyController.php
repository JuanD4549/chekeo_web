<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoveltyResource;
use App\Models\Novelty;
use Illuminate\Http\Request;

class NoveltyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $message = 'Exito';
        $codeStatus = 200;
        $novelty = Novelty::select('*')
            ->orderBy('id', 'DESC')
            ->get();

        return response()
            ->json([
                'message' => $message,
                'novelty' => NoveltyResource::collection($novelty),
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
    public function show(Novelty $novelty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Novelty $novelty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Novelty $novelty)
    {
        //
    }
}
