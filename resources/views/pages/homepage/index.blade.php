@extends('layouts.app')
@section('title', 'Home')
@section('content')
@include('components.navbar')
<section id="patria">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 offset-lg-1 d-flex flex-column align-items-center justify-content-center order-lg-1 order-2 mb-lg-31">
                <h4 class="fw-bold display-6 text-center">Wujudkan Pekerjaan Impianmu Bersama <abbr class="text-color" title="Selection &amp; Recruitment Alihdaya">{{ config('app.name', 'SELENA') }}™</abbr></h4>
                <p class="text-center">Kirimkan CV Anda, dan lamar pekerjaan di sini!</p>
                <form action="{{ route('portal.index') }}" method="POST" class="w-100 mt-12">
                    @csrf
                    <div class="input-group w-100 d-flex">
                        <div class="position-relative flex-fill">
                            <i class="bi bi-briefcase icon-floating position-absolute"></i>
                            <input type="text" class="form-control ps-8 py-3" name="keyword" autocomplete="off" placeholder="Pencarian" id="query">
                            <label for="query" class="visually-hidden">Pencarian</label>
                        </div>
                        <button type="submit" class="btn btn-color px-4">
                            {{ __('Telusuri') }}
                            <i class="bi bi-search ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 d-flex align-items-center order-lg-2 order-1">
                <img src="{{ asset('img/browse.webp') }}" alt="Browse" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<section id="list-of-vacancy">
    <div class="w-100 bg-brighter-color py-20">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="text-center">
                        <h2 class="section-title">
                            <a href="{{ route('portal.index') }}" class="dotted">Lowongan Pekerjaan</a>
                        </h2>
                        <p class="section-subtitle text-muted">Terlusuri dan lamar pekerjaan impianmu di sini</p>
                    </div>
                </div>
            </div>

            <div class="row py-6 hr-top">
                <div class="col">
                    <div class="d-flex vacancy-container flex-column flex-lg-row gap-4">
                        <div class="card vacancy-item">
                            <div class="card-body">
                                <div class="text-justify">
                                    @foreach ($users as $element)
                                        {{ $users }}
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-footer text-bg-brighter-color">
                                <i class="bi bi-clock me-2"></i>
                                @foreach ($users as $element)
                                    {{ $element->created_at->locale('id')->diffForHumans() }}                            
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
