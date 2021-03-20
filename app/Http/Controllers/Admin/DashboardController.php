<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $contributors = number_format(User::where('is_admin', 0)->count());
        $campaigns = number_format(Campaign::count());
        $donation = number_format(Transaction::paid()->donation()->sum('amount'));
        $zakat = number_format(Transaction::paid()->zakat()->sum('amount'));

        return view('admin.dashboard', [
            'contributors' => $contributors,
            'campaigns' => $campaigns,
            'donation' => $donation,
            'zakat' => $zakat,
        ]);
    }
}
