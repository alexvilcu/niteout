@extends('layouts.app')

@section('content')

<div class="container" style="margin-bottom: 700px; margin-top: 100px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add a comment</div>

                <div class="panel-body">
                    <form action="{{ route('comment.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                       
                        <div class="form-group">
                              <textarea name="comment" id="description" cols="60" rows="8" placeholder="Enter description here"></textarea>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="location_slug" value="{{ $location->slug }}">
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="location_id" value="{{ $location->id }}">
                        </div>

                        <div class="form-group">
                              <button class="btn btn-primary find-more-btn" type="submit">Leave comment</button>
                        </div> 
                        
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection