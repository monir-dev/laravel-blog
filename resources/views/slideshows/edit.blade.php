@extends('main')

@section('title', '| Edit Slideshow')

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

      {!! Form::model($slide, ['route' => ['slideshows.update', $slide->id], 'method' => 'PATCH', 'files' => true ]) !!}

        <div class="col-md-8">

              {{ Form::label('title', 'Title:', ['class' => 'margin20']) }}
              {{ Form::text('title', null, ['class' => 'form-control']) }}

              {{ Form::label('url', 'Clickable Url:', ['class' => 'margin20']) }}
              {{ Form::text('url', null, ['class' => 'form-control']) }}

              {{ Form::label('filePath', 'Upload Slider Image:', ['style'=> 'margin-top:10px']) }}
              {{ Form::file('filePath') }}

        </div>

        <div class="col-md-4 margin20">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Created At:</dt>
                    <dd>{{ date('M j, Y h:ia', strtotime($slide->created_at)) }}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Last Updated:</dt>
                    <dd>{{ date('M j, Y h:ia', strtotime($slide->updated_at)) }}</dd>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        {!! Html::linkRoute('slideshows.show','Cancel', [$slide->id], ['class' => 'btn btn-block btn-danger'] ) !!}
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
