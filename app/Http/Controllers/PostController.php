<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  TCG\Voyager\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $posts = Post::where('title', 'like', '%' . $request->search . '%')
                ->orWhere('excerpt', 'like', '%' . $request->search . '%')
                ->orWhere('body', 'like', '%' . $request->search . '%')
                ->OrderBy('posts.created_at', 'desc');
            $countPosts = Post::count();
            $posts = $posts->paginate(6);
            // ->get()
            return view('posts.index')->with(compact('posts'))

                ->with(compact('countPosts'));
        }

        $posts = Post::OrderBy('posts.created_at', 'desc')->paginate(6);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        echo "Works!";
        $post = new Post();
        $post->post_title = $request->title;
        $post->short_title = Str::length($request->title) > 30 ? Str::substr($request->title, 0, 30) . "..." : $request->title;
        $post->description = $request->decription;
        $post->author_id = rand(1, 4);

        if ($request->file('img')) {
            $path = Storage::putFile('public', $request->file('img'));
            $url = Storage::url($path);
            $post->img = $url;
        }
        $post->save();
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::join('users', "author_id", '=', 'users.id')->find($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
