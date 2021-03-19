@extends('layouts.donate')

@section('content')
<!-- select amount -->
<form action="{{ route('donation.store', $campaign->slug) }}" method="post">
    @csrf
    <input id="paymentMethodId" type="hidden" name="payment_method_id">
    <div class="container max-w-md mx-auto px-4 pt-20 pb-24 min-h-screen bg-white">
        <div class="mb-4">
            <label for="inputAmount" class="form-label">ISI NOMINAL DONASI</label>
            <div class="relative">
                <span class="text-xl font-bold text-gray-700 absolute top-0 py-2 px-3">Rp</span>
                <input id="inputAmount" type="number" placeholder="0" name="amount" class="block form-control mt-3 text-right text-xl font-bold @error('amount') invalid @enderror" value="{{ old('amount') }}">
            </div>
            @error('amount')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror 
        </div>
        <div class="mb-4">
            <div id="methodSelected" class="payment-method">
                <div class="payment-option">
                    <div class="flex items-center">
                        <p>Metode Pembayaran</p>
                    </div>
                    <a href="#" class="btn-sm btn-success" onclick="gotoPayment(event)">Ganti</a>
                </div>
            </div>
            @error('payment_method_id')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        @guest
        <p class="text-center text-sm mb-4"><a class="btn-link" href="{{ route('login') }}">Masuk</a> atau isi data dibawah ini</p>
        <div class="mb-4">
            <label for="name" class="form-label">NAMA LENGKAP</label>
            <input id="name" name="name" type="text" placeholder="Fulan bin Fulan" class="form-control @error('name') invalid @enderror" value="{{ old('name') }}">
            @error('name')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror 
        </div>
        <div class="mb-5">
            <label for="email" class="form-label">E-MAIL (Opsional)</label>
            <input id="email" name="email" type="email" placeholder="email@example.com" class="form-control @error('email') invalid @enderror" value="{{ old('email') }}">
            @error('email')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror 
        </div>
        <div class="mb-5">
            <label for="phone" class="form-label">NOMOR HP</label>
            <input id="phone" name="phone" type="number" placeholder="0812xxx" class="form-control @error('phone') invalid @enderror" value="{{ old('phone') }}">
            @error('phone')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror 
        </div>
        @endguest
        <div class="mb-5 flex items-center justify-between">
            <p class="text-sm font-semibold tracking-wide text-gray-700 pr-2">Sembunyikan nama saya (Hamba Allah)</p>
            <div class="toggle">
                <input type="checkbox" name="is_anonim" id="toggle" value="1" class="toggle-checkbox"/>
                <label for="toggle" class="toggle-label"></label>
            </div>
        </div>    
        <div class="mb-4">
            <label for="comment" class="form-label">TULIS DO'A DAN DUKUNGAN (opsional)</label>
            <textarea id="comment" name="comment" placeholder="Beri do'a dan dukunganmu disini" rows="4" class="form-control @error('comment') invalid @enderror">{{ old('comment') }}</textarea>
            @error('comment')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror 
        </div>
    </div>
    <div class="fixed bottom-0 left-0 right-0 w-full bg-gray-100">
        <div class="container max-w-md mx-auto p-4">
            <button class="btn btn-accent block w-full">Lanjutkan Pembayaran</button>
        </div>
    </div>
</form>
<!-- select amount end -->
@endsection

@push('prepend-scripts')

<script>
    const paymentUrl = "{{ route('donation.payment', $campaign->slug) }}";
    const contributeUrl = "{{ route('donation.contribute', $campaign->slug) }}";
</script>

@endpush