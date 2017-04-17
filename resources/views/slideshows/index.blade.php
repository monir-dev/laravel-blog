@extends('main')

@section('title', '| All slideshows')

@section('content')

	<div class="row">
		<div class="col-md-10">
			<h1>All slideshows</h1>
		</div>

		<div class="col-md-2">
			<a href="{{ route('slideshows.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New Slide</a>
		</div>
		<div class="col-md-12">
			<hr>
		</div>
	</div> <!-- end of .row -->

	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<th>#</th>
					<th>Title</th>
					<th>FilePath</th>
					<th>url</th>
					<th></th>
				</thead>

				<tbody>

					@foreach ($slides as $slide)

						<tr>
							<th>{{ $slide->id }}</th>
							<td>{{ $slide->title }}</td>
							<td>{{ substr(strip_tags($slide->filePath), 0, 50) }}{{ strlen(strip_tags($slide->filePath)) > 50 ? "..." : "" }}</td>
							<td>{{ $slide->url }}</td>
							<td><a href="{{ route('slideshows.show', $slide->id) }}" class="btn btn-default btn-sm">View</a> <a href="{{ route('slideshows.edit', $slide->id) }}" class="btn btn-default btn-sm">Edit</a></td>
						</tr>

					@endforeach

				</tbody>
			</table>

            <div class="text-center">
            {!! $slides->links(); !!}
            </div>
		</div>
	</div>

@stop
