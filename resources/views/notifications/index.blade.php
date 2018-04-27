@extends('layouts.app')
@section('content')
	<div class="container" style="margin-top: 200px;">
		<div class="row">
			<div class="col-lg-6">
				@foreach($user->notifications as $notification)
					<div class="panel panel-default">
						<div class="panel-heading">
							{{ $notification->data['title'] }}
						</div>
						<div class="panel-body">
							{{ $notification->data['inviter'] }}
						</div>
					</div>
				@endforeach
			</div>
		</div>	
	</div>
@endsection