<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use APP\User;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){

        $this->middleware('checkCategory')->only('create');


    }
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
       
       $post = Post::create([

            'title' =>$request->title,
            'description' =>$request->description,
            'content' =>$request->content,
            'image' =>$request->image->store('images','public'),
            'category_id'=>$request->categoryID,
            'user_id'=>Auth::user()->id
        ]);

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }
        
        session()->flash('success','Post Created Successfully');
        return redirect(route('posts.index'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    { 
        $user = $post->user;
        $profile = $user->profile;
        return view('posts.show')->with('post',$post)->with('categories',Category::all())->with('profile',$profile)->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post',$post)->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title','description','content']);
        if ($request->hasFile('image')) {
          $image = $request->image->store('images','public');
          Storage::disk('public')->delete($post->image);
          $data['image']=$image;
        }
        if ($request->tags) {
        $post->tags()->sync($request->tags);
        }
        $post->update($data);

        session()->flash('success','Post Updated Successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id',$id)->first();
        if ($post->trashed()) {
            Storage::disk('public')->delete($post->image);
           $post->forceDelete();
        }else{
            $post->delete();
        }
        session()->flash('success','Post Trashed Successfully');
        return redirect(route('posts.index'));
    }
    public function trashed(){
 
            $trashed = Post::onlyTrashed()->get();

             return view('posts.index')->with('posts',$trashed);

    }
    public function restore($id){

        Post::withTrashed()->where("id",$id)->restore();

        session()->flash('success','Post Restored Successfully');
        return redirect(route('posts.index'));

    }
}
