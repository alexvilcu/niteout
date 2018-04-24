<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mood;

use Mapper;

use Auth;

use DB;

use App\Comment;

use App\Location;

use App\Tag;

use Image;

use willvincent\Rateable\Rating;

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

        $user = Auth::user();
        $location_exp = 200;

        if (Location::where('name', $request->name)->exists()) {
            flash('Location already exists.')->warning()->important();
            return redirect()->back();
        } else {
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
            $img = Image::make($location_image);
            $img->resize(200, 200, function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->save(public_path('/uploads/locations/' . $location_image_new_name));        
            $location->photo ='uploads/locations/' . $location_image_new_name;
            $location->save();
        } else {
            flash('Please upload a picture')->warning()->important();
            return redirect()->back();
        }

        $location->identifier = str_random(30);
        $location_find = Location::find($location->id);
        $location_find->tags()->attach($request->music_tags);
        $location->save();
        $new_exp = $user->experience + $location_exp;
        $user->experience = $new_exp;
        $user->save();

        flash('Location created!');
        return redirect()->back();
        }

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $rating_user = Rating::where('user_id', Auth::user()->id)->first(); 

        $location = Location::where('slug', $slug)->first();
        $comments = $location->comments()->simplePaginate(4);
        $map_location = Mapper::location($location->address)->map(['zoom' => 15, 'center' => true]);
        return view('locations.single', ['location' => $location, 'comments' => $comments, 'rating_user' => $rating_user ]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($identifier)
    {
        $moods = Mood::all();
        $tags = Tag::all();
        $location = Location::where('identifier', $identifier)->first();
        if (Auth::user()->id == $location->user->id ) {
            return view('locations.edit', ['location' => $location, 'moods' => $moods, 'tags' => $tags]);
        } else {
            return redirect()->back();
        }
         
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $location = Location::where('slug', $slug)->first();
        $location->name = $request->name;
        $location->slug = str_slug(strtolower($request->name), '-');
        $location->address = $request->address;
        $location->description = $request->description;
        $location->type = $request->type;
        $location->mood_id = $request->mood;
        $location->lng = $request->lng;
        $location->lat = $request->lat;
        $location->save();
        if ($request->hasFile('image')) {
            $location_image = $request->file('image');
            $location_image_new_name = time() . $location_image->getClientOriginalName();
            $img = Image::make($location_image);
            $img->resize(200, 200, function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->save(public_path('/uploads/locations/' . $location_image_new_name));        
            $location->photo ='uploads/locations/' . $location_image_new_name;
            $location->save();
        }

        if ($request->has('music_tags')) {
            $location->tags()->sync($request->music_tags);
        } else {
            $location->tags()->sync($location->tags);
        }

        
        $location->save();
        flash('Location edited');
        return redirect()->back();
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
        $user = Auth::user();
        $comment_exp = 100;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->location_id = $request->location_id;
        $comment->save();
        $new_exp = $user->experience + $comment_exp;
        $user->experience = $new_exp;
        $user->save();

        flash('Comment added. '. ' You received ' .$comment_exp. ' points!!');
        return redirect()->route('locations.show', ['slug' => $request->location_slug]);

    }

    public function rateLocation(Request $request, $identifier)
    {
        $location = Location::where('identifier', $identifier)->first();
        // var_dump($location->name);
        $rating = new Rating;
        $rating->rating = $request->rating;
        $rating->user_id = \Auth::id();
        $location->ratings()->save($rating);
        // dd($location->ratings);
        flash('You gave a ' .  $request->rating . ' star rating to this location.');
        return redirect()->back();
    }
}
