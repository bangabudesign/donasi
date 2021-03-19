@extends('layouts.auth')

@section('content')
<div class="card m-auto">
    <div class="card-body" style="width: 350px; max-width:100%">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="form-label uppercase">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                <p class="invalid-feedback" role="alert">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="form-label uppercase">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
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
            <button type="submit" class="btn btn-success w-full">{{ __('Register') }}</button>
            <p class="text-center text-gray-700 my-4 text-sm">Sudah memiliki akun?</p>
            <a href="{{ route('login') }}" class="btn btn-light w-full">{{ __('Login') }}</a>
        </form>
    </div>
</div>
@endsection
