@extends('layouts.admin')

@section('content')
<div class="mb-4 flex justify-between">
    <div class="left">
        <h2 class="text-3xl font-bold leading-tight">{{ $title }}</h2>
        <p class="mt-0 text-gray-600">{{ $subtitle }}</p>
    </div>
    <div class="mt-auto">
        <a href="{{ route('admin.payment_methods.create') }}" class="btn btn-primary">Add New</a>
    </div>
</div>
@if (session('successMessage'))
    <div class="alert alert-success">
        {{ session('successMessage') }}
    </div>
@endif
<div class="bg-white p-6 rounded-md shadow overflow-hidden">
    <div class="-m-6 overflow-x-auto">
        <table class="table w-full whitespace-no-wrap">
            <thead>
                <tr class="text-left">
                    <th>Image</th>
                    <th>Short Name</th>
                    <th>Account Number</th>
                    <th>Account Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payment_methods as $p_method)
                <tr>
                    <td>
                        <div class="w-20">
                            <img src="{!! $p_method->image_url !!}" alt="{{ $p_method->short_name }}" class="w-full rounded cursor-pointer hover:shadow">
                        </div>
                    </td>
                    <td>{{ $p_method->short_name }}</td>
                    <td>{{ $p_method->detail_2 }}</td>
                    <td>{{ $p_method->detail_3 }}</td>
                    <td>{!! $p_method->status_formatted !!}</td>
                    <td>
                        <a href="{{ route('admin.payment_methods.edit', $p_method->id) }}" class="btn-text-info">Edit</a>
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