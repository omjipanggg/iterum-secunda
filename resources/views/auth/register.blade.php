@extends('layouts.app')
@section('title', 'Daftar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="{{ route('home.index') }}"><i class="bi bi-arrow-left me-3"></i></a>{{ __('Daftar') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf


                        @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-floating mb-2">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="off" autofocus="" placeholder="Nama lengkap">
                            <label for="name" class="form-label">{{ __('Nama lengkap') }}</label>
                        </div>

                        @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-floating mb-2">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off" placeholder="Alamat email">
                            <label for="email" class="form-label">{{ __('Alamat email') }}</label>
                        </div>

                        @error('password')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-floating mb-2">
                            <input id="password" type="password" class="password form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Kata sandi">
                            <label for="password" class="form-label">{{ __('Kata sandi') }}</label>
                        </div>

                        <div class="form-floating mb-2">
                            <input id="password-confirm" type="password" class="password form-control @error('password') is-invalid @enderror" name="password_confirmation" autocomplete="new-password" placeholder="Konfirmasi kata sandi">
                            <label for="password-confirm" class="form-label">{{ __('Konfirmasi kata sandi') }}</label>
                        </div>

                        <div class="d-flex flex-wrap align-items-start justify-content-between gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Tampilkan kata sandi') }}
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary br-0">
                                {{ __('Daftar') }}
                                <i class="bi bi-key ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex align-items-baseline justify-content-between flex-wrap gap-2">
                    @if (Route::has('login'))
                        <a class="dotted" href="{{ route('login') }}">
                            {{ __('Masuk') }}
                        </a>
                    @endif
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
