@extends('layouts.app')

@section('content')
	<body>

    <!-- Navigation -->
    @include('includes.navbar')

    <!-- Page Content -->
    <div class="container locations" style="margin-bottom:150px; margin-top: 10px; ">

      <div class="row text-center">

        @foreach($locations as $location)
          <div class="locations col-lg-3 col-md-6 mb-4">
            <div class="card">
              <img class=" img-responsive card-img-top" src="{{ asset($location->photo) }}"  alt="" ">
              <div class="card-body">
                <h4 class="card-title">{{ $location->name }}</h4>
                <p class="card-text">{{ $location->description }}</p>
              </div>
              <div class="card-footer">
                <a href="{{ route('locations.show', ['slug' => $location->slug]) }}" class="btn btn-primary find-more-btn">Find Out More!</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
    <div class="container pag">
        {{ $locations->appends(request()->except('page'))->links() }}
    </div>
  </body>
@endsection