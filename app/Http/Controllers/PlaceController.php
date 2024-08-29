<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{

    //Get Place and places of User
    public function user_place()
    {
        //$user_place=Auth::user()->place;
        $place = Place::select('id', 'name')
            ->find(1);
        $message = 'Exito';
        $codeStatus = 200;
        return response()
            ->json([
                'message' => $message,
                'place' => $place
            ], $codeStatus);
    }

    public function places(){
        $places = Place::select('id', 'name')->get();
        $message = 'Exito';
        $codeStatus = 200;
        return response()
            ->json([
                'message' => $message,
                'places' => $places
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
    public function show(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        //
    }
}
