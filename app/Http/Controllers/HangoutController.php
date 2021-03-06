<?php

namespace App\Http\Controllers;

use App\Hangout;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Location;
use HangoutRequest;
use Notification;

class HangoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('hangouts.index', ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hangouts.create', ['users' => User::all()->except(Auth::id()), 'locations' => Location::all()]);
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
     * @param  \App\Hangout  $hangout
     * @return \Illuminate\Http\Response
     */
    public function show(Hangout $hangout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hangout  $hangout
     * @return \Illuminate\Http\Response
     */
    public function edit(Hangout $hangout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hangout  $hangout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hangout $hangout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hangout  $hangout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hangout $hangout)
    {
        //
    }

    public function invite(Request $request)
    {
        $users_ids = $request->user_tags;
        $users = User::find($users_ids);
        // dd($users);
        $hangout = new Hangout;
        $hangout->name = $request->name;
        $hangout->meeting_at = $request->meeting_at;
        $hangout->inviter_id = Auth::user()->id;
        $hangout->location_id= $request->location;
        $hangout->save();
        $hangout = Hangout::find($hangout->id);
        $hangout->save();
        Notification::send($users, new HangoutRequest($hangout));
        flash('Invites have been sent');
        return redirect()->back();

    }

    public function accept_hangout_invite($id)
    {
        $user = Auth::id();
        $hangout = Hangout::find($id);
        $inviter = User::find($hangout->inviter_id);
        $hangout->attendings += 1;
        $hangout->users()->attach($user);
        $hangout->save();
        flash('You accepted the invitation');
        return redirect()->back();
    }
}
