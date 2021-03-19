@extends('layouts.main')

@section('content')
<!-- campaigns -->
<div class="container max-w-screen-lg mx-auto px-4 py-20">
    <section class="flex flex-wrap justify-center -m-4">
        <div class="section-heading w-full text-center p-4">
            <h3 class="md:text-3xl font-bold leading-tight">Ayo Mulai Berdonasi</h3>
            <span class="inline-block h-1 w-10 bg-green-400 mx-auto"></span>
        </div>
        @forelse ($campaigns as $campaign)
        <div class="w-full md:w-1/3 p-4">
            <article class="card campaign">
                <a href="{{ route('campaigns.show', $campaign->slug) }}" class="hover:opacity-75">
                    <img src="{{ $campaign->thumbnail }}" alt="{{ $campaign->title }}" class="w-full">
                </a>
                <div class="card-body">
                    <a href="{{ route('campaigns.show', $campaign->slug) }}" class="card-title">{{ Helper::truncate($campaign->title,40,'...') }}</a>
                    <p class="text-sm flex items-center pb-3">
                        <a href="#" class="author-title">{{ $campaign->user->name }}</a>
                        <svg class="ml-1 fill-current text-blue-500 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </p>
                    <div class="funding-progress">
                        <div class="flex justify-between mb-1">
                            <h4 class="font-semibold text-sm">{{ $campaign->donation_percentage }}</h4>
                            <h4 class="font-semibold text-sm">Rp{{ $campaign->donation_target_formatted }}</h4>
                        </div>
                        <div class="progress">
                            <div class="progress-bar animate-pulse" style="width: {{ $campaign->donation_percentage }};"></div>
                        </div>
                        <div class="flex justify-between mt-2">
                            <div class="text-left">
                                <p class="text-gray-600 text-xs">Terkumpul</p>
                                <h4 class="mb-0 font-semibold text-sm">Rp{{ $campaign->donation_received }}</h4>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-600 text-xs">Sisa Hari</p>
                                <h4 class="mb-0 font-semibold days-left text-sm">{{ Helper::daysLeft($campaign->finished_at) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        @empty
            
        @endforelse
    </section>
</div>
<!-- campaigns end -->
<!-- sponsor -->
<div class="container max-w-screen-lg mx-auto px-4 py-20">
    <section class="flex flex-wrap flex-col justify-center">
        <div class="section-heading w-full text-center p-4">
            <h3 class="md:text-3xl font-bold leading-tight">Sponsored By</h3>
            <span class="inline-block h-1 w-10 bg-green-400 mx-auto"></span>
        </div>
        <div class="w-1/2 md:w-1/4 mx-auto mb-6">
            <img src="{{ url('images/logo-bank-kalsel.png') }}" alt="Bank Kalsel">
        </div>
        <div class="w-full md:w-2/3 mx-auto">
            <video width="100%" controls>
                <source src="{{ url('video/bank-kalsel.mp4') }}" type="video/mp4">
            </video>
        </div>  
    </section>
</div>
<!-- sponsor end -->
@endsection
