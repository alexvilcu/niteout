<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mood;

use Mapper;

use Auth;

use App\Comment;

use App\Location;

use App\Tag;

use Image;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view('locations.create')->with('moods', Mood::all())
                                       ->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required',
        'address' => 'required',

        ]);

        $location = new Location;
        $location->name = $request->name;
        $location->address = $request->address;
        if ($request->has('type')) {
            $location->type = $request->type;
        } else {
            flash('Please choose a type for the location.')->warning()->important();
            return redirect()->back();
        }
        $location->description = $request->description;
        if ($request->has('mood')) {
            $location->mood_id = $request->mood;
        } else {
            flash('Please select the mood of the location.')->warning()->important();
            return redirect()->back();
        }
        $location->user_id = Auth::user()->id;
        $location->lat = $request->lat;
        $location->lng = $request->lng;
        $location->slug = str_slug(strtolower($request->name), '-');

        if ($request->hasFile('image')) {
            $location_image = $request->file('image');
            $location_image_new_name = time() . $location_image->getClientOriginalName();
            Image::make($location_image)->resize(300, 300)->save(public_path('/uploads/locations/' . $location_image_new_name));        
            $location->photo ='uploads/locations/' . $location_image_new_name;
            $location->save();
        } else {
            flash('Please upload a picture')->warning()->important();
            return redirect()->back();
        }

        
        $location_find = Location::find($location->id);
        $location_find->tags()->attach($request->music_tags);
        
        return redirect()->back();

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $location = Location::where('slug', $slug)->first();
        $comments = $location->comments()->simplePaginate(4);
        $map_location = Mapper::location($location->address)->map(['zoom' => 15, 'center' => true]);
        return view('locations.single', ['location' => $location, 'comments' => $comments ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('locations.edit');
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
        $location = Location::find($id);
        $location->name = $request->name;
        $location->address = $request->address;
        $location->type = $request->type;
        $location->description = $request->description;
        $location->mood_id = $request->mood;
        $location->lat = $request->lat;
        $location->lng = $request->lng;
        $location_image_new_name = time() . $location_image->getClientOriginalName();

        $location_image = $request->image;  
        $location_image->move('uploads/locations', $location_image_new_name);
        $location->photo ='uploads/locations/' . $location_image_new_name;
        $location->save();
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

    public function create_comment($slug)
    {
         $location = Location::where('slug', $slug)->first();
         return view('comments.create', ['location' => $location]);
    }

    public function store_comment(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->location_id = $request->location_id;
        $comment->save();

        return redirect()->route('locations.show', ['slug' => $request->location_slug]);

    }
}
