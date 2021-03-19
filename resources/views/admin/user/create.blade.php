@extends('layouts.admin')

@section('content')
<div class="mb-4 flex justify-between">
    <div class="left">
        <h2 class="text-3xl font-bold leading-tight">{{ $title }}</h2>
        <p class="mt-0 text-gray-600">{{ $subtitle }}</p>
    </div>
</div>
<form action="{{ route('admin.users.store') }}" method="post">
    @csrf
    <div class="card card-body">        
        <div class="mb-4">
            <label for="name" class="form-label uppercase">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-control @error('name') invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
            <p class="invalid-feedback" role="alert">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="email" class="form-label uppercase">{{ __('E-Mail Address (Opsional)') }}</label>
            <input id="email" type="email" class="form-control @error('email') invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
            @error('email')
            <p class="invalid-feedback" role="alert">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="phone" class="form-label uppercase">{{ __('Phone') }}</label>
            <input id="phone" type="number" class="form-control @error('phone') invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
            @error('phone')
            <p class="invalid-feedback" role="alert">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="form-label uppercase">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') invalid @enderror" name="password" required autocomplete="new-password">
            <p class="form-help">Kosongkan jika tidak ingin merubah password</p>
            @error('password')
            <p class="invalid-feedback" role="alert">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password-confirm" class="form-label uppercase">{{ __('Password Confirmation') }}</label>
            <input id="password-confirm" type="password" class="form-control @error('password_confirmation') invalid @enderror" name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')
            <p class="invalid-feedback" role="alert">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="form-label">
                Is Admin
            </label>
            <div class="relative">
                <select class="form-control @error('is_admin') invalid @enderror" name="is_admin">
                    <option value="0" {{ old('is_admin') == '0' ? 'selected' : '' }}>False</option>
                    <option value="1" {{ old('is_admin') == '1' ? 'selected' : '' }}>True</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
            @error('is_admin')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror                    
        </div>
        <div class="flex justify-end">
            <a href="{{ route('admin.users.index') }}" class="btn btn-light mr-2">Close</a>
            <button class="btn btn-success" type="submit">Save</button>
        </div>
    </div>
</form>
@endsection