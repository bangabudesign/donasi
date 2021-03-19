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
            @forelse ($posts as $post)
            <article class="card mb-6">
                <a href="{{ route('posts.show', $post->slug) }}" class="hover:opacity-75">
                    <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full">
                </a>
                <div class="card-body">
                    <a href="{{ route('posts.show', $post->slug) }}" class="card-title font-bold">{{ $post->title }}</a>
                    <p class="text-sm flex items-center mb-4">By&nbsp;<a href="#" class="font-semibold">{{ $post->user->name }}</a>, Published on {{ $post->published_at_formatted }}</p>
                    <p class="mb-6">{{ Helper::truncate($post->body,140,'...') }}</p>
                    <a href="{{ route('posts.show', $post->slug) }}" class="uppercase font-semibold text-green-500 hover:text-green-400">Continue Reading <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="fill-current inline h-4 w-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></a>
                </div>
            </article>
            @empty
                
            @endforelse
        </div>
        @include('shared.sidebar')
    </section>
</div>
<!-- content end -->
@endsection
