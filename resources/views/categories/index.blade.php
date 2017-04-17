@extends('main')

@section('title', '| Categories')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Categories</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <th>{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- End of col-md-8 -->

        <div class="col-md-4">
            <div class="well margin20">
                {!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}

                      <h2>New Category</h2>
                      {{ Form::label('name', 'Name:') }}
                      {{ Form::text('name', null, ['class' => 'form-control']) }}

                      {{ Form::submit('Create New Category',['class' => 'btn btn-primary btn-block margin20']) }}

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
