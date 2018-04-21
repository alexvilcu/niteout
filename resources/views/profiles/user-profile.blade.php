@extends('layouts.app')

@section('content')
	<div class="container" style="margin-top: 150px;">
		<div class="row">
			
		</div>
		<div class="row">
			<div class="col-lg-12" style="text-align: center; margin-bottom: 20px;">
				<img class="profile" src="{{ asset($user->avatar) }}" alt="" style="object-fit: cover;">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12" style="text-align: center;">
				<h2>{{ $user->name }}</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12" style="text-align: center;">
				<p>Locations added:{{ " " }} {{ $user->locations()->count() }}</p>
				<p>Experience:{{ " " }} {{ $user->experience }}</p>
			</div>
		</div>

		
	</div>
@endsection