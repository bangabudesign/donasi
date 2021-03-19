<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $contributors = number_format(User::where('is_admin', 0)->count());
        $campaigns = number_format(Campaign::count());
        $collected = number_format(Donation::paid()->sum('amount'));

        return view('admin.dashboard', [
            'contributors' => $contributors,
            'campaigns' => $campaigns,
            'collected' => $collected,
        ]);
    }
}
