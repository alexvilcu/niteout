@extends('layouts.app')
@section('content')
	<div class="container" style="margin-top: 200px; margin-bottom: 100px;">
		<div class="row">
			<div class="col-lg-6">
				@foreach($user->unreadNotifications as $notification)
					<div class="panel panel-default">
						<div class="panel-heading">
							<h5>{{ $notification->data['title'] }}</h5>
						</div>
						<div class="panel-body">
							{{ $notification->data['inviter'] }} wants to hang out with you at <a href="{{ route('locations.show', ['slug' => $notification->data['location_slug']]) }}">{{ $notification->data['location'] }}</a> on {{Carbon::parse($notification->data['meeting'])->format('d M') }} . <br>
							Meet up hour: {{Carbon::parse($notification->data['meeting'])->format('H:i') }}
						</div>
					</div>
				@endforeach
			</div>
		</div>	
	</div>
@endsection