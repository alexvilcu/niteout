@extends('layouts.app')

@section('content')
  
  <header class="masthead">
    <div class="intro-body">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            @include('flash::message')
          </div>  
        </div>
        <div class="row">
          <div class="col-lg-12">
            <h1 class="brand-heading">NiteOut</h1>
            <p class="intro-text">Your personal 'going-out' advisor</p>
          </div>
        </div>
      </div>
    </div>
  </header>

  <section id="about" class="content-section text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2>About NiteOut</h2>
            <p>NiteOut helps you find places that suites your mood. Do you have  a certain music preference? Search for locations where you can listen that type of music. You fell in love with a place? Share that with others by adding that location to NiteOut so that they can enjoy it too.
          </div>
        </div>
      </div>
  </section>

  <section id="filter" class="download-section content-section text-center">
      <div class="container">
        
          <div class="col-lg-8 mx-auto">
            <h2>What kind of mood do you have for this going-out?</h2>
            <p>Search for a location where you will find a certain type of music.</p>
          </div>
        <form action="{{ route('locations.search') }}" method="get">
                  {{ csrf_field() }}
          <div class="form-row search-row">
              <div class="col search-col">
                <select name="tag" id="tag" style="width: 100%;">
                  <option value=""></option>
                   @foreach($tags as $tag)
                   <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                   @endforeach
                </select>
              </div>
              <div class="col search-col">
                <select name="mood" id="mood" style="width: 100%;">
                  <option value=""></option>
                  @foreach ($moods as $mood)
                    <option value="{{ $mood->id }}">{{ $mood->name }}</option>
                  @endforeach
                </select>
              </div>
          </div>
          <div class="row">
            <div class="col">
              <button class="btn btn-default" type="submit" style="margin-top: 50px;">Search</button>
            </div>
          </div>       
        </form>
      </div>
    </section>
@endsection