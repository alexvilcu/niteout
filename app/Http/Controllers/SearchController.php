<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use DB;

use App\Tag;

use App\Mood;

use App\Location;

class SearchController extends Controller
{
    public function filter(Request $request, Location $location)
    {
        $this->validate($request, [
            'tag' => 'required_without_all:tag,mood'
        ]);

    	$tag_name = $request->tag;
    	if ($request->tag) {
    		$locations = Location::whereHas('tags', function($q) use($tag_name){
    		$q->where('name', $tag_name);
    	});
    	}

    	if ($request->mood) {
    		if ($request->tag) {
    			$locations->where('mood_id', $request->mood);
    		} else {
    			$locations = DB::table('locations')->where('mood_id', $request->mood);
    		}
    	}

    	$locations = $locations->simplePaginate(4);
        if ($locations->count() == 0) {
            flash()->overlay('Results not found', 'Ups!');
            return redirect()->back();
        } else {
            return view('locations.index', compact('locations'));
        }

    	

    }
}
