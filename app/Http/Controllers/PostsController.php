<?php

namespace App\Http\Controllers;

// handling requests
use Illuminate\Http\Request;
// use storage for imgage handling
use Illuminate\Support\Facades\Storage;
// call the model Post and use Eloquent for database handling
use App\Post;
// to use database SQL structure, we just call the database library
use DB;

class PostsController extends Controller
{
    /**
     * Create a new middleware for our posts. Unless a user logs in with their credentatials, they cannot see the blogs i.e a guest user have to login to see the blogs.
     *
     * @return void
     */
    public function __construct()
    {
        // we are using except to view the index and show pages
        $this->middleware('auth' , ['except' => ['index' , 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // CRUD resourse functions

    // index
    // create
    // store
    // edit
    // update
    // show
    // destroy
    public function index()
    {
        //load the view with Post values
        // we are using Eloquent for database handling. Here, Post is the model.
        // $posts = Post::all();
        // return Post::where('title',''Post Two)->get();
        // $posts = DB::select('SELECT * FROM posts');
        // $posts = Post::orderBy('title','asc')->take(1)->get();
        $posts = Post::orderBy('created_at','asc')->paginate(2);

        // $posts = Post::orderBy('title','asc')->get();

        // return the collection of posts
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Create a view for blogs entry
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //on click of the submit button, the store function gets on the action. Here, we can check for validation
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            // image validation. many php server allow image size to be of 2MP
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle file upload. This checks if the user actually clicked the upload button to choose and select a file.
        if($request->hasFile('cover_image'))
        {
        // Get file name with extension i.e- this will get the exact image name
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get file name. Here, pathaino is a php function
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get file extension. Here, we are using laravel function
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // To store unique file name
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Store the uploaded image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
        else
        {
        // if they didn't select a file
            $fileNameToStore = 'noimage.jpg';
        }

        // Create our Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        // we can use auth because of the authentication we had enable. now we can get access to any user's field.
        // currently logged in user id
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;

        $post->save();

        return redirect('/posts')->with('success','Post Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Pass id of individual blog
        $post= Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Edit the posts
        $post= Post::find($id);

        // Restrict manual access to edit page
        if(auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with('error', 'Unauthorized Request');
        }

        return view('posts.edit')->with('post',$post);
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
       //on click of the submit button, the store function gets on the action. Here, we can check for validation
       $this->validate($request, [
        'title' => 'required',
        'body' => 'required'
        ]);

        // Handle file upload. This checks if the user actually clicked the upload button to choose and select a file.
        if($request->hasFile('cover_image'))
        {
        // Get file name with extension i.e- this will get the exact image name
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get file name. Here, pathaino is a php function
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get file extension. Here, we are using laravel function
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // To store unique file name
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Store the uploaded image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        // Update our Post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        // condition for updating the image
        if($request->hasFile('cover_image'))
        {
            $post->cover_image = $fileNameToStore;
        }

        $post->save();

        return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete a post
        $post = Post::find($id);

        // Restrict manual access to delete page
        if(auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with('error', 'Unauthorized Request');
        }
        // delete the images with posts too
        if($post->cover_image != 'noimage.jpg')
        {
            // Delete the image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success','Post Deleted');
    }
}
