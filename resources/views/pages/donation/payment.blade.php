@extends('layouts.donate')

@section('content')
<!-- select payment -->
<div class="container max-w-md mx-auto px-4 pt-20 pb-24 min-h-screen bg-white">
    <h4 class="font-semibold text-center pb-5">Pilih Metode Pembayaran</h4>
    <div class="payment-method">
        @forelse ($methods as $method)
        <div class="payment-option" onclick="selectMethod(event)" 
            data-id="{{ $method->id }}" 
            data-name="{{ $method->name }}" 
            data-shortname="{{ $method->short_name }}"
            data-imageurl="{{ $method->image_url }}">
            <div class="flex items-center">
                <div class="rounded overflow-hidden w-20 shadow">
                    <img src="{{ $method->image_url }}" alt="{{ $method->short_name }}">
                </div>
                <p class="ml-3">{{ $method->short_name }}</p>
            </div>
        </div>
        @empty
            
        @endforelse
    </div>
</div>
<!-- select payment end -->
@endsection

@push('prepend-scripts')

<script>
    const contributeUrl = "{{ route('donation.contribute', $campaign->slug) }}";
</script>

@endpush