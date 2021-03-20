@extends('layouts.admin')

@section('content')
<div class="mb-4 flex justify-between">
    <div class="left">
        <h2 class="text-3xl font-bold leading-tight">{{ $title }}</h2>
        <p class="mt-0 text-gray-600">{{ $subtitle }}</p>
    </div>
    <div class="mt-auto">
        <a href="{{ route('admin.campaigns.create') }}" class="btn btn-primary">Add New</a>
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
                    <th>Target</th>
                    <th>Finished at</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($campaigns as $campaign)
                <tr>
                    <td>
                        <div class="w-20">
                            <img src="{{ $campaign->thumbnail }}" alt="fatured_image" class="w-full rounded cursor-pointer hover:shadow">
                        </div>
                    </td>
                    <td><a class="hover:text-orange-500" href="{{ route('campaigns.show', $campaign->slug) }}" target="_BLANK">{{ Helper::truncate($campaign->title,30,'...') }}</a><br>
                        <span class="text-gray-500">{{ $campaign->category->name }}</span>
                    </td>
                    <td>Rp{{ $campaign->donation_target_formatted }}</td>
                    <td>{{ $campaign->finished_at_formatted }}</td>
                    <td>{!! $campaign->status_formatted !!}</td>
                    <td>
                        <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="btn-text-info">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">No Data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection