@extends('layouts.app')
@section('title', 'Daftar')
@section('content')
@include('components.navbar')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-bg-brighter-color">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <div class="wrap">
                            <i class="bi bi-link me-1"></i>
                            @yield('title')
                        </div>
                        <span class="badge text-bg-color">
                            internal
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 offset-lg-1 d-flex align-items-center">
                        <div class="card-body">
                            <form action="{{ route('register') }}" method="POST">
                            @csrf
                            @method('POST')
                            {{--
                            <div class="flex-fill form-floating">
                                <input type="text" class="disabled form-control @error('email') is-invalid @enderror" readonly="" placeholder="Alamat email" id="email" name="email" value="{{ $data->email }}">
                                <label for="email">Alamat email</label>
                            </div>
                            @error('email')
                                <span class="invalid-feedback d-block m-0" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            --}}
                            <input type="hidden" name="type" value="2">
                            <input type="hidden" name="email" value="{{ $data->email }}">
                            {{--
                            <div class="wrap mb-2">
                                <input type="text" class="disabled form-control" disabled="" placeholder="Alamat email" value="{{ $data->email }}">
                            </div>
                            --}}
                            <div class="wrap mb-2">
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" autocomplete="off" placeholder="Nama lengkap" autofocus="" value="{{ old('name') ?? '' }}">
                            @error('name')
                                <span class="invalid-feedback d-block m-0" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                            <div class="wrap mb-2">
                                <div class="flex-fill form-select-floating">
                                    <label for="region_id">Regional</label>
                                    <select name="region_id" id="region_id" class="form-select select2-single" required="">
                                        <option value="" selected="" disabled="">Pilih satu</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}" @if(old('region_id') == $region->id) selected="" @endif>{{ $region->name }} ({{ $region->code }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="wrap mb-2">
                                <input type="text" class="form-control" name="department_name" required="" id="department" autocomplete="off" placeholder="Divisi" value="{{ old('department_name') ?? '' }}">
                            </div>

                            @error('password')
                                <span class="invalid-feedback d-block m-0" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input id="password" type="password" class="password form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Kata sandi">
                            <input id="password-confirm" type="password" class="mt-2 password form-control" name="password_confirmation" autocomplete="new-password" placeholder="Kata sandi (konfirmasi)">

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
                    <div class="col-lg-5 d-none d-md-flex align-items-md-center">
                        <img src="{{ asset('img/introduce.webp') }}" alt="Register" class="img-fluid p-5">
                    </div>
                </div>
                <div class="card-footer text-bg-brighter-color">
                    <i class="bi bi-info-circle me-1"></i>
                    Mohon isikan seluruh informasi dengan benar.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
