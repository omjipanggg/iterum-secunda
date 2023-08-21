@extends('layouts.app')
@section('title', 'Daftar')
@section('content')
@include('components.navbar')
<div class="container">
    <div class="card">
        <div class="card-header text-bg-brighter-color">
            <i class="bi bi-link me-1"></i>
            @yield('title')
        </div>
        <div class="row">
            <div class="col-lg-5 offset-lg-1 d-none d-md-flex align-items-md-center">
                <img src="{{ asset('img/new.webp') }}" alt="Register" class="img-fluid p-5">
            </div>
            <div class="col-lg-5 d-flex align-items-center">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="d-flex gap-2 flex-wrap">
                            <div class="group flex-fill">
                                {{--
                                <div class="form-floating">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="off" autofocus="" placeholder="Nama lengkap">
                                    <label for="name">Nama lengkap</label>
                                </div>
                                --}}
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="off" autofocus="" placeholder="Nama lengkap">
                                @error('name')
                                    <span class="invalid-feedback d-block m-0" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="group flex-fill">
                                {{--
                                <div class="form-floating">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Alamat email">
                                    <label for="email">Alamat email</label>
                                </div>
                                --}}
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Alamat email">
                                @error('email')
                                    <span class="invalid-feedback d-block m-0" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{--
                        <div class="form-floating form-select-floating my-2">
                            <select class="form-select select2-multiple" id="type-floating" name="type">
                                <option value="8">Pemberi kerja</option>
                                <option value="7" selected="">Pencari kerja</option>
                                <option value="2">Lainnya</option>
                            </select>
                            <label for="type-floating">Tipe</label>
                        </div>
                        --}}
                        <div class="my-2">
                            <label for="type-floating" class="visually-hidden">Tipe</label>
                            <select class="form-select select2-single" id="type-floating" name="type">
                                <option value="7" @if(old('type') == 7) selected="" @endif>Pencari kerja</option>
                                <option value="8" @if(old('type') == 8) selected="" @endif>Pemberi kerja</option>
                                <option value="2" @if(old('type') == 2) selected="" @endif>Lainnya</option>
                            </select>
                        </div>
                        {{--
                        <div class="form-floating">
                            <input id="password" type="password" class="password form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Kata sandi">
                            <label for="password">Kata sandi</label>
                        </div>
                        --}}
                        @error('password')
                            <span class="invalid-feedback d-block m-0" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="password" type="password" class="password form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Kata sandi">
                        <input id="password-confirm" type="password" class="mt-2 password form-control" name="password_confirmation" autocomplete="new-password" placeholder="Kata sandi (konfirmasi)">

                        {{--
                        <div class="form-floating mt-2">
                            <input id="password-confirm" type="password" class="password form-control" name="password_confirmation" autocomplete="new-password" placeholder="Kata sandi (konfirmasi)">
                            <label for="password-confirm">Kata sandi (konfirmasi)</label>
                        </div>
                        --}}

                        <div class="mt-2 d-flex flex-wrap flex-column align-items-start justify-content-between">
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
                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer text-bg-brighter-color">
            Sudah memiliki akun?
            <a href="{{ route('login') }}" class="underlined">{{ __('Login') }}</a>
        </div>
    </div>
</div>
@endsection
