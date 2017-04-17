
@extends('main')

@section('title', '| Homepage')



@section('slider')
    <div class="row">
          @include('partials.slider')
    </div>
@endsection

@section('content')
      

      <div class="row">
        <div class="col-md-8">

          @foreach ($posts as $post)

              <div class="post">
                <h3>{{ $post->title }}</h3>
                <p>{{ substr(strip_tags($post->body), 0 , 300) }} {{ strlen(strip_tags($post->body)) > 300 ? "..." : "" }}</p>
                 <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read More</a>
              </div>
              <hr>

          @endforeach

          <div class="row">
              <div class="col-md-8">
              </div>
              <div class="col-md-4">
                  {{ $posts->links() }}
              </div>
          </div>
          
        </div>

        <div class="col-md-4">
          <h1>Sidebar</h1>
          <ol class="list-unstyled">
              @foreach ($archives as $stats)
                  <li>
                      <a href="/?month={{ $stats['month'] }}&year={{ $stats['year'] }}">
                        {{ $stats['month']. ' '. $stats['year'] }}
                      </a>
                  </li>
              @endforeach
           </ol>
        </div>
      </div>

@endsection
