<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\CampaignRequest;
use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class CampaignController extends Controller
{
    public $title;
    public $subtitle;
    public $categories;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'Campaigns';
        $this->subtitle = 'Daftar semua kampanye';

        $campaigns = Campaign::latestFirst()->get();
        
        return view('admin.campaign.index',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'campaigns' => $campaigns,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'Add Campaign';
        $this->subtitle = 'Buat kampanye baru';

        $this->categories = Category::get();

        return view('admin.campaign.create',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'categories' => $this->categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampaignRequest $request)
    {
        $data = ([
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'donation_target' => $request->donation_target,
            'finished_at' => $request->finished_at,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'published_at' => $request->published_at,
            'status' => $request->status,
            'verified_at' => $request->verified_at,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
        ]);

        if ($request->file('featured_image')){
            $image = $request->file('featured_image');
            $imageName = $data['slug'].'-'.Str::random(6);
            $extension = $image->getClientOriginalExtension();
            $newImageName = $imageName . '.' . $extension;
            $imagePath = 'uploads/campaigns/'.$newImageName;

            $img = Image::make($image);
            $img->resize(720, 405, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save($imagePath);

            $data['featured_image'] = $imagePath;
        }

        $campaign = Campaign::create($data);
        $campaign->save();

        return redirect()->route('admin.campaigns.edit',$campaign->id)->with('successMessage', 'Campaign has been created');
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
        $campaign = Campaign::findOrFail($id);

        $this->title = 'Edit Campaign';
        $this->subtitle = $campaign->title;

        $this->categories = Category::get();

        return view('admin.campaign.edit',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'categories' => $this->categories,
            'campaign' => $campaign
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CampaignRequest $request, $id)
    {
        $request->validated();

        $campaign = Campaign::findOrFail($id);

        $data = ([
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'donation_target' => $request->donation_target,
            'finished_at' => $request->finished_at,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'published_at' => $request->published_at,
            'status' => $request->status,
            'verified_at' => $request->verified_at,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
        ]);

        if ($request->file('featured_image')){

            if ($campaign->featured_image != null) {
                $oldImg = $campaign->featured_image;
                if(File::exists($oldImg)) {
                    File::delete($oldImg);
                }
            }

            $image = $request->file('featured_image');
            $imageName = $data['slug'].'-'.Str::random(6);
            $extension = $image->getClientOriginalExtension();
            $newImageName = $imageName . '.' . $extension;
            $imagePath = 'uploads/campaigns/'.$newImageName;

            $img = Image::make($image);
            $img->resize(720, 405, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save($imagePath);

            $data['featured_image'] = $imagePath;
        }

        $campaign->update($data);

        return redirect()->back()->with('successMessage', 'Campaign has been updated');
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
