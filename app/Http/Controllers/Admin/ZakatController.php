<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ZakatRequest;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Zakat;
use Illuminate\Http\Request;

class ZakatController extends Controller
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
        $this->title = 'Zakat';
        $this->subtitle = 'Daftar semua pembayaran zakat';

        $transactions = Transaction::latestFirst()->zakat()->get();

        return view('admin.zakat.index',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'transactions' => $transactions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'Bayar Zakat';
        $this->subtitle = 'Bayar zakat baru';

        $zakats = Zakat::nameFirst()->get();
        $users = User::get();
        $admins = User::where('is_admin', 1)->get();
        $methods = PaymentMethod::active()->get();

        return view('admin.zakat.create',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'zakats' => $zakats,
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
    public function store(ZakatRequest $request)
    {
        // generating invoice number
        $alphanum = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $invoice = substr(str_shuffle($alphanum), 0, 6);

        $data = ([
            'invoice' => $invoice,
            'user_id' => $request->user_id,
            'payment_method_id' => $request->payment_method_id,
            'amount' => $request->amount,
            'is_anonim' => 0,
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

        $campaign = Zakat::findOrFail($request->zakat_id);
        $campaign->transactions()->create($data);

        return redirect()->route('admin.zakat.index')->with('successMessage', 'Transaksi zakat berhasil dibuat');
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
        $transaction = Transaction::findOrFail($id);

        $this->title = 'Edit Zakat';
        $this->subtitle = $transaction->user->name.' - '.$transaction->transactionable->name;

        $zakats = Zakat::nameFirst()->get();
        $users = User::get();
        $admins = User::where('is_admin', 1)->get();
        $methods = PaymentMethod::active()->get();

        return view('admin.zakat.edit',[
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'transaction' =>$transaction,
            'zakats' => $zakats,
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
    public function update(ZakatRequest $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $data = ([
            'user_id' => $request->user_id,
            'payment_method_id' => $request->payment_method_id,
            'amount' => $request->amount,
            'is_anonim' => 0,
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

        $transaction->update($data);

        return redirect()->route('admin.zakat.index')->with('successMessage', 'Transaksi zakat berhasil diperbarui');
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
