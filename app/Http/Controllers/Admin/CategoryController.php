<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class CategoryController extends Controller
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
        $this->title = 'Category';
        $this->subtitle = 'Category Slideshow';

        $categories = Category::get();
        
        return view('admin.category.index',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'Add Category';
        $this->subtitle = 'Buat category baru';

        return view('admin.category.create',[
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
    public function store(CategoryRequest $request)
    {
        $data = ([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'description' => $request->description,
        ]);

        if ($request->file('image')){
            $image = $request->file('image');
            $imageName = $data['slug'].'-'.Str::random(6);
            $extension = $image->getClientOriginalExtension();
            $newImageName = $imageName . '.' . $extension;
            $imagePath = 'uploads/categories/'.$newImageName;

            $img = Image::make($image);
            $img->save($imagePath);

            $data['image'] = $imagePath;
        }

        $category = Category::create($data);
        $category->save();

        return redirect()->route('admin.categories.edit',$category->id)->with('successMessage', 'Category has been created');
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
        $category = Category::findOrFail($id);

        $this->title = 'Edit Category';
        $this->subtitle = $category->name;

        return view('admin.category.edit',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $request->validated();

        $category = Category::findOrFail($id);

        $data = ([
            'name' => $request->name,            
            'slug' => Str::slug($request->slug),
            'description' => $request->description,
        ]);

        if ($request->file('image')){

            if ($category->image != null) {
                $oldImg = $category->image;
                if(File::exists($oldImg)) {
                    File::delete($oldImg);
                }
            }

            $image = $request->file('image');
            $imageName = $data['slug'].'-'.Str::random(6);
            $extension = $image->getClientOriginalExtension();
            $newImageName = $imageName . '.' . $extension;
            $imagePath = 'uploads/categories/'.$newImageName;

            $img = Image::make($image);
            $img->save($imagePath);

            $data['image'] = $imagePath;
        }

        $category->update($data);

        return redirect()->back()->with('successMessage', 'Category has been updated');
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
