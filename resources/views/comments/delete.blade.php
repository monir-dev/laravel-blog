@extends('main')

@section('title', '| Delete Comment')

@section('content')

      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <h1>Delete This comment?</h1>
              <p>
                  <strong>Name: </strong> {{ $comment->name }}<br>
                  <strong>Name: </strong> {{ $comment->email }}<br>
                  <strong>Name: </strong> {{ $comment->comment }}
              </p>

              {{ Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) }}
                  {{ Form::submit('YES DELETE THIS COMMENT', ['class' => 'btn btn-lg btn-block btn-danger']) }}
              {{ Form::close() }}
          </div>
      </div>

@endsection
