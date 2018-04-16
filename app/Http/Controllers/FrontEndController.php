<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mapper;

use App\Location;

use App\Tag;

use App\Mood;

use DB;

class FrontEndController extends Controller
{
    public function map() 
    {

    	// Mapper::location('sheffield');
    	// Mapper::map(53.381128999999990000, -1.470085000000040000);
    	$location = Mapper::location('gabroveni 7')->map();
    	// dd($location);
    	// phpinfo();

    	return view('cornford.map');

    	
    }

    public function index()
    {
    	return view('index')->with('locations', Location::all() )
                            ->with('tags', Tag::all())
                            ->with('moods', Mood::all());
    }
}
