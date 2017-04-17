@extends('main')

@section('title', '| Create New Post')

@section('stylesheet')
  {!! Html::style('css/parsley.css') !!}
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
    <div class="col-md-8 col-md-offset-2">
      <h1>Create New Posts</h1>
      <hr>

      {!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true ]) !!}
          {{ Form::label('title', 'Title:', ['style'=> 'margin-top:10px']) }}
          {{ Form::text('title', null, ['class'=>'form-control', 'required' => '', 'minlength' => '6' , 'maxlength' => '255']) }}

          {{ Form::label('slug', 'Slug:', ['style'=> 'margin-top:10px']) }}
          {{ Form::text('slug', null, ['class'=>'form-control', 'required' => '', 'minlength' => '6' ,'maxlength' => '255']) }}

          {{ Form::label('category_id', 'Category:', ['style'=> 'margin-top:10px']) }}
          <select class="form-control" name="category_id">

              @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach

          </select>


          {{ Form::label('tags', 'Tags:', ['style'=> 'margin-top:10px']) }}
          <select class="form-control select2-multi" name="tags[]" multiple="multiple">

              @foreach ($tags as $tag)
                  <option value="{{ $tag->id }}">{{ $tag->name }}</option>
              @endforeach

          </select>

          {{ Form::label('featured_image', 'Upload Featured Image:', ['style'=> 'margin-top:10px']) }}
          {{ Form::file('featured_image') }}

          {{ Form::label('body', 'Post Body:', ['style'=> 'margin-top:10px']) }}
          {{ Form::textarea('body', null, ['class'=>'form-control']) }}

          {{ Form::submit('Create New Post', ['class'=>'btn btn-success btn-block btn-lg', 'style'=> 'margin-top:20px']) }}

      {!! Form::close() !!}

    </div>
  </div>

@endsection

@section('scripts')
  {!! Html::script('js/parsley.min.js') !!}
  {!! Html::script('js/select2.min.js') !!}

  <script type="text/javascript">
      $('.select2-multi').select2();
  </script>

@endsection
