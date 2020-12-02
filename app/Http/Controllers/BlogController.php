<?php

namespace App\Http\Controllers;

use \TCG\Voyager\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 9;
        $posts = Post::where('status', 'PUBLISHED');
        // dd($posts);
        if (request()->sort == 'newest') {
          $posts = $posts->orderBy('created_at')->paginate($pagination);
        }elseif (request()->sort == 'oldest') {
          $posts = $posts->orderBy('created_at', 'desc')->paginate($pagination);
        }else {
          $posts = $posts->paginate($pagination);
        }

        return view('blog.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        $post = Post::where('slug', $post)->first();
        if ($post->status != 'PUBLISHED') {
          return redirect()->route('blog.index')->withErrors('Something went wrong... We cannot find the Blog post.');
        }
        $posts = Post::where('status', 'PUBLISHED')->take(3)->inRandomOrder()->get();

        return view('blog.show', compact('post', 'posts'));
    }
}
