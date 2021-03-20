<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $meta_title;
    public $meta_description;
    public $meta_image;

    public function campaign($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $campaigns = Campaign::where('category_id', $category->id)->activeCampaign()
            ->latestFirst()
            ->with('user:id,name')
            ->paginate(12);

        return view('pages.campaign.index',[
            'meta_title' => $this->meta_title = config('app.name').' - '."Semua Campaign Kategori ".$category->name,
            'meta_description' => $this->meta_description = $category->description,
            'meta_image' => $this->meta_image,
            'campaigns' => $campaigns,
        ]);
    }
}
