@extends('layouts.app')
@section('content')
	<div class="container" style="margin-top: 200px; margin-bottom: 100px;">
		<div class="row">
			<div class="col-lg-4">
				@include('flash::message')
			</div>
		</div>
		@foreach($user->notifications as $notification)
			<form action="{{ route('hangout.accept', ['id' => $notification->data['id']]) }}" method="post">
				@csrf
			<div class="row">
				<div class="col-lg-6">			
					<div class="panel panel-default">
						<div class="panel-heading">
							<h5>{{ $notification->data['title'] }}</h5>
						</div>
						<div class="panel-body notifications">
							{{ $notification->data['inviter'] }} wants to hang out with you at <a href="{{ route('locations.show', ['slug' => $notification->data['location_slug']]) }}">{{ $notification->data['location'] }}</a> on {{Carbon::parse($notification->data['meeting'])->format('d M') }} . <br>
							Meet up hour: {{Carbon::parse($notification->data['meeting'])->format('H:i') }} <br>
							@if($user->hangouts()->where('hangout_id', $notification->data['id'])->exists())
							<div class="accept-invite-btn" style="margin-top: 20px;">
								<button class="btn btn-success" disabled="true">Invitation accepted</button>		
							</div>
							@else
								<button class="btn btn-success" type="submit">Accept invitation</button>
							@endif
						</div>
					</div>
				</div>
			</div>
			</form>		
		@endforeach
	</div>	
@endsection