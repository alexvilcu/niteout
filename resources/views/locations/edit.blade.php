@extends('layouts.app')

@section('content')

<div class="container locations">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editing location</div>

                <div class="panel-body">
                    <form action="{{ route('locations.update') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                              <label for="name">Location name</label>
                              <input type="text" name="name" class="form-control" value="">
                        </div>
                        <div class="form-group">
                              <label for="address">Address</label>
                              <input type="text" name="address" class="form-control" value="">
                        </div>
                        <div class="form-group">
                              <label for="image">Image</label>
                              <input type="file" name="image" class="form-control">
                        </div>
                        <div class="form-group">
                              <textarea name="description" id="description" cols="40" rows="5" placeholder="Enter description here"></textarea>
                        </div>
            						<div class="form-group">
            							  <label for="sel1">Select the location type:</label>
            							  <select name="type" class="form-control" id="sel1">
            							  	<option value="" selected disabled hidden>Choose here</option>
            							    <option value="bar">Bar</option>
            							    <option value="restaurant">Restaurant</option>
            							    <option value="club">Club</option>
            							    <option value="lounge">Lounge</option>
            							  </select>
            						</div>

                        <div class="form-group">
                            <label for="mood">Select a mood of the location</label>
                            <select name="mood" id="mood">
                              <option value="" selected disabled hidden>Choose here</option>
                            @foreach($moods as $mood)
                              <option value="{{ $mood->id }}">{{ $mood->name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="users">Select music</label>
                            <select name="music_tags[]" id="tag" class="form-control" multiple="multiple">
                                 @foreach($tags as $tag)
                                 <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                 @endforeach
                            </select>
                                </div>
                            </div>
                        <div class="form-group">
                              <button class="form-control btn btn-success" type="submit">Save location</button>
                        </div> 
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection