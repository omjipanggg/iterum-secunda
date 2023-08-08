@extends('layouts.app')
@section('title', 'Konfirmasi Kata Sandi')
@section('content')
@include('components.navbar')
<div class="container">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header text-bg-brighter-color">
                    <i class="bi bi-link me-1"></i>
                    @yield('title')
                </div>
                <div class="card-body">
                    <div class="alert alert-warning" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        <strong>Perhatian!</strong> Mohon lakukan konfirmasi kata sandi Anda.
                    </div>
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-floating mb-2">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required="" autocomplete="current-password" placeholder="Kata sandi">
                            <label for="password" class="form-label">Kata sandi</label>
                        </div>
                        <button type="submit" class="btn btn-color px-3 rounded-0">
                            Kirim
                            <i class="bi bi-send ms-1"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
