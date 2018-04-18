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
    

    public function index()
    {
    	return view('index')->with('locations', Location::all() )
                            ->with('tags', Tag::all())
                            ->with('moods', Mood::all());
    }
}
