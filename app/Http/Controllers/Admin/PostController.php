<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class PostController extends Controller
{
    public $title;
    public $subtitle;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'Blog Post';
        $this->subtitle = 'Daftar semua postingan';

        $posts = Post::latestFirst()->get();
        return view('admin.post.index',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'Add Blog Post';
        $this->subtitle = 'Buat postingan baru';

        return view('admin.post.create',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = ([
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'post_type' => 'POST',
            'body' => $request->body,
            'published_at' => $request->published_at,
            'status' => $request->status,
            'user_id' => auth()->user()->id,
        ]);

        if ($request->file('featured_image')){
            $image = $request->file('featured_image');
            $imageName = $data['slug'];
            $extension = $image->getClientOriginalExtension();
            $newImageName = $imageName . '.' . $extension;
            $imagePath = 'uploads/posts/'.$newImageName;

            $img = Image::make($image);
            $img->resize(720, 405, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save($imagePath);

            $data['featured_image'] = $imagePath;
        }

        $post = Post::create($data);
        $post->save();

        return redirect()->route('admin.posts.edit',$post->id)->with('successMessage', 'Blog post has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $this->title = 'Edit Blog Post';
        $this->subtitle = $post->title;

        return view('admin.post.edit',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $data = ([
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'body' => $request->body,
            'published_at' => $request->published_at,
            'status' => $request->status,
            'user_id' => auth()->user()->id,
        ]);

        if ($request->file('featured_image')){

            if ($post->featured_image != null) {
                $oldImg = Image::make($post->featured_image);
                if($oldImg) {
                    $oldImg->destroy();
                }
            }

            $image = $request->file('featured_image');
            $imageName = $data['slug'];
            $extension = $image->getClientOriginalExtension();
            $newImageName = $imageName . '.' . $extension;
            $imagePath = 'uploads/posts/'.$newImageName;

            $img = Image::make($image);
            $img->resize(720, 405, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save($imagePath);

            $data['featured_image'] = $imagePath;
        }

        $post->update($data);

        return redirect()->back()->with('successMessage', 'Blog post has been updated');
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
