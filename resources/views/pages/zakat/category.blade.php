@extends('layouts.transaction')

@section('content')
<!-- select amount -->
<div class="container max-w-md mx-auto px-4 pt-20 pb-24 bg-white min-h-screen">           
    <h4 class="font-semibold text-center pb-5">Pilih Jenis Zakat</h4>
    @foreach ($zakats as $zakat)
    <a href="{{ route('zakat.payment', $zakat->id) }}" class="donate-amount">
        <div class="flex items-center justify-between">
            <span class="text-lg font-bold">{{ $zakat->name }}</span>
            <svg width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.5 14.25a.75.75 0 01-.578-1.23L10.282 9l-3.24-4.027a.75.75 0 01.113-1.058.75.75 0 011.095.113l3.623 4.5a.75.75 0 010 .952l-3.75 4.5a.75.75 0 01-.623.27z" fill="#718096"></path></svg>
        </div>
    </a>
    @endforeach
</div>
<!-- select amount end -->
@endsection

@push('prepend-scripts')



@endpush