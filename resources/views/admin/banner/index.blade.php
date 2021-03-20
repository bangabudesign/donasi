@extends('layouts.admin')

@section('content')
<div class="mb-4 flex justify-between">
    <div class="left">
        <h2 class="text-3xl font-bold leading-tight">{{ $title }}</h2>
        <p class="mt-0 text-gray-600">{{ $subtitle }}</p>
    </div>
    <div class="mt-auto">
        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">Add New</a>
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
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($banners as $banner)
                <tr>
                    <td>
                        <div class="w-48">
                            <img src="{{ $banner->thumbnail }}" alt="fatured_image" class="w-full rounded cursor-pointer hover:shadow">
                        </div>
                    </td>
                    <td><a class="hover:text-orange-500" href="{{ $banner->link }}" target="_BLANK">{{ Helper::truncate($banner->name,30,'...') }}</a></td>
                    <td>
                        <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn-text-info">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">No Data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection