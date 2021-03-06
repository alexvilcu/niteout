<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Image;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if (Auth::user()->slug == $slug) {
            $user = User::where([
            ['slug', $slug],
            ['id', Auth::user()->id]
        ])->first();

        return view('profiles.profile', ['user' => $user]);
        } else {
            return redirect('/');
        }

    }

    public function user_locations()
    {
        $user = Auth::user();
        $locations = $user->locations()->simplePaginate(8);
        return view('profiles.user-locations', ['locations' => $locations]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if (Auth::user()->slug == $slug) {
            $user = User::where([
            ['slug', $slug],
            ['id', Auth::user()->id]
        ])->first();

        return view('profiles.edit', ['user' => $user]);
        } else {
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        if (Auth::user()->slug == $slug) {
                $user = User::where([
                ['slug', $slug],
                ['id', Auth::user()->id]
            ])->first();
            
            if ($request->has('name')) {
                $user->name = $request->name;
                $user->slug = str_slug(strtolower($request->name), '-');
            } else {
                flash('Please insert your name');
                return redirect()->back();
            }

            if ($request->has('email')) {
                $user->email = $request->email;
            } else {
                flash('Please insert email');
                return redirect()->back();
            }
  
            if ($request->hasFile('avatar')) {
                $user_avatar = $request->file('avatar');
                $user_avatar_new_name = time() . $user_avatar->getClientOriginalName();
                Image::make($user_avatar)->resize(150, 150)->save(public_path('uploads/avatars/' . $user_avatar_new_name));
                $avatar ='uploads/avatars/' . $user_avatar_new_name;
                $user->avatar = $avatar;
                $user->save();
            }
                $user->save();
                flash('Profile updated.');
                return redirect()->back();
            
            
        }

    }

    public function view_profile($identifier)
    {
        $user = User::where('identifier', $identifier)->first();
        return view('profiles.user-profile', ['user' => $user]);
    }

    public function view_notifications()
    {
        $user = Auth::user();
        return view('notifications.index', ['user' => $user]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
        
}
