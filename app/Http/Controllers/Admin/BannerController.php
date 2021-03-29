<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class BannerController extends Controller
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
        $this->title = 'Banner';
        $this->subtitle = 'Banner Slideshow';

        $banners = Banner::get();
        
        return view('admin.banner.index',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'banners' => $banners,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'Add Banner';
        $this->subtitle = 'Buat banner baru';

        return view('admin.banner.create',[
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
    public function store(BannerRequest $request)
    {
        $data = ([
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
        ]);

        if ($request->file('image')){
            $image = $request->file('image');
            $imageName = Str::slug($data['name']).'-'.Str::random(6);
            $extension = $image->getClientOriginalExtension();
            $newImageName = $imageName . '.' . $extension;
            $imagePath = 'uploads/banners/'.$newImageName;

            $img = Image::make($image);
            $img->resize(1080, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->crop(1080, 400);
            $img->save($imagePath);

            $data['image'] = $imagePath;
        }

        $banner = Banner::create($data);
        $banner->save();

        return redirect()->route('admin.banners.edit',$banner->id)->with('successMessage', 'Banner has been created');
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
        $banner = Banner::findOrFail($id);

        $this->title = 'Edit Banner';
        $this->subtitle = $banner->name;

        return view('admin.banner.edit',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'banner' => $banner
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, $id)
    {
        $request->validated();

        $banner = Banner::findOrFail($id);

        $data = ([
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
        ]);

        if ($request->file('image')){

            if ($banner->image != null) {
                $oldImg = $banner->image;
                if(File::exists($oldImg)) {
                    File::delete($oldImg);
                }
            }

            $image = $request->file('image');
            $imageName = Str::slug($data['name']).'-'.Str::random(6);
            $extension = $image->getClientOriginalExtension();
            $newImageName = $imageName . '.' . $extension;
            $imagePath = 'uploads/banners/'.$newImageName;

            $img = Image::make($image);
            $img->resize(1080, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->crop(1080, 400);
            $img->save($imagePath);

            $data['image'] = $imagePath;
        }

        $banner->update($data);

        return redirect()->back()->with('successMessage', 'Banner has been updated');
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
