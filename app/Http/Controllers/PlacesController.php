<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;


class PlacesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','adminOrUser']);
    }

    public function index()
    {
        $places = Place::all();
        return view('admin.places.index')->with('places',$places);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($place_id)
    {
        $place = new Place();
        $place->findOrFail($place_id)->delete();
        return $this->index();
    }
    public function getPlaceById($place_id){
        $place = Place::where('place_id',$place_id)->get();
        return json_encode($place);
    }
}
