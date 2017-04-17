@extends('main')

@section('title', '| Create New Slide')

@section('stylesheets')

{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<script>
		tinymce.init({
			selector: 'textarea',
			plugins: 'link code',
			menubar: false
		});
	</script>

@endsection

@section('content')

<div class ="row">
<div class="col-md-8 col-md-offset-2">
    <h1>Create New Slide</h1>
    <hr>

    {!! Form::open(array('route' => 'slideshows.store', 'data-parsley-validate' => '', 'files' => true)) !!}
    {{ Form::label('title', 'Title:') }}
    {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

    {{ Form::label('url', 'Clickable link:') }}
    {{ Form::text('url', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

    {{ Form::label('filePath', 'Upload a Slide Picture') }}
    {{ Form::file('filePath') }}

     {{ Form::submit('Create Slide', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
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
