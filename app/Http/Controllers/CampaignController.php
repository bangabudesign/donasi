<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public $meta_title;
    public $meta_description;
    public $meta_image;

    public function index()
    {
        $campaigns = Campaign::activeCampaign()
            ->latestFirst()
            ->with('user:id,name')
            ->paginate(12);

        return view('pages.campaign.index',[
            'meta_title' => $this->meta_title = config('app.name').' - '."Semua Campaign",
            'meta_description' => $this->meta_description = "Ayo berdonasi dan membangun ummat!",
            'meta_image' => $this->meta_image,
            'campaigns' => $campaigns,
        ]);
    }

    public function show($slug)
    {
        $campaign = Campaign::activeCampaign()
            ->with('user:id,name')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.campaign.show',[
            'meta_title' => $this->meta_title = config('app.name').' - '.$campaign->title,
            'meta_description' => $this->meta_description = $campaign->short_description,
            'meta_image' => $this->meta_image = $campaign->thumbnail,
            'campaign' => $campaign,
            'donations' => $campaign->donations()->paid()->limit(20)->get()
        ]);
    }
}
