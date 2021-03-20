@extends('layouts.transaction')

@section('content')
<!-- select payment -->
<div class="container max-w-md mx-auto px-4 pt-20 pb-4 min-h-screen bg-white">
    @if ($transaction->payment_status == 0)
        <h4 class="font-semibold">Menunggu Pembayaran</h4>
        <p class="text-gray-600 mb-5">Segera lakukan pembayaran agar transaksi dapat diproses</p>
        <hr class="mb-5">
        <h4 class="font-semibold text-center mb-4">Segera lakukan transfer dalam waktu</h4>
        <!-- count down -->
        <div class="text-center mb-5">
            <div class="flex space-x-2 font-light">
              <div class="w-1/3 bg-gray-200 rounded-md lg text-center py-4">
                <h4 id="hourText" class="text-lg leading-none font-bold text-gray-700">1</h4>
                <p class="text-sm leading-none">Jam</p>
              </div>
              <div class="w-1/3 bg-gray-200 rounded-md lg text-center py-4">
                <h4 id="minuteText" class="text-lg leading-none font-bold text-gray-700">31</h4>
                <p class="text-sm leading-none">Menit</p>
              </div>
              <div class="w-1/3 bg-gray-200 rounded-md lg text-center py-4">
                <h4 id="secondText" class="text-lg leading-none font-bold text-gray-700">10</h4>
                <p class="text-sm leading-none">Detik</p>
              </div>
            </div>
        </div>
        <!-- count down end -->
    @elseif($transaction->payment_status == 2)
        <h4 class="font-semibold">Menunggu Verifikasi</h4>
        <p class="text-gray-600 mb-5">Pembayaran anda sedang diverifikasi mohon tunggu sejenak</p>
        <hr class="mb-5">
        <h4 class="font-semibold text-center mb-4">Segera lakukan transfer dalam waktu</h4>
        <!-- count down -->
        <div class="text-center mb-5">
            <div class="flex space-x-2 font-light">
              <div class="w-1/3 bg-gray-200 rounded-md lg text-center py-4">
                <h4 id="hourText" class="text-lg leading-none font-bold text-gray-700">1</h4>
                <p class="text-sm leading-none">Jam</p>
              </div>
              <div class="w-1/3 bg-gray-200 rounded-md lg text-center py-4">
                <h4 id="minuteText" class="text-lg leading-none font-bold text-gray-700">31</h4>
                <p class="text-sm leading-none">Menit</p>
              </div>
              <div class="w-1/3 bg-gray-200 rounded-md lg text-center py-4">
                <h4 id="secondText" class="text-lg leading-none font-bold text-gray-700">10</h4>
                <p class="text-sm leading-none">Detik</p>
              </div>
            </div>
        </div>
    @elseif($transaction->payment_status == 1)
        <h4 class="font-semibold">Pembayaran Success</h4>
        <p class="text-gray-600 mb-5">Pembayaran telah berhasil diverifikasi, semoga anda mendapatkan pahala yang berlimpah</p>
    @endif
    <hr class="mb-5">
    <p class="">{{ $transaction->created_at_formatted }}</p>
    <p class="mb-5">Nomor Invoice <b>{{ $transaction->invoice }}</b></p>
    <div class="mb-5">
        <label class="form-label">NOMINAL</label>
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <p class="text-2xl font-semibold">Rp{{ $transaction->amount_formatted }}</p>
            </div>
            <a href="#" class="btn-sm" onclick="copyText(event, amount)">Salin</a>
            <input id="amount" value="{{ $transaction->amount }}" style="position: absolute; z-index:-1">
        </div>
    </div>
    <div class="mb-5">
        <label class="form-label">PENERIMA</label>
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="rounded overflow-hidden w-20 shadow">
                    <img src="{{ $transaction->payment_method->image_url }}" alt="{{ $transaction->payment_method->short_name }}">
                </div>
                <div class="ml-3">
                    <p class="text-sm uppercase font-semibold">A/N {{ $transaction->payment_method->detail_3 }}</p>
                    <p class="text-sm text-gray-600">{{ $transaction->payment_method->short_name }} <b>{{ $transaction->payment_method->detail_2 }}</b></p>
                </div>
            </div>
            <a href="#" class="btn-sm" onclick="copyText(event, bankNumber)">Salin</a>
            <input id="bankNumber" value="{{ $transaction->payment_method->detail_2 }}" style="position: absolute; z-index:-1">
        </div>
    </div>
    <hr class="mb-5">
    @if ($transaction->payment_status == 0)
        <form action="{{ route('transaction.confirm', $transaction->invoice) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="payment_date" class="form-label uppercase">Tanggal Pembayaran</label>
                <input id="payment_date" name="payment_date" type="datetime-local" class="form-control @error('payment_date') invalid @enderror" value="{{ old('payment_date') }}">
                @error('payment_date')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror 
            </div>
            <div class="mb-4">
                <label for="payment_detail_1" class="form-label uppercase">Atas Nama Rekening</label>
                <input id="payment_detail_1" name="payment_detail_1" type="text" class="form-control @error('payment_detail_1') invalid @enderror" value="{{ old('payment_detail_1') }}">
                @error('payment_detail_1')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror 
            </div>
            <div class="mb-4">
                <label for="payment_detail_2" class="form-label uppercase">Nama Bank</label>
                <input id="payment_detail_2" name="payment_detail_2" type="text" class="form-control @error('payment_detail_2') invalid @enderror" value="{{ old('payment_detail_2') }}">
                @error('payment_detail_2')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror 
            </div>
            <div class="mb-4">
                <label for="payment_detail_3" class="form-label uppercase">Catatan (opsional)</label>
                <textarea id="payment_detail_3" name="payment_detail_3" class="form-control @error('payment_detail_3') invalid @enderror">{{ old('payment_detail_3') }}</textarea>
                @error('payment_detail_3')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror 
            </div>
            <button class="btn btn-accent w-full mb-2">Konfirmasi Pembayaran</button>
        </form>
    @elseif ($transaction->payment_status == 2)
        <p class="text-center font-semibold text-green-500 mb-5">Pembayaran anda sedang diverifikasi mohon tunggu</p>
    @endif
    <a href="{{ route('home') }}" class="btn btn-light w-full">Kembali ke-Beranda</a>
</div>
<!-- select payment end -->
@endsection

@push('prepend-scripts')

<script>
    var countDownDate = new Date("{{ $transaction->expired_at }}").getTime();
</script>
<script src="{{ asset('js/countdown.js') }}"></script>

@endpush