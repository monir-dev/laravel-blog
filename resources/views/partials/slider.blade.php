<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="margin-top: -20px;">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    @foreach ($slides as $slide)
        <li data-target="#carousel-example-generic" data-slide-to="{{ $slide->id }}" class="active"></li>
    @endforeach
  </ol>


  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    {{--*/ $isFirst = true; /*--}}
    @foreach ($slides as $slide)
        <div class="item{{ $isFirst ? ' active' : '' }}">
            <img src="{{asset('images/slideshow/'.$slide->filePath)}}" class="img-responsive"  alt="...">
            <div class="carousel-caption">
              <h3><a href="{{ $slide->url }}">{{ $slide->title }}</a></h3>
            </div>
        </div>
    {{--*/ $isFirst = false; /*--}}

    @endforeach
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
