@extends('main')

@section('title', '| View Post')

@section('content')
    <div class="row">
      <div class="col-md-8">
        <img src="{{ asset('images/' . $post->image) }}" height="400" width="700">
        <h1>{{ $post->title }}</h1>

        <p class="lead">{!! $post->body !!}</p>
        <hr>

        <div class="tags">
            @foreach ($post->tags as $tag)
                <span class='label label-default'>{{ $tag->name }}</span>
            @endforeach
        </div>

        <div id="backend-comments" style="margin-top:50px;">
            <h3>Comments <small>{{ $post->comments()->count() }} total</small></h3>

            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th width="70px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post->comments as $comment)
                        <tr>
                            <td>{{ $comment->name }}</td>
                            <td>{{ $comment->email }}</td>
                            <td>{{ $comment->comment }}</td>
                            <td>
                                <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

      </div>



      <div class="col-md-4">
          <div class="well">
              <dl class="dl-horizontal">
                  <dt>Url:</dt>
                  <dd><a href="{{ route('blog.single', $post->slug) }}">{{ route('blog.single', $post->slug) }}</a></dd>
              </dl>

              <dl class="dl-horizontal">
                  <dt>Category:</dt>
                  <dd>{{ $post->category->name }}</dd>
              </dl>

              <dl class="dl-horizontal">
                  <dt>Created At:</dt>
                  <dd>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</dd>
              </dl>
              <dl class="dl-horizontal">
                  <dt>Last Updated:</dt>
                  <dd>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</dd>
              </dl>
              <hr>
              <div class="row">
                  <div class="col-md-6">
                      {!! Html::linkRoute('posts.edit','Edit', [$post->id], ['class' => 'btn btn-block btn-primary'] ) !!}
                  </div>
                  <div class="col-md-6">
                      {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE' ]) !!}

                          {{ Form::submit('Delete', ['class' => 'btn btn-block btn-danger']) }}

                      {!! Form::close() !!}
                  </div>
              </div>

              <div class="row">
                  <div class="col-md-12">
                      {{ Html::linkRoute('posts.index', '<< See All Posts', [], ['class' => 'btn btn-default btn-block margin20']) }}
                  </div>
              </div>
          </div>
      </div>

    </div>

@endsection
