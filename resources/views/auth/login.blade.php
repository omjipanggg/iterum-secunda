@extends('layouts.app')
@section('title', 'Masuk')
@section('content')
@include('components.navbar')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-bg-brighter-color">
                    <i class="bi bi-link me-1"></i>
                    @yield('title')
                </div>
                <div class="row">
                    <div class="col-lg-5 offset-lg-1 d-none d-md-flex align-items-md-center">
                        <img src="{{ asset('img/auth.webp') }}" alt="Login" class="img-fluid p-5">
                    </div>
                    <div class="col-lg-5 d-flex align-items-center">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-floating mb-2">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off" autofocus="" placeholder="Alamat email">
                                    <label for="email" class="form-label text-md-end">{{ __('Alamat email') }}</label>
                                </div>

                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-floating">
                                    <input id="password" type="password" class="password form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Kata sandi">
                                    <label for="password" class="form-label text-md-end">Kata sandi</label>
                                </div>

                                <div class="mt-2 d-flex flex-wrap align-items-start justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" onchange="eyeOpen(event);" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Tampilkan kata sandi') }}
                                        </label>
                                    </div>

                                    <button type="submit" class="btn btn-color px-3 rounded-0">
                                        {{ __('Login') }}
                                        <i class="bi bi-key ms-1"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-bg-brighter-color">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div class="group">
                            Belum memiliki akun?
                            <a href="{{ route('register') }}" class="underlined">{{ __('Register') }}</a>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="underlined">Lupa kata sandi?</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection