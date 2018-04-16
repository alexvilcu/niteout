@extends('layouts.app')

@section('content')
	<div class="container" style="margin-top: 150px;">

	<form method="POST" action="{{ route('users.update', ['slug' => Auth::user()->slug]) }}" enctype="multipart/form-data">
	@csrf
		<input name="_method" value="PUT" type="hidden">
		<div class="row">
			<div class="col-lg-12" style="text-align: center; margin-bottom: 20px;">
				<h2>{{ $user->name }}</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12" style="text-align: center; margin-bottom: 20px;">
				<img class="profile" src="{{ asset(Auth::user()->avatar) }}" alt="">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12" style="text-align: center; margin-bottom: 20px;">
				<input type="text" placeholder="Enter your name" name="name">
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12" style="text-align: center; margin-bottom: 20px; margin-left: 100px;">
				<input type="file" placeholder="Select the avatar picture" name="avatar">
			</div>
			
		</div>

		<div class="row">
			<div class="col-lg-12" style="text-align: center; margin-bottom: 20px;">
				<input type="text" placeholder="Enter your email" name="email">
			</div>
			
		</div>

		<div class="row">
			<div class="col-lg-12" style="text-align: center; margin-bottom: 20px;">
				<button class="btn btn-success" type="submit">Update your profile</button>
			</div>
			
		</div>


	</form>
		

		
	</div>
@endsection