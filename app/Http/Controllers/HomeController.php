<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $meta_title;
    public $meta_description;
    public $meta_image;

    public function index()
    {
        $banners = Banner::get();

        $categories = Category::nameFirst()
            ->get();

        $campaigns = Campaign::activeCampaign()
            ->latestFirst()
            ->with('user:id,name')
            ->limit(8)
            ->get();

        $wishes = Transaction::latestFirst()->wishes()->get();

        return view('home',[
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_image' => $this->meta_image,
            'banners' => $banners,
            'categories' => $categories,
            'campaigns' => $campaigns,
            'wishes' => $wishes,
        ]);
    }
}
