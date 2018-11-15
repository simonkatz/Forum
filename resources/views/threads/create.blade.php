@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new thread</div>

                <div class="card-body">
                  <form class="" action="/threads" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="title">Title:</label>
                      <input type="text" name="title" class="form-control" value="" placeholder="Title" id="title">
                    </div>
                    <div class="form-group">
                      <label for="body">Body:</label>
                      <textarea type="text" name="body" class="form-control" value="" rows="8" placeholder="Body" id="body"></textarea>
                    </div>
                    <button type="submit" name="Submit" class="btn btn-outline-primary">Publish</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
