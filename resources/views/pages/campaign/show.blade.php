@extends('layouts.main')

@section('content')
<!-- campaigns -->
<div class="container max-w-screen-lg mx-auto px-4 py-10">
    <div class="flex flex-wrap -mx-4 -my-2">
        <section class="w-full md:w-3/5 px-4 py-2">
            <article class="flex flex-col bg-white shadow rounded-md overflow-hidden">
                <div class="hover:opacity-75">
                    <img src="{{ $campaign->thumbnail }}" class="w-full">
                </div>
            </article>
        </section>
        <aside class="w-full md:w-2/5 px-4 py-2">
            <div class="card campaign">
                <div class="card-body">
                    <h1 class="text-2xl font-bold leading-tight hover:text-gray-700 pb-5">{{ $campaign->title }}</h1>
                    <p class="text-sm pb-5"> Published on {{ $campaign->published_at_formatted }} </p>
                    <div class="funding-progress">
                        <div class="flex justify-between mb-1">
                            <h4 class="font-semibold text-sm text-green-500">Rp{{ $campaign->donation_received }}</h4>
                            <h4 class="font-semibold text-sm">Rp{{ $campaign->donation_target_formatted }}</h4>
                        </div>
                        <div class="progress">
                            <div class="progress-bar animate-pulse" style="width: {{ $campaign->donation_percentage }};"></div>
                        </div>
                        <div class="flex justify-between mt-2">
                            <div class="text-left">
                                <p class="text-gray-600 text-xs">Donasi</p>
                                <h4 class="mb-0 font-semibold text-sm">{{ $campaign->donation_count }}</h4>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-600 text-xs">Sisa Hari</p>
                                <h4 class="mb-0 font-semibold days-left text-sm">{{ Helper::daysLeft($campaign->finished_at) }}</h4>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('donation.amount', $campaign->slug) }}" class="btn btn-accent mt-4 shadow-lg uppercase font-semibold">Donasi Sekarang</a>
                </div>
            </div>
        </aside>
        <section class="w-full px-4 py-6">
            <div class="card card-body">
                <h4 class="font-semibold pb-5">Penggalang Dana</h4>
                <figure class="flex">
                    <div class="flex justify-center md:justify-start w-14 h-14 rounded-full overflow-hidden mb-2 md:mb-0">
                        <img src="https://ui-avatars.com/api/?name={{ $campaign->user->name }}&amp;color=7F9CF5&amp;background=EBF4FF" alt="{{ $campaign->user->name }}" class="h-full w-full object-center object-cover">
                    </div>
                    <figcaption class="ml-3 my-auto">
                        <div class="flex items-center">
                            <p id="author" class="font-semibold">{{ $campaign->user->name }}</p>
                            <svg class="ml-1 fill-current text-blue-500 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        </div>
                        <small class="text-gray-600 text-xs">Identitas Terverifikasi</small>
                    </figcaption>
                </figure>
            </div>
        </section>
    </div>
    <section class="py-4">
        <h4 class="text-xl font-semibold pb-3">Cerita</h4>
        <div class="body">{!! $campaign->description !!}</div>
        <div class="bg-gray-100 p-4 mt-3 rounded-md text-xs">
            <b>Disclaimer :</b> Informasi dan opini yang tertulis di halaman campaign ini adalah milik campaigner (pihak yang menggalang dana).
        </div>
    </section>
    <section class="py-6">
        <h4 class="text-xl font-semibold pb-3">Donasi ({{ $campaign->donation_count }})</h4>
        @forelse ($donations as $donation)
        <div class="card card-body mb-3">
            <figure class="flex">
                <div class="flex justify-center md:justify-start w-14 h-14 rounded-full overflow-hidden mb-auto">
                    <img src="{{ $donation->display_profile }}" alt="{{ $donation->display_name }}" class="h-full w-full object-center object-cover">
                </div>
                <figcaption class="ml-4 my-auto">
                    <div class="flex items-center">
                        <p id="author" class="font-semibold text-green-500">{{ $donation->display_name }}</p>
                    </div>
                    <p class="text-sm">Donasi <b>{{ $donation->amount_formatted }}</b></p>
                    <small class="text-gray-600 text-xs">{{ $donation->created_at->diffForHumans() }}</small>
                    <p class="italic mt-2 text-sm">{{ $donation->comment ? '"'.$donation->comment.'"' : '' }}</p>
                </figcaption>
            </figure>
        </div>
        @empty
            <div class="flex flex-col items-center p-4">
                <img src="{{ url('images/ic_empty_donation.svg') }}" alt="empty_donation" class="w-20">
                <p class="text-center text-gray-800">Jadilah donatur pertama di penggalangan ini atau bantu sebarkan</p>
            </div>
        @endforelse
    </section>
</div>
<!-- campaigns end -->
@endsection