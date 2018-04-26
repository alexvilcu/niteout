@extends('layouts.app')

@section('content')
	<body>

    <!-- Navigation -->
    @include('includes.navbar')

    <!-- Page Content -->
    <div class="container locations" style="margin-bottom:150px; margin-top: 10px; ">

      @if($locations->count() > 0)
      <div class="row text-center">

        @foreach($locations as $location)
          <div class="locations col-lg-3 col-md-6 mb-4">
            <div class="card">
              <img class=" img-responsive card-img-top" src="{{ asset($location->photo) }}"  alt="" " style="width: 100%; height: 200px; object-fit: cover;">
              <div class="card-body">
                <h4 class="card-title">{{ $location->name }}</h4>
                <p class="card-text">{{ str_limit($location->description, $limit = 70, $end = '...')  }}</p>
              </div>
              <div class="card-footer">
                
                <a href="{{ route('locations.edit', ['identifier' => $location->identifier]) }}" class="btn btn-primary find-more-btn">Edit the location!</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <!-- /.row -->

    </div>
      @else
        <div class="container" style="margin-bottom: 600px; margin-top: 200px;">
          <div class="row">
            <div class="col-sm-6">
              <h2>No locations found!</h2>
            </div>
            <div class="col-sm-6">
              <a href="{{ route('locations.create') }}" class="btn btn-success">
                <h6>Create new location</h6>
              </a>
            </div>
          </div>
        </div>
      @endif

    <!-- /.container -->
    <div class="container pag">
        {{ $locations->appends(request()->except('page'))->links() }}
    </div>
  </body>
@endsection