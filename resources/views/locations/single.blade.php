@extends('layouts.app')

@section('content')

@include('includes.navbar')

	<div class="container" style="margin-top: 100px; margin-bottom: 50px;">
		<div class="row">
			<div class="col-md-4">
				<div class="flash-msg">
         	 		@include('flash::message')
        		</div>
			</div>
		</div>
		<div class="row">
			
			<div class="col-lg-3" style="margin-bottom: 30px;">
				<a href="{{ route('comment.create',['slug' => $location->slug])}}" class="btn btn-primary find-more-btn">Add comment!</a>
				<h5 style="margin-top: 20px;">Average rating: {{ number_format($location->averageRating(), 2, '.', '') }}</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6" style="margin-bottom: 30px;">
				<p class="location-name">{{ $location->name }}</p>
			</div>
			@if($rating_user == null || $rating_user->created_at > $rating_expiration )
			<div class="col-sm-3">			
					<form class="rating">
					  <label>
					    <input type="radio" name="stars" value="1" />
					    <span class="icon">★</span>
					  </label>
					  <label>
					    <input type="radio" name="stars" value="2" />
					    <span class="icon">★</span>
					    <span class="icon">★</span>
					  </label>
					  <label>
					    <input type="radio" name="stars" value="3" />
					    <span class="icon">★</span>
					    <span class="icon">★</span>
					    <span class="icon">★</span>   
					  </label>
					  <label>
					    <input type="radio" name="stars" value="4" />
					    <span class="icon">★</span>
					    <span class="icon">★</span>
					    <span class="icon">★</span>
					    <span class="icon">★</span>
					  </label>
					  <label>
					    <input type="radio" name="stars" value="5" />
					    <span class="icon">★</span>
					    <span class="icon">★</span>
					    <span class="icon">★</span>
					    <span class="icon">★</span>
					    <span class="icon">★</span>
					  </label>
					</form>

			</div>
			<div class="col-sm-3">
				<form action="{{ route('location.rating', ['identifier' => $location->identifier]) }}" method="post">
					<input type="number" hidden="true" value="" id="star_rating" name="rating">
					{{ csrf_field() }}
					<button class="btn btn-primary find-more-btn" type="submit">Rate this location</button>
				</form>
			</div>
			@else
	
					<div class="col-sm 6">
						<h4>You already rated this location with {{ $location->userSumRating() }} stars this month.</h4>
					</div>
	
			@endif
		</div>
		<div class="row">
			<div class="col-lg-4 location-row">
				{{-- <span class="fab fa-facebook-square fa-4x"></span> --}}
				
				<div class="location-image" style="margin-top: 20px;">
					<img src="{{ asset($location->photo) }}" alt="" ;" style="width: 100%; height: 200px;object-fit: cover;">
				</div>
				<ul class="nav nav-pills">
					<li class="nav-item">
						<a class="nav-link active">{{ $location->mood->name }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active">{{ $location->type }}</a>
					</li>
				</ul>
			</div>
			<div class="col-lg-8 description-grid" style="margin-top: 20px;">
				<p>{{ $location->description }}</p>
			</div>
		</div>

	</div>
	<div class="container">
		<h3>Map</h3>
	</div>
	
	<div class="container" id="map" style="width: 100%; height: 200px; margin-bottom: 50px;">
			<script>
				function initMap() {

				  var loc = {lat:{{ $location->lat }} , lng: {{ $location->lng }}};
	              var map = new google.maps.Map(document.getElementById('map'), {
	                zoom: 14,
	                center: loc
	              });
	         	var marker = new google.maps.Marker({
	         		position: loc,
	         		map: map
	         	});

			}
			</script>
	</div>

	<div class="container">
		<h2 class="comment-head">Comments</h2>
		<br></br>
		@foreach($comments as $comment)
			<div class="row">
				<div class="col-lg-6">
						<div class="panel panel-default comment-panel">
							<div class="panel-heading">
								<a href="{{ route('view.profile', ['identifier' => $comment->user->identifier]) }}">
									<img src="{{ asset($comment->user->avatar) }}" alt="" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;">
								</a>
								<p class="comment-usert">{{ $comment->user->name }}</p>
							</div>
						  <div class="panel-body">
						    {{ $comment->comment }}
						  </div>
						</div>
				</div>
			</div>
		@endforeach
	</div>

			{{ $comments->appends(request()->except('page'))->links() }}

	 <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHoSEv07-ffKnlYnfaCxjILKOV6x-Mcfg&callback=initMap">
    </script>

    

@endsection