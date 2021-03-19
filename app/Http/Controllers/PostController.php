<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public $meta_title;
    public $meta_description;
    public $meta_image;

    public function index()
    {
        $posts = Post::activePost()
            ->latestFirst()
            ->with('user:id,name')
            ->paginate(12);

        return view('pages.post.index',[
            'meta_title' => $this->meta_title = config('app.name').' - '."Semua Postingan",
            'meta_description' => $this->meta_description = "Ayo berdonasi dan membangun ummat!",
            'meta_image' => $this->meta_image,
            'posts' => $posts,
        ]);
    }

    public function show($slug)
    {
        $post = Post::activePost()
            ->with('user:id,name')
            ->where('slug', $slug)
            ->firstOrFail();
            
        return view('pages.post.show',[
            'meta_title' => $this->meta_title = config('app.name').' - '.$post->title,
            'meta_description' => $this->meta_description = $post->short_description,
            'meta_image' => $this->meta_image = $post->thumbnail,
            'post' => $post,
            'next_post' => $post->next_post,
            'prev_post' => $post->prev_post,
        ]);
    }
}
