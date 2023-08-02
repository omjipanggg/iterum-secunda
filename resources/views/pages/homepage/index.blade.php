@extends('layouts.app')
@section('title', 'Home')
@section('content')
@include('components.navbar')
<div class="container">
    <div class="row">
        <div class="col-lg-5 offset-lg-1 d-flex flex-column align-items-center justify-content-center">
            <h4 class="display-5">Wujudkan pekerjaan impianmu bersama {{ config('app.name', 'SELENA') }}™</h4>
            <form action="{{ route('home.portal.index') }}" method="GET" class="w-100">
                @csrf
                <div class="input-group">
                    <div class="form-floating">
                        <input type="text" class="form-control rounded-start" name="keyword" autocomplete="off" placeholder="Kata kunci" id="query">
                        <label for="query">Kata kunci</label>
                    </div>
                    <button type="submit" class="btn btn-color rounded-end px-4">
                        {{ __('Telusuri') }}
                        <i class="bi bi-search ms-1"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="col-lg-6 d-flex align-items-center">
            <img src="{{ asset('img/browse.webp') }}" alt="Browse" class="img-fluid">
        </div>
    </div>
</div>
@endsection
