@extends('layouts.auth')

@section('content')
<div class="card m-auto">
    <div class="card-body" style="width: 350px; max-width:100%">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="form-label uppercase">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <p class="invalid-feedback" role="alert">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="form-label uppercase">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <p class="invalid-feedback" role="alert">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-full">{{ __('Login') }}</button>
            <p class="text-center text-gray-700 my-4 text-sm">Belum memiliki akun?</p>
            <a href="{{ route('register') }}" class="btn btn-light w-full">{{ __('Register') }}</a>
        </form>
    </div>
</div>
@endsection
