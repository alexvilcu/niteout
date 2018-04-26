<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mapper;

use App\Location;

use App\Tag;

use App\User;

use App\Mood;

use DB;

class FrontEndController extends Controller
{
    

    public function index()
    {
    	$top_rated_users = User::orderBy('experience', 'desc')->take(10)->get();
    	return view('index', ['moods' => Mood::all(), 'tags' => Tag::all(), 'top_rated_users' => $top_rated_users]);
    }
}
