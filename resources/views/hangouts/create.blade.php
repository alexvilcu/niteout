@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 100px; margin-bottom: 300px;">
	<div class="row" style="margin-bottom: 40px;">
		<div class="col-lg-6">
			<h2>Create an awesome hangout</h2>
			<div class="flash-msg">
	          @include('flash::message')
	        </div>
		</div>
	</div>
	
		<form action="{{ route('hangout.invite') }}" method="post">
			{{ csrf_field() }}
			<div class="row" style="margin-bottom: 40px;">
				<div class="form-row">
					<label for="name">Enter a name for this hangout</label>
					<input type="text" name="name" placeholder="Enter name here" class="form-control">
				</div>
			</div>
			<div class="row" style="margin-bottom: 40px;">
				<div class="form-row">
					<label for="users">Invite others to hangout with you</label>
					<select name="user_tags[]" id="users" class="form-control" multiple="multiple" style="width: 75%;">
						<option value=""></option>
						@foreach($users as $user)
							<option value="{{ $user->id }}">{{ $user->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="row">
				<div class="form-row" style="margin-bottom: 40px;">
					<label for="users">Select a location to hangout</label>
					<select name="location" id="location" class="form-control" style="width: 75%;">
						<option value=""></option>
						@foreach($locations as $location)
							<option value="{{ $location->id }}">{{ $location->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="row" style="margin-bottom: 40px;">
				<div class="form-row">
					<label for="name">Enter a name for this hangout</label>
					<input type="datetime-local" name="meeting_at" placeholder="Enter the meeting time" class="form-control">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<button class="btn btn-success" type="submit">Send invitation</button>
				</div>
			</div>
		</form>
		
</div>
@endsection