<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['index', 'destroy']);
    }

    public function postIndex()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    //Admin index(dashboard) page
    public function index(Post $post)
    {
        return view('auth.dashboard')->with('post', $post);
    }


    public function show(Post $post)
    {
        return view('posts.show')->with('post', $post);
    }

    public function edit(Post $post)
    {
        return view('auth.editPost')->with('post', $post);
    }


    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'image' => 'required'
        ]);

        $post->update($request->all());
        return redirect()->route('dashboard');
    }


    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }
}
