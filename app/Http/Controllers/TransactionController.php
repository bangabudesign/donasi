<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TransactionController extends Controller
{
    public function payment($slug)
    {
        $campaign = Campaign::activeCampaign()
            ->where('slug', $slug)
            ->firstOrFail();

        $methods = PaymentMethod::active()->get();

        return view('pages.transaction.payment', [
            'campaign' => $campaign,
            'methods' => $methods,
        ]);
    }

    public function contribute($slug)
    {
        $campaign = Campaign::activeCampaign()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.transaction.contribute', [
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

    return redirect()->route('donation.invoice', $donation->invoice);
    }

    public function invoice($invoice)
    {
        $transaction = Transaction::where('invoice', $invoice)
            ->with('payment_method')
            ->firstOrFail();

        return view('pages.transaction.invoice', [
            'transaction' => $transaction,
        ]);
    }

    public function confirm(Request $request, $invoice)
    {
        $transaction = Transaction::where('invoice', $invoice)
            ->with('payment_method')
            ->firstOrFail();
        
        $request->validate([
            'payment_date' => 'required',
            'payment_detail_1' => 'required',
            'payment_detail_2' => 'required',
            'payment_detatail_3' => 'nullable|max:140'
        ]);

        $data = ([
            'payment_date' => $request->payment_date,
            'payment_detail_1' => $request->payment_detail_1,
            'payment_detail_2' => $request->payment_detail_2,
            'payment_detail_3' => $request->payment_detail_3,
            'payment_status' => 2, // PENDING
        ]);

        $transaction->update($data);
        
        return redirect()->back();
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
