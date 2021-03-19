@extends('layouts.admin')

@section('content')
<div class="mb-4 flex justify-between">
    <div class="left">
        <h2 class="text-3xl font-bold leading-tight">{{ $title }}</h2>
        <p class="mt-0 text-gray-600">{{ $subtitle }}</p>
    </div>
    <div class="mt-auto">
        <a href="{{ route('admin.donations.create') }}" class="btn btn-success">Add New</a>
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
                    <th>INVOICE</th>
                    <th>Donasi</th>
                    <th>Amount</th>
                    <th>Created at</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($donations as $donation)
                <tr>
                    <td><a href="{{ route('donation.invoice', $donation->invoice) }}" target="BLANK" class="btn-link">{{ $donation->invoice }}</a></td>
                    <td>
                        <div class="flex items-center">
                            <img class="my-auto h-10 w-10 rounded-full" src="{{ $donation->user->profile_photo }}" alt="{{ $donation->user->name }}">
                            <div class="ml-2">
                                <p class="leading-tight">{{ $donation->user->name }}</p>
                                <p class="leading-tight text-gray-500">{{ $donation->campaign->code }}</p>
                            </div>
                        </div>                        
                    </td>
                    <td>Rp{{ $donation->amount_formatted }}</td>
                    <td>{{ $donation->created_at_formatted }}</td>
                    <td>{!! $donation->status_formatted !!}</td>
                    <td>{!! $donation->payment_status_formatted !!}</td>
                    <td>
                        <a href="{{ route('admin.donations.edit', $donation->id) }}" class="btn-text-info">Edit</a>
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