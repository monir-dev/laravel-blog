<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Session;
use Purifier;
use Image;
use Storage;
use File;

class PostController extends Controller
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
        //Create a variable and store all the blog posts in it from the database
        $posts = Post::orderBy('id', 'desc')->paginate(10);

        //return a view and pass in the variable
        return view('posts.index')->withPosts($posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Grab all the categories
        $categories = Category::all();

        // Grab all the tags
        $tags = Tag::all();

        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Validate the data
        $this->validate($request, [
              'title' => 'required|max:255|min:6',
              'slug'  => 'required|alpha_dash|min:6|max:255|unique:posts,slug',
              'category_id' => 'required|integer',
              'body'  => 'required|min:6',
              'featured_image' => 'sometimes|image'

        ]);

        //Store in the database
        $post = new Post;

        $post->title = $request->title;
        $post->slug  = $request->slug;
        $post->category_id = $request->category_id;
        $post->body  = Purifier::clean($request->body);


        //save our image
        if ($request->hasFile('featured_image')) {
          $image = $request->file('featured_image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/' . $filename);
          Image::make($image)->resize(700, 400)->save($location);

          $post->image = $filename;
        }



        $post->save();

        //Associate tags with posts
        $post->tags()->sync($request->tags, false);

        //SessionHandler
        //For permanent session use Session::put
        //Session::flash is for temporary session
        Session::flash('success', 'The blog post was successfully saved!');

        //Redirect to another page
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find the post in the database and save as a variable
        $post = Post::find($id);

        //category instance to send to view
        $categories = Category::all();
        $cats = [];
        foreach ($categories as $category) {
          $cats[$category->id] = $category->name;
        }

        //tags instance to send to view
        $tags = Tag::all();
        $tag2 = [];
        foreach ($tags as $tag) {
          $tag2[$tag->id] = $tag->name;
        }

        // return the view and pass in the variable we previously created.
        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tag2);

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
        //Grab the post and Save the data to database
        $post = Post::find($id);

          //Validate the data
          $this->validate($request, [
            'title' => 'required|max:255|min:6',
            'slug'  => "required|alpha_dash|min:6|max:255|unique:posts,slug,$id",
            'category_id' => 'required|integer',
            'body'  => 'required|min:6',
            'featured_image' => 'image'
          ]);




        $post->title = $request->input('title');
        $post->slug  = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = Purifier::clean($request->input('body'));



        //save our image
        if ($request->hasFile('featured_image')) {
          //add new photo
          $image = $request->file('featured_image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/' . $filename);
          Image::make($image)->resize(700, 400)->save($location);
          $oldFileName = $post->image;

          //update the database
          $post->image = $filename;

          //delete the old photo
          $path = public_path('images/'. $oldFileName);
          File::delete($path);
          // Storage::delete($oldFileName);
        }

        $post->save();

        if (isset($request->tags)) {
          $post->tags()->sync($request->tags);
        }else{
          $post->tags()->sync([]);
        }


        //set flash data with success Message
        Session::flash('success', 'Post successfully updated.');

        //redirect with flash data to posts.show
        return redirect()->route('posts.show', $post->id);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find the Post
        $post = Post::find($id);

        $post->tags()->detach();
        // Storage::delete($post->image);
        $path = public_path('images/'. $post->image);
        File::delete($path);

        //Delete the post
        $post->delete();


        //set flash data with success Message
        Session::flash('success', 'The post is successfully deleted.');

        //Redirect to posts.index page with flash message
        return redirect()->route('posts.index');
    }
}
