@extends('layouts.admin')

@section('content')
<div class="mb-4 flex justify-between">
    <div class="left">
        <h2 class="text-3xl font-bold leading-tight">{{ $title }}</h2>
        <p class="mt-0 text-gray-600">{{ $subtitle }}</p>
    </div>
    <div class="mt-auto">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Add New</a>
    </div>
</div>
@if (session('successMessage'))
    <div class="alert alert-success">
        {{ session('successMessage') }}
    </div>
@endif
<div class="card card-body">
    <div class="-m-6 overflow-x-auto">
        <table class="table w-full whitespace-no-wrap">
            <thead>
                <tr class="text-left">
                    <th>Image</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                <tr>
                    <td>
                        <div class="w-20">
                            <img src="{{ $post->featured_image ? url('/',$post->featured_image) : 'http://placehold.it/400X225' }}" alt="fatured_image" class="w-full rounded cursor-pointer hover:shadow">
                        </div>
                    </td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->status }}</td>
                    <td>
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn-text-info">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No Data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection