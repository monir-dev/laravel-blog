<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use Session;
use Carbon\Carbon;
use App\Slideshow;

class PagesController extends Controller
{
    //

    public function getContact(){
      return view('pages.contact');
    }

    public function postContact(Request $request){
      $this->validate($request, [
          'email' => 'required|email',
          'subject' => 'min:3|max:255',
          'message' => 'min:10|max:500'
      ]);

      $data = [
          'email' => $request->email,
          'subject' => $request->subject,
          'bodyMessage' => $request->message
      ];

      Mail::send('emails.contact', $data, function($message) use ($data){
          $message->from($data['email']);
          $message->to('postmailcamp@gmail.com');
          $message->subject($data['subject']);

      });

      Session::flash('success', 'Your email was sent');

      return redirect('/');

    }

    public function getAbout(){
      return view( 'pages.about');
    }

    public function getIndex(){

        $slides = Slideshow::all();
        $posts = Post::latest();

        if ($month = request('month')) {
            $posts->whereMonth('created_at','=', Carbon::parse($month)->month);
        }
        if ($year = request('year')) {
            $posts->whereYear('created_at', '=', $year);
        }

        $posts = $posts->paginate(5);

        $archives = Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
                    ->groupBy('year', 'month')
                    ->get()
                    ->toArray();


        return view('pages.welcome')->withPosts($posts)->withArchives($archives)->withSlides($slides);
    }





}
