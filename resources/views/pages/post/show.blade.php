@extends('layouts.main')

@section('content')
<div class="heading bg-green-300">
    <div class="container mx-auto px-4 py-10">
        <h1 class="text-4xl font-bold leading-snug mb-2">Ada Apa Hari Ini?</h1>
        <p>Cerita ummat, berita seru, dan info terbaru. Baca semua artikel soal Lazis NU di sini.</p>
    </div>
</div>
<!-- content -->
<div class="container mx-auto px-4 py-10">
    <section class="flex flex-wrap justify-center -m-4">
        <div class="w-full md:w-2/3 p-4">
            <article class="card">
                <a href="{{ route('posts.show', $post->slug) }}" class="hover:opacity-75">
                    <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full">
                </a>
                <div class="card-body">
                    <a href="{{ route('posts.show', $post->slug) }}" class="card-title font-bold">{{ $post->title }}</a>
                    <p class="text-sm flex items-center mb-6">By&nbsp;<a href="#" class="font-semibold">{{ $post->user->name }}</a>, Published on {{ $post->published_at_formatted }}</p>
                    <div class="body">{!! $post->body !!}</div>
                </div>
            </article>

            <div class="flex pt-6 -mx-3">
                <div class="w-1/2 px-3">
                    @if (!empty($prev_post))
                    <a href="{{ route('posts.show', $prev_post->slug) }}" class="block w-full h-full bg-white shadow hover:shadow-md text-left p-6 rounded overflow-hidden">
                        <p class="text-lg text-green-400 font-bold flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="fill-current inline h-4 w-4"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                            &nbsp;Previous
                        </p>
                        <h3 class="pt-2">{{ $prev_post->title }}</h3>
                    </a>
                    @endif
                </div> 
                <div class="w-1/2 px-3">
                    @if (!empty($next_post))
                    <a href="{{ route('posts.show', $next_post->slug) }}" class="block w-full h-full bg-white shadow hover:shadow-md text-right p-6 rounded overflow-hidden">
                        <p class="text-lg text-green-400 font-bold flex items-center justify-end">
                            Next&nbsp;
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="fill-current inline h-4 w-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </p>
                        <h3 class="pt-2">{{ $next_post->title }}</h3>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @include('shared.sidebar')
    </section>
</div>
<!-- content end -->
@endsection