<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        $places = Place::all();
        return view('admin.places.create')->with('places',$places);;
    }



    public function store(Request $request)
    {
        $data = $request['detailsOfPlace'];
        $values=array('id' => $data['id'],
                    'name' => $data['name'], 
                    'discount' => $data['discount']);
        $place = new Place();
        $place->place_id = $values['id'];
        $place->name = $values['name'];
        $place->discount = $values['discount'];
        $place->city_id = 1;
        $place->category_id = 1;
        $place->save();
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
    public function destroy($id)
    {
        //
    }
    public function getPlaceById($place_id){
        $place = Place::where('place_id',$place_id)->get();
        return json_encode($place);
    }
}
