<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Slideshow;
use Session;
use Image;
use Storage;
use File;

class SlideshowController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $slides = Slideshow::latest()->paginate(10);
      return view('slideshows.index')->withSlides($slides);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('slideshows.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // validate the data
      $this->validate($request, array(
              'title'         => 'required|max:255',
              'url'          => 'required',
              'filePath' => 'sometimes|image'
          ));

      // store in the database
      $slide = new Slideshow;

      $slide->title = $request->title;
      $slide->url = $request->url;

      //save our image
      if ($request->hasFile('filePath')) {
          $image = $request->file('filePath');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/slideshow/' . $filename);
          Image::make($image)->resize(1360, 800)->save($location);

          $slide->filePath = $filename;
      }



      $slide->save();

      Session::flash('success', 'The Slide was successfully save!');

      return redirect()->route('slideshows.show', $slide->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $slide = Slideshow::find($id);
      return view('slideshows.show')->withSlide($slide);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      // find the post in the database and save as a var
      $slide = Slideshow::find($id);
      // return the view and pass in the var we previously created
      return view('slideshows.edit')->withSlide($slide);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // Validate the data
      $slide = Slideshow::find($id);


      $this->validate($request, array(
              'title' => 'required|max:255',
              'url'  => 'required',
              'fiePath' => 'sometimes|image'
          ));

      // Save the data to the database
      $slide->title = $request->input('title');
      $slide->url = $request->input('url');
      if ($request->hasFile('filePath')) {
          // add the new photo
          $image = $request->file('filePath');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/slideshow/' . $filename);
          Image::make($image)->resize(1360, 800)->save($location);
          $oldFilename = $slide->filePath;
          // update the database
            $slide->filePath = $filename;
          // Delete the old photo
          // Storage::delete($oldFilename);
          $path = public_path('images/slideshow/'. $oldFilename);
          File::delete($path);
      }

      $slide->save();

      // set flash data with success message
      Session::flash('success', 'This slide was successfully Updated.');

      // redirect with flash data to posts.show
      return redirect()->route('slideshows.show', $slide->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $slide = Slideshow::find($id);
      // Storage::delete($slide->filePath);
      $path = public_path('images/slideshow/'. $slide->filePath);
      File::delete($path);

      $slide->delete();

      Session::flash('success', 'This slider was successfully deleted.');
      return redirect()->route('slideshows.index');
    }
}
