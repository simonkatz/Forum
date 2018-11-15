@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <a href="#">{{ $thread->creator->name }}</a> posted: 
                  {{ $thread->title }}
                </div>

                <div class="card-body">
                      {{ $thread->body }}
                </div>
            </div>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
          @foreach($thread->replies as $reply)
            @include('threads.reply')
          @endforeach
        </div>
    </div>
    @if(auth()->check())
      <div class="row justify-content-center" style="padding-top:30px;">
          <div class="col-md-8">
            <form method="POST" action="{{ $thread->path() . '/replies' }}">
              {{ csrf_field() }}
              <div class="form-group">
                <textarea name="body" id="body" placeholder="Have something to say?" rows="5" class="form-control"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Post</button>
            </form>
          </div>
      </div>
    @else
      <div class="text-center" style="padding-top:30px;">
        Please <a href="/login">sign In</a> to participate
      </div>
    @endif
</div>
@endsection
