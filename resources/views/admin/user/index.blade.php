@extends('layouts.admin')

@section('content')
<div class="mb-4 flex justify-between">
    <div class="left">
        <h2 class="text-3xl font-bold leading-tight">{{ $title }}</h2>
        <p class="mt-0 text-gray-600">{{ $subtitle }}</p>
    </div>
    <div class="mt-auto">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add New</a>
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
                    <th>Profile</th>
                    <th>E-Mail</th>
                    <th>Phone</th>
                    <th>Registered At</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <td>
                        <div class="flex items-center">
                            <img class="my-auto h-10 w-10 rounded-full" src="{{ $user->profile_photo }}" alt="{{ $user->name }}">
                            <div class="ml-2">
                                <p class="leading-tight">{{ $user->name }}</p>
                            </div>
                        </div>                        
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->created_at != null ? $user->created_at->diffForHumans() : '' }}</td>
                    <td>
                        @if ($user->is_admin)
                        <span class="badge badge-info">Admin</span>
                        @else
                            <span class="badge badge-success">Donatur</span>                            
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-text-info">Edit</a>
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