@extends('layouts.main')

@section('content')
<!-- banners -->
<div class="w-full max-w-full">
    <div class="splide" style="padding: 0">
        <div class="splide__track">
            <ul class="splide__list">
                @forelse ($banners as $banner)
                <li class="splide__slide"><a href="{{ $banner->link }}" target="_BLANK"><img src="{{ $banner->thumbnail }}" alt="{{ $banner->name }}" class="w-full"></a></li>
                @empty
                <li class="splide__slide"><img src="http://placehold.it/1080X400" alt="Banner" class="w-full"></li>
                @endforelse
            </ul>
        </div>
        <div class="splide__progress">
            <div class="splide__progress__bar"></div>
        </div>        
        {{-- <div class="splide__arrows">
            <button class="splide__arrow splide__arrow--prev">
            </button>
            <button class="splide__arrow splide__arrow--next">
            </button>
        </div> --}}
    </div>
</div>
<!-- banners end -->
<!-- categories -->
<div class="bg-white">
    <div class="container max-w-screen-lg mx-auto px-4 py-20">
        <section class="flex flex-wrap justify-center -m-4">
            <div class="section-heading w-full text-center p-4">
                <h3 class="md:text-3xl font-bold leading-tight">Kategori Program</h3>
                <span class="inline-block h-1 w-10 bg-orange-400 mx-auto"></span>
            </div>
            <div class="flex flex-wrap w-full">
                <div class="w-full lg:w-1/2">
                    <div class="h-full w-full p-4">
                        <img src="{{ url('images/donasi.svg') }}" alt="donasi" class="w-full">
                    </div>
                </div>
                <div class="w-full lg:w-1/2 flex p-4">
                    <ul class="-m-2 flex flex-wrap justify-center items-center my-auto mx-auto">
                        @forelse ($categories as $category)
                            <li class="p-2 text-center">
                                <a href="{{ route('categories.campaign', $category->slug) }}" class="inline-block bg-white shadow-md hover:shadow-lg border border-gray-300 py-3 px-4 rounded">{{ $category->name }}</a>
                            </li>
                        @empty
                            <li class="p-2 text-center">
                                <a href="#" class="inline-block bg-white shadow-md hover:shadow-lg border border-gray-300 py-3 px-4 rounded">Tidak Ada Kategori</a>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- categories end -->
<!-- campaigns -->
<div class="bg-gray-200">
<div class="container max-w-screen-lg mx-auto px-4 py-20">
    <section class="flex flex-wrap justify-center -m-4">
        <div class="section-heading w-full text-center p-4">
            <h3 class="md:text-3xl font-bold leading-tight">Ayo Mulai Berdonasi</h3>
            <span class="inline-block h-1 w-10 bg-orange-400 mx-auto"></span>
        </div>
        @forelse ($campaigns as $campaign)
        <div class="w-full md:w-1/3 p-4">
            <article class="card campaign h-full">
                <a href="{{ route('campaigns.show', $campaign->slug) }}" class="hover:opacity-75">
                    <img src="{{ $campaign->thumbnail }}" alt="{{ $campaign->title }}" class="w-full">
                </a>
                <div class="card-body h-full">
                    <a href="{{ route('campaigns.show', $campaign->slug) }}" class="card-title">{{ Helper::truncate($campaign->title,40,'...') }}</a>
                    <p class="text-sm flex items-center pb-3 mt-auto">
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
</div>
<!-- campaigns end -->
<!-- wishes -->
<div class="container max-w-screen-lg mx-auto px-4 py-20">
    <section class="flex flex-wrap justify-center -m-4">
        <div class="section-heading w-full text-center p-4">
            <h3 class="md:text-3xl font-bold leading-tight">Do'a Para Dermawan</h3>
            <span class="inline-block h-1 w-10 bg-orange-400 mx-auto"></span>
        </div>
        <div id="wishes" class="splide">
            <div class="splide__track">
                <ul class="splide__list">                    
                    @forelse ($wishes as $wish)
                    <li class="splide__slide py-2">
                        <div class="card card-body h-full">
                            <figure class="flex">
                                <div class="flex justify-center md:justify-start w-12 h-12 rounded-full overflow-hidden mb-auto">
                                    <img src="{{ $wish->display_profile }}" alt="{{ $wish->display_name }}" class="h-full w-full object-center object-cover">
                                </div>
                                <figcaption class="ml-4 my-auto">
                                    <div class="flex items-center">
                                        <p id="author" class="font-semibold text-gray-900">{{ $wish->display_name }}</p>
                                    </div>
                                    <small class="text-gray-600 text-xs">{{ $wish->created_at->diffForHumans() }}</small>
                                </figcaption>
                            </figure>
                            <p class="italic mt-4 text-sm">{{ $wish->comment ? '"'.$wish->comment.'"' : '' }}</p>
                        </div>
                    </li>
                    @empty
                    <li class="splide__slide">
                        <div class="flex flex-col items-center p-4">
                            <img src="{{ url('images/ic_empty_donation.svg') }}" alt="empty_donation" class="w-20">
                            <p class="text-center text-gray-800">Panjatkan do'a anda</p>
                        </div>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </section>
</div>
    <!-- wishes end -->
@endsection

@push('styles')
<link href="{{ asset('vendor/splide/css/splide.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/splide/css/themes/splide-sea-green.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('vendor/splide/js/splide.min.js') }}"></script>
<script>
	document.addEventListener( 'DOMContentLoaded', function () {
        new Splide( '.splide', {
                type    : 'loop',
                perPage : 1,
                autoplay: true,
                lazyLoad: 'nearby',
                width  : '100%',
                focus  : 'center',
            } ).mount();
	} );

    document.addEventListener( 'DOMContentLoaded', function () {
        new Splide( '#wishes', {
                type    : 'loop',
                autoplay: true,
                lazyLoad: 'nearby',
                width  : '100%',
                focus  : 'center',
                perPage: 3,
                gap    : '2rem',
                padding: {
                    right: '1rem',
                    left : '1rem',
                },
                breakpoints: {
                    '640': {
                        perPage: 2,
                        gap    : '2rem',
                    },
                    '480': {
                        perPage: 1,
                        gap    : '2rem',
                    },
                }
            } ).mount();
	} );
</script>
@endpush
