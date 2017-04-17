@extends('main')

@section('title', '| Edit Post')

@section('stylesheet')
  {!! Html::style('css/select2.min.css') !!}

  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

  <script>
      tinymce.init({
          selector: 'textarea',
          plugins: 'link',
          menubar: false
      });
  </script>

@endsection

@section('content')
    <div class="row">

      {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PATCH', 'files' => true ]) !!}

        <div class="col-md-8">

              {{ Form::label('title', 'Title:', ['class' => 'margin20']) }}
              {{ Form::text('title', null, ['class' => 'form-control']) }}

              {{ Form::label('slug', 'Slug:', ['class' => 'margin20']) }}
              {{ Form::text('slug', null, ['class' => 'form-control']) }}

              {{ Form::label('category_id', 'Category:', ['class' => 'margin20']) }}
              {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

              {{ Form::label('tags', 'Tags:', ['class' => 'margin20']) }}
              {{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}

              {{ Form::label('featured_image', 'Upload Featured Image:', ['style'=> 'margin-top:10px']) }}
              {{ Form::file('featured_image') }}

              {{ Form::label('body', 'Body:', ['class' => 'margin20']) }}
              {{ Form::textarea('body', null, ['class' => 'form-control']) }}

        </div>

        <div class="col-md-4 margin20">
            <div class="well">
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
                        {!! Html::linkRoute('posts.show','Cancel', [$post->id], ['class' => 'btn btn-block btn-danger'] ) !!}
                    </div>
                    <div class="col-md-6">
                        {{ Form::submit('Save Changes', ['class' => 'btn btn-block btn-success']) }}
                    </div>
                </div>
            </div>
        </div>

      {!! Form::close() !!}

    </div><!-- End of the row -->

@endsection

@section('scripts')
  {!! Html::script('js/select2.min.js') !!}

  <script type="text/javascript">
      $('.select2-multi').select2();
      $('.select2-multi').select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change')
  </script>

@endsection
