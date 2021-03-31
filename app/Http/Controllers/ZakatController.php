<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\Zakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\ZakatCreated;
use App\Notifications\WelcomeMessage;

class ZakatController extends Controller
{
    public function category()
    {
        $zakats = Zakat::nameFirst()->get();

        return view('pages.zakat.category', ['zakats' => $zakats]);
    }

    public function payment($id)
    {
        $zakat = Zakat::findOrFail($id);

        $methods = PaymentMethod::active()->get();

        return view('pages.zakat.payment', [
            'zakat' => $zakat,
            'methods' => $methods,
        ]);
    }

    public function contribute($id)
    {
        $zakat = Zakat::findOrFail($id);

        return view('pages.zakat.contribute', [
            'zakat' => $zakat,
        ]);
    }

    public function store(Request $request, $id)
    {
        $zakat = Zakat::findOrFail($id);

        if (auth()->guest()) {
            $this->_validateUser($request);
        }
        
        $request->validate([
            'payment_method_id' => 'required|exists:payment_methods,id',
            'amount' => 'required|integer',
            'comment' => 'nullable|max:140'
        ]);

        // generating invoice number
        $alphanum = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $invoice = substr(str_shuffle($alphanum), 0, 6);

        $data = ([
            'invoice' => $invoice,
            'amount' => $request->amount,
            'is_anonim' => 0,
            'comment' => $request->comment,
            'user_id' => auth()->user()->id,
            'payment_method_id' => $request->payment_method_id,
            'status' => 1,
        ]);

        $transaction = $zakat->transactions()->create($data);
        $transaction->save();

        // send notification to user
        $transaction->user->notify(new ZakatCreated($transaction));

        return redirect()->route('transaction.invoice', $transaction->invoice);
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

        // send notification to user
        $user->notify(new WelcomeMessage($user));
    }
}
