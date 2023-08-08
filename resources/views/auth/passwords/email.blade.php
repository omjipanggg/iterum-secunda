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
                        <img src="{{ asset('img/confuse.webp') }}" alt="Reset" class="img-fluid p-5">
                    </div>
                    <div class="col-lg-5 d-flex align-items-center">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success mb-2 rounded-0" role="alert">
                                    <i class="bi bi-check-circle me-2"></i>
                                    {{-- {{ session('status') }} --}}
                                    <strong>Terkirim!</strong> Mohon periksa email Anda untuk melanjutkan.
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-floating mb-2">
                                    <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off" autofocus="" placeholder="Alamat email">
                                    <label for="email" class="form-label text-md-end">Alamat email</label>
                                </div>

                                <div class="d-flex flex-wrap gap-1 align-items-start justify-content-between">
                                    {!! ReCaptcha::htmlFormSnippet() !!}
                                    <button type="submit" class="btn btn-color px-3 rounded-0">
                                        Kirim
                                        <i class="bi bi-send ms-1"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-bg-brighter-color">
                    <div class="d-flex flex-wrap justify-content-start gap-2">
                        <a href="{{ route('register') }}" class="dotted">{{ __('Register') }}</a>
                        &middot;
                        <a href="{{ route('login') }}" class="dotted">{{ __('Login') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
