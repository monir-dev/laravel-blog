<!DOCTYPE html>
<html lang="en">
  <head>

    @include('partials.head')

    @yield('stylesheet')

  </head>
  <body>

    @include('partials.nav')

    <div class="container-fluid">
        @yield('slider')
    </div>

    <div class="container">

      @include('partials.messages')

      @yield('content')

      @include('partials.footer')

    </div>



    @include('partials.scripts')

    @yield('scripts')

  </body>
</html>
