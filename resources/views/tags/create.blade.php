@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Adding new music tag</div>

                <div class="panel-body">
                    <form action="{{ route('tags.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                              <label for="name">Music tag</label>
                              <input type="text" name="name" class="form-control" value="">
                        </div>
                       
                        <div class="form-group">
                              <button class="form-control btn btn-success">Save music tag</button>
                        </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection