@extends('main')

@section('title', '| Edit Comment')

@section('content')

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h3>Edit Comment</h3>

        {{ Form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => 'PUT']) }}

            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name', null, ['class' => 'form-control', 'disabled' => '']) }}

            {{ Form::label('email', 'Email:', ['class' => 'margin20']) }}
            {{ Form::text('email', null, ['class' => 'form-control', 'disabled' => '']) }}

            {{ Form::label('comment', 'Comment:', ['class' => 'margin20']) }}
            {{ Form::textarea('comment', null, ['class' => 'form-control']) }}

            {{ Form::submit('Update Comment', ['class' => 'btn btn-block btn-success margin20']) }}

        {{ Form::close() }}
      </div>
    </div>

@endsection
