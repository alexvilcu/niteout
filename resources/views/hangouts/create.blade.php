@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 200px; margin-bottom: 300px;">
	<div class="row">
		<div class="form-row">
			<label for="users">Invite others to your hangout</label>
			<select name="user_tags[]" id="users" class="form-control" multiple="multiple" style="width: 75%;">
				<option value=""></option>
				@foreach($users as $user)
					<option value="{{ $user->id }}">{{ $user->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<a href="{{ route(hangout.invite, ['inviter' => Auth::user()->id]) }}" class="btn btn-success">Send invitations</a>
		</div>
	</div>
</div>
@endsection