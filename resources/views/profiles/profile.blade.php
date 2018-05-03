@extends('layouts.app')

@section('content')
	<div class="container" style="margin-top: 150px;">
		<div class="row">
			<div class="col-lg-3" style="text-align: center; margin-bottom: 50px;">
				<a class="btn btn-success" href="{{ route('hangout.index') }}" style="width: 140px;">View hang-outs</a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3" style="text-align: center; margin-bottom: 50px;">
				<a class="btn btn-success" href="{{ route('users.edit', ['slug' => Auth::user()->slug]) }}"> Edit profile</a>
			</div>

		</div>
		<div class="row">
			<div class="col-lg-12" style="text-align: center; margin-bottom: 20px;">
				<img class="profile" src="{{ asset(Auth::user()->avatar) }}" alt="" style="object-fit: cover;">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12" style="text-align: center;">
				<h2>{{ $user->name }}</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12" style="text-align: center;">
				<p>Locations added:{{ " " }} {{ Auth::user()->locations()->count() }}</p>
				<p>Nite points:{{ " " }} {{ Auth::user()->experience }}</p>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12" style="text-align: center; margin-bottom: 50px;">
				<a class="btn btn-success" href="{{ route('hangout.create') }}" style="width: 140px;">Start a hang-out</a>
			</div>
		</div>

		
		
	</div>
@endsection