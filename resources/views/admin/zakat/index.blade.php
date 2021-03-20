@extends('layouts.admin')

@section('content')
<div class="mb-4 flex justify-between">
    <div class="left">
        <h2 class="text-3xl font-bold leading-tight">{{ $title }}</h2>
        <p class="mt-0 text-gray-600">{{ $subtitle }}</p>
    </div>
    <div class="mt-auto">
        <a href="{{ route('admin.zakat.create') }}" class="btn btn-primary">Add New</a>
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
                @forelse ($transactions as $transaction)
                <tr>
                    <td><a href="{{ route('transaction.invoice', $transaction->invoice) }}" target="BLANK" class="btn-link">{{ $transaction->invoice }}</a></td>
                    <td>
                        <div class="flex items-center">
                            <img class="my-auto h-10 w-10 rounded-full" src="{{ $transaction->user->profile_photo }}" alt="{{ $transaction->user->name }}">
                            <div class="ml-2">
                                <p class="leading-tight">{{ $transaction->user->name }}</p>
                                <p class="leading-tight text-gray-500">{{ $transaction->transactionable->name }}</p>
                            </div>
                        </div>                        
                    </td>
                    <td>Rp{{ $transaction->amount_formatted }}</td>
                    <td>{{ $transaction->created_at_formatted }}</td>
                    <td>{!! $transaction->status_formatted !!}</td>
                    <td>{!! $transaction->payment_status_formatted !!}</td>
                    <td>
                        <a href="{{ route('admin.zakat.edit', $transaction->id) }}" class="btn-text-info">Edit</a>
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