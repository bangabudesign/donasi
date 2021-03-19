<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $meta_title;
    public $meta_description;
    public $meta_image;

    public function index()
    {
        $campaigns = Campaign::activeCampaign()
            ->latestFirst()
            ->with('user:id,name')
            ->limit(8)
            ->get();

        return view('home',[
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_image' => $this->meta_image,
            'campaigns' => $campaigns,
        ]);
    }
}
