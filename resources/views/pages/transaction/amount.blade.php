@extends('layouts.transaction')

@section('content')
<!-- select amount -->
<div class="container max-w-md mx-auto px-4 pt-20 pb-24 bg-white">           
    <h4 class="font-semibold text-center pb-5">Pilih Nominal Donasi</h4>
    <a onclick="selectAmount(event)" data-amount="10000" class="donate-amount">
        <div class="flex items-center justify-between">
            <span class="text-lg font-bold">Rp 10.000</span>
            <svg width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.5 14.25a.75.75 0 01-.578-1.23L10.282 9l-3.24-4.027a.75.75 0 01.113-1.058.75.75 0 011.095.113l3.623 4.5a.75.75 0 010 .952l-3.75 4.5a.75.75 0 01-.623.27z" fill="#718096"></path></svg>
        </div>
        <span class="bg-gray-100 rounded px-2 py-1 text-xs block mt-2">Nominal minimal donasi</span>
    </a>
    <a onclick="selectAmount(event)" data-amount="20000" class="donate-amount">
        <div class="flex items-center justify-between">
            <span class="text-lg font-bold">Rp 20.000</span>
            <svg width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.5 14.25a.75.75 0 01-.578-1.23L10.282 9l-3.24-4.027a.75.75 0 01.113-1.058.75.75 0 011.095.113l3.623 4.5a.75.75 0 010 .952l-3.75 4.5a.75.75 0 01-.623.27z" fill="#718096"></path></svg>
        </div>
    </a>
    <a onclick="selectAmount(event)" data-amount="50000" class="donate-amount">
        <div class="flex items-center justify-between">
            <span class="text-lg font-bold">Rp 50.000</span>
            <svg width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.5 14.25a.75.75 0 01-.578-1.23L10.282 9l-3.24-4.027a.75.75 0 01.113-1.058.75.75 0 011.095.113l3.623 4.5a.75.75 0 010 .952l-3.75 4.5a.75.75 0 01-.623.27z" fill="#718096"></path></svg>
        </div>
    </a>
    <a onclick="selectAmount(event)" data-amount="100000" class="donate-amount">
        <div class="flex items-center justify-between">
            <span class="text-lg font-bold">Rp 100.000</span>
            <svg width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.5 14.25a.75.75 0 01-.578-1.23L10.282 9l-3.24-4.027a.75.75 0 01.113-1.058.75.75 0 011.095.113l3.623 4.5a.75.75 0 010 .952l-3.75 4.5a.75.75 0 01-.623.27z" fill="#718096"></path></svg>
        </div>
        <span class="bg-gray-100 rounded px-2 py-1 text-xs block mt-2">Nominal yang sering dipilih</span>
    </a>
    <a class="donate-amount">
        <div class="flex items-center justify-between">
            <span class="text-base font-semibold">Nominal Donasi Lainnya</span>
        </div>
        <div class="relative">
            <span class="text-xl font-bold text-gray-700 absolute top-0 py-2 px-3">Rp</span>
            <input id="amount" type="number" placeholder="0" class="block form-control mt-3 text-right text-xl font-bold">
        </div>
    </a>
</div>
<div class="fixed bottom-0 left-0 right-0 w-full bg-gray-100">
    <div class="container max-w-md mx-auto p-4">
        <button id="donateBtn" disabled class="btn btn-accent block w-full">Lanjutkan Pembayaran</button>
    </div>
</div>
<!-- select amount end -->
@endsection

@push('prepend-scripts')

<script>
    const paymentUrl = "{{ route('donation.payment', $campaign->slug) }}";
    const contributeUrl = "{{ route('donation.contribute', $campaign->slug) }}";
</script>

@endpush