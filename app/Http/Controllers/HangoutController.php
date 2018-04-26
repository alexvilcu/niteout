<?php

namespace App\Http\Controllers;

use App\Hangout;
use Illuminate\Http\Request;
use App\User;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hangouts.create', ['users' => User::all()]);
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

    public function invite(Request $request, $users)
    {
        $users = $request->user_tags;
    }
}
