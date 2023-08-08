@extends('layouts.app')
@section('title', 'Aktivasi Akun')
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
                <div class="card-body">
                    <div class="row">
                        @if (session('resent'))
                            <div class="col-12">
                                <div class="alert alert-success" role="alert">
                                    <i class="bi bi-check-circle me-2"></i>
                                    <strong>Terkirim!</strong> Mohon periksa email Anda kembali.
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-4 offset-lg-4 position-relative">
                            <img src="{{ asset('img/mail.webp') }}" alt="Reset" class="img-fluid px-5 p-lg-0">
                        </div>
                        <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1">
                            <div class="text-center px-5">
                            Silakan aktivasi akun Anda melalui tautan yang kami kirimkan melalui email, jika tidak menerimanya,
                            <form method="POST" action="{{ route('verification.resend') }}" onsubmit="resendEmailVerification(event);" id="form-resend" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link align-baseline p-0 m-0 dotted text-decoration-underline">tekan di sini</button>
                            </form>
                            untuk meminta tautan baru. Terima kasih.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
