<?php

namespace App\Http\Controllers;


use App\Place;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $places = Place::all();
        return view('admin.places.create')->with('places',$places);
    }


}
