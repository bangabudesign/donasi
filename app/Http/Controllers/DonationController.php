<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Transaction;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\DonationCreated;

class DonationController extends Controller
{
    public function amount($slug)
    {
        $campaign = Campaign::activeCampaign()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.donation.amount', ['campaign' => $campaign]);
    }

    public function payment($slug)
    {
        $campaign = Campaign::activeCampaign()
            ->where('slug', $slug)
            ->firstOrFail();

        $methods = PaymentMethod::active()->get();

        return view('pages.donation.payment', [
            'campaign' => $campaign,
            'methods' => $methods,
        ]);
    }

    public function contribute($slug)
    {
        $campaign = Campaign::activeCampaign()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.donation.contribute', [
            'campaign' => $campaign,
        ]);
    }

    public function store(Request $request, $slug)
    {
        $campaign = Campaign::activeCampaign()
            ->where('slug', $slug)
            ->firstOrFail();

        if (auth()->guest()) {
            $this->_validateUser($request);
        }
        
        $request->validate([
            'payment_method_id' => 'required|exists:payment_methods,id',
            'amount' => 'required|integer|min:10000',
            'is_anonim' => 'nullable',
            'comment' => 'nullable|max:140'
        ]);

        // generating invoice number
        $alphanum = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $invoice = substr(str_shuffle($alphanum), 0, 6);

        $data = ([
            'invoice' => $invoice,
            'amount' => $request->amount,
            'is_anonim' => $request->is_anonim ?? 0,
            'comment' => $request->comment,
            'user_id' => auth()->user()->id,
            'payment_method_id' => $request->payment_method_id,
            'status' => 1,
        ]);

        $donation = $campaign->donations()->create($data);
        $donation->save();

        // send notification to user
        $donation->user->notify(new DonationCreated($donation));

        return redirect()->route('transaction.invoice', $donation->invoice);
    }

    private function _validateUser($request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:191|unique:users,email',
            'phone' => 'required|digits_between:10,14|numeric|unique:users',
        ]);

        // registrasi user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make('password'),
        ]);
        $user->save();            
        // Login user yang telah dibuat
        auth()->login($user);
    }
}
