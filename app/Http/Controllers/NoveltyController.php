<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoveltyResource;
use App\Models\Novelty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoveltyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Auth::user()->roles->first();
        //dd($roles->name);
        if ($roles->name == 'super_admin') {
            $novelty = Novelty::select('*')
                ->orderBy('id', 'DESC')
                ->limit(200)
                ->get();
        }
        return response()
            ->json(NoveltyResource::collection($novelty), 200);
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
