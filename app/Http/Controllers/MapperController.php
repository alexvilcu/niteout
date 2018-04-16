<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mapper;

use App\Location;

class MapperController extends Controller
{
    public function mapLocation(Location $) 
    {
    	 // Mapper::map(53.381128999999990000, -1.470085000000040000)
    	 // Mapper::map($location->getLatitude(), $location->getLongitude());
    	Mapper::location('bucharest')->map();

    	// return view('cornford.map');
    }
}
