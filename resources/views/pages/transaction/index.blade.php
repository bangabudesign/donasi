@extends('layouts.transaction')

@section('content')
<!-- transactions -->
<div class="container max-w-md mx-auto px-4 pt-20 pb-24 min-h-screen bg-white">
    <h4 class="font-semibold text-center pb-5">Riwayat Donasi / Zakat</h4>
    <div class="payment-method">
        @forelse ($transactions as $transaction)
        <a href="{{ route('transaction.invoice', $transaction->invoice) }}">
            <div class="payment-option flex-wrap">
                <div class="text-gray-600 w-full">
                    {{ $transaction->created_at_formatted }}
                </div>
                <div class="flex items-center justify-between w-full">
                    <div>
                        <div>
                            {{ $transaction->invoice }} - 
                            {{ $transaction->transactionable_type == 'App\Models\Campaign' ? 'Donasi' : 'Zakat' }}
                        </div>
                        <div>{{ Helper::truncate($transaction->transactionable->title ?? $transaction->transactionable->name,20,'...') }}</div>
                    </div>
                    <div class="text-right">
                        <div>Rp{{ $transaction->amount_formatted }}</div>
                        <small>{!! $transaction->payment_status_formatted !!}</small>
                    </div>
                </div>
            </div>
        </a>
        @empty
        <div class="payment-option">
            Kamu belum pernah melakukan transaksi Donasi atau Zakat
        </div>
        @endforelse
    </div>
</div>
<!-- transactions end -->
@endsection