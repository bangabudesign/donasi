<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DonationRequest;
use App\Models\Campaign;
use App\Models\Transaction;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;

class DonationController extends Controller
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
        $this->title = 'Donations';
        $this->subtitle = 'Daftar semua donasi';

        $donations = Transaction::latestFirst()->donation()->get();

        return view('admin.donation.index',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'donations' => $donations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'Add Donation';
        $this->subtitle = 'Buat donasi baru';

        $campaigns = Campaign::latestFirst()->get();
        $users = User::get();
        $admins = User::where('is_admin', 1)->get();
        $methods = PaymentMethod::active()->get();

        return view('admin.donation.create',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'campaigns' => $campaigns,
            'users' => $users,
            'admins' => $admins,
            'methods' => $methods,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonationRequest $request)
    {
        // generating invoice number
        $alphanum = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $invoice = substr(str_shuffle($alphanum), 0, 6);

        $data = ([
            'invoice' => $invoice,
            'user_id' => $request->user_id,
            'payment_method_id' => $request->payment_method_id,
            'amount' => $request->amount,
            'is_anonim' => $request->is_anonim ?? 0,
            'comment' => $request->comment,
            'status' => $request->status,
            'payment_status' => $request->payment_status ?? 0,
            'payment_date' => $request->payment_date,
            'payment_detail_1' => $request->payment_detail_1,
            'payment_detail_2' => $request->payment_detail_2,
            'payment_detail_3' => $request->payment_detail_3,
            'verified_at' => $request->verified_at,
            'verified_by' => $request->verified_by,
        ]);

        $campaign = Campaign::findOrFail($request->campaign_id);
        $campaign->donations()->create($data);

        return redirect()->route('admin.donations.index')->with('successMessage', 'Donation has been created');
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
        $donation = Transaction::findOrFail($id);

        $this->title = 'Edit Donation';
        $this->subtitle = $donation->user->name.' - '.$donation->transactionable->title;

        $campaigns = Campaign::latestFirst()->get();
        $users = User::get();
        $admins = User::where('is_admin', 1)->get();
        $methods = PaymentMethod::active()->get();

        return view('admin.donation.edit',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'donation' => $donation,
            'campaigns' => $campaigns,
            'users' => $users,
            'admins' => $admins,
            'methods' => $methods,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DonationRequest $request, $id)
    {
        $donation = Transaction::findOrFail($id);

        $data = ([
            'user_id' => $request->user_id,
            'payment_method_id' => $request->payment_method_id,
            'amount' => $request->amount,
            'is_anonim' => $request->is_anonim ?? 0,
            'comment' => $request->comment,
            'status' => $request->status,
            'payment_status' => $request->payment_status ?? 0,
            'payment_date' => $request->payment_date,
            'payment_detail_1' => $request->payment_detail_1,
            'payment_detail_2' => $request->payment_detail_2,
            'payment_detail_3' => $request->payment_detail_3,
            'verified_at' => $request->verified_at,
            'verified_by' => $request->verified_by,
        ]);

        $donation->update($data);

        return redirect()->route('admin.donations.index')->with('successMessage', 'Donation has been updated');
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
