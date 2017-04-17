@extends('main')

@section('title', '| Contact us')

@section('content')
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1 class="text-center">Contact Us</h1><hr>

            <form class="form-horizontal" action="{{ url('contact') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
              </div>
              <div class="form-group">
                <label for="subject" class="col-sm-2 control-label">Subject</label>
                <div class="col-sm-10">
                  <input type="text" name="subject" class="form-control" placeholder="Subject">
                </div>
              </div>
              <div class="form-group">
                <label for="message" class="col-sm-2 control-label">Subject</label>
                <div class="col-sm-10">
                  <textarea name="message" class="form-control" rows="5" placeholder="Type your message here..."></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-success">Send Message</button>
                </div>
              </div>
            </form>
        </div>
      </div>
@endsection
