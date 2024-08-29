<?php

namespace App\Http\Controllers;

use App\Models\Branche;
use Illuminate\Http\Request;

class BrancheController extends Controller
{
    //Get Branche and Branches of User
    public function user_branche()
    {
        //$user_place=Auth::user()->place;
        $branche = Branche::select('id', 'name')
            ->find(1);
        $message = 'Exito';
        $codeStatus = 200;
        return response()
            ->json([
                'message' => $message,
                'branche' => $branche
            ], $codeStatus);
    }

    public function branches()
    {
        $branches = Branche::select('id', 'name')
            ->find(1);
        $message = 'Exito';
        $codeStatus = 200;
        return response()
            ->json([
                'message' => $message,
                'branches' => $branches
            ], $codeStatus);
    }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Branche $branche)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branche $branche)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branche $branche)
    {
        //
    }
}
