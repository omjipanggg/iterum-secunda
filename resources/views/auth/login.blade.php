@extends('layouts.app')
@section('title', 'Masuk')
@section('content')
@include('components.navbar')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="row">
                    <div class="col-lg-6 offset-lg-1 d-flex align-items-center">
                        <img src="{{ asset('img/auth.webp') }}" alt="Login" class="img-fluid p-4">
                    </div>
                    <div class="col-lg-4 d-flex align-items-center">
                        <div class="card-body pt-0 py-lg-3">
                            <h3 class="display-6 mb-4">@yield('title')</h3>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-floating mb-2">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off" autofocus="" placeholder="Email address">
                                    <label for="email" class="form-label text-md-end">{{ __('Email address') }}</label>
                                </div>

                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-floating">
                                    <input id="password" type="password" class="password form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Password">
                                    <label for="password" class="form-label text-md-end">{{ __('Password') }}</label>
                                </div>

                                <div class="mt-2 d-flex flex-wrap align-items-start justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" onchange="eyeOpen(event);" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Show password') }}
                                        </label>
                                    </div>

                                    <button type="submit" class="btn btn-color px-3 rounded-0">
                                        {{ __('Masuk') }}
                                        <i class="bi bi-key ms-1"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-bg-color">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div class="group">
                            {{ __('Belum memiliki akun?') }}
                            <a href="{{ route('register') }}" class="dotted">Registrasi di sini!</a>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="dotted" href="{{ route('password.request') }}">
                                {{ __('Lupa kata sandi?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection