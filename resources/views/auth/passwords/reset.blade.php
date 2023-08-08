@extends('layouts.app')
@section('title', 'Perubahan Kata Sandi')
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
                        <img src="{{ asset('img/security.webp') }}" alt="Reset" class="img-fluid p-5">
                    </div>
                    <div class="col-lg-5 d-flex align-items-center">
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-floating mb-2">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required="" autocomplete="off" placeholder="Alamat email" readonly="">
                                    <label for="email">Alamat email</label>
                                </div>

                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-floating mb-2">
                                    <input id="password" type="password" class="password form-control @error('password') is-invalid @enderror" name="password" required="" ired autocomplete="new-password" placeholder="Kata sandi" autofocus="">
                                    <label for="password">Kata sandi</label>
                                </div>

                                <div class="form-floating mb-2">
                                    <input id="password-confirm" type="password" class="password form-control" name="password_confirmation" required="" autocomplete="new-password" placeholder="Kata sandi (konfirmasi)">
                                    <label for="password-confirm">Kata sandi (konfirmasi)</label>
                                </div>

                            <div class="d-flex flex-wrap align-items-start justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" onchange="eyeOpen(event);" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">Tampilkan kata sandi</label>
                                </div>
                                <button type="submit" class="btn btn-color rounded-0 px-3">
                                    {{ __('Reset') }}
                                    <i class="bi bi-lock ms-1"></i>
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-bg-brighter-color">
                    <div class="d-flex flex-wrap justify-content-start gap-2">
                        <a href="{{ route('login') }}" class="dotted">{{ __('Login') }}</a>
                        &middot;
                        <a href="{{ route('register') }}" class="dotted">{{ __('Register') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
