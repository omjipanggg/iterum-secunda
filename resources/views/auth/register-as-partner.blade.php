@extends('layouts.app')
@section('title', 'Daftar—Pemberi Kerja')
@section('content')
@include('components.navbar')
<div class="container">
    <div class="card">
        <div class="card-header text-bg-brighter-color">
            <i class="bi bi-link me-1"></i>
            @yield('title')
        </div>
        <div class="row">
            <div class="col-lg-5 offset-lg-1 d-flex align-items-center">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        @method('POST')
                        <div class="row g-2">
                            <div class="col-md-12 col-lg-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="off" autofocus="" placeholder="Nama lengkap">
                                    @error('name')
                                        <span class="invalid-feedback d-block m-0" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Alamat email">
                                @error('email')
                                    <span class="invalid-feedback d-block m-0" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <input type="hidden" name="type" value="8">

                            <div class="col-12">
                                <input type="text" placeholder="Nama perusahaan" class="form-control" autocomplete="off" name="company_name" id="company_name" required="">
                            </div>

                            <div class="col-12">
                                <input type="tel" placeholder="Nomor telepon" class="form-control" autocomplete="off" name="phone_number" id="phone_number" required="" onkeyup="numericOnly(event);">
                            </div>

                            <div class="col-12">
                                <div class="form-select-floating">
                                    <label for="city_id">Kota</label>
                                    <select name="city_id" required="" id="city_id" class="form-select select2-single-server" data-bs-table="cities"></select>
                                </div>
                            </div>
                            <div class="col-12">
                                @error('password')
                                    <span class="invalid-feedback d-block m-0" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input id="password" type="password" class="password form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Kata sandi">
                                <input id="password-confirm" type="password" class="mt-2 password form-control" name="password_confirmation" autocomplete="new-password" placeholder="Kata sandi (konfirmasi)">
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-wrap flex-column align-items-start justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" onchange="eyeOpen(event);" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">Tampilkan kata sandi</label>
                                    </div>
                                    <div class="d-flex flex-wrap justify-content-end align-items-start flex-column">
                                        @error('g-recaptcha-response')
                                            <span class="invalid-feedback d-block m-0" role="alert">
                                                <strong>Mohon centang kolom di bawah ini.</strong>
                                            </span>
                                        @enderror

                                        {!! ReCaptcha::htmlFormSnippet() !!}

                                        <button type="submit" class="btn btn-color px-3 rounded-0 mt-1">
                                            {{ __('Register') }}
                                            <i class="bi bi-key ms-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 d-none d-md-flex align-items-md-center">
                <img src="{{ asset('img/onboarding.webp') }}" alt="Register" class="img-fluid p-5">
            </div>
        </div>
        <div class="card-footer text-bg-brighter-color">
            Sudah memiliki akun?
            <a href="{{ route('login') }}" class="underlined">{{ __('Login') }}</a>
        </div>
    </div>
</div>
@endsection
