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
                <form action="{{ route('portal.index') }}" method="POST" class="w-100 mt-lg-31">
                    @csrf
                    <div class="filter w-100 d-flex flex-column flex-sm-row">
                        <div class="position-relative flex-fill">
                            <i class="bi bi-briefcase icon-floating position-absolute"></i>
                            <input type="text" class="form-control py-3" name="keyword" autocomplete="off" placeholder="Pencarian" id="query">
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
                <img src="{{ asset('img/observe.webp') }}" alt="Browse" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<div class="mb-12">
</div>

<section id="list-of-vacancy">
    <div class="w-100 bg-brighter-color py-6">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="text-center">
                        <h2 class="section-title">
                            <a href="{{ route('portal.index') }}" class="dotted">Lowongan Pekerjaan</a>
                        </h2>
                        <p class="section-subtitle text-muted">Telusuri dan lamar pekerjaan impianmu di sini</p>
                    </div>
                </div>
            </div>

            <div class="row pt-6 hr-top position-relative">
                <div class="col-lg-8 offset-lg-2">
                    <div class="d-flex flex-column gap-4 vacancy-container">
                        @forelse ($vacancies as $vacancy)
                        <div class="card vacancy-item">
                            <div class="card-body position-relative py-4">
                                <div class="row">
                                    <div class="col d-block d-lg-none">
                                        <span class="badge text-bg-color order-2 order-lg-1">
                                            {{ $vacancy->type->name }}
                                        </span>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="wrap py-3 py-lg-0">
                                            <h4 class="fw-semibold mb-0">
                                                <a href="{{ route('portal.show', $vacancy->slug) }}" class="dotted">
                                                    {{ $vacancy->name }}
                                                </a>
                                            </h4>
                                            <p class="text-muted m-0">
                                                @if ($vacancy->hidden_partner)
                                                    Disembunyikan
                                                @else
                                                    {{ $vacancy->project->partner->name }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 align-self-center">
                                        <p class="m-0">
                                            <i class="bi bi-geo-alt me-1"></i>
                                            @if ($vacancy->hidden_placement)
                                                Disembunyikan
                                            @else
                                                {{ $vacancy->placement }}
                                            @endif
                                        </p>
                                    </div>

                                    <div class="col-lg-2 d-none d-lg-flex flex-wrap justify-content-lg-end">
                                        <div class="d-flex flex-wrap flex-column justify-content-between align-items-end">
                                            <div class="wrap"><i class="bi bi-people-fill me-1"></i>{{ $vacancy->candidates_count }}</div>
                                            <span class="badge text-bg-color">
                                                {{ $vacancy->type->name }}
                                            </span>
                                        </div>
                                    </div>
                                    {{--
                                    <div class="col-lg-2 align-self-center d-none d-lg-block">
                                    </div>
                                    <div class="col-lg-2 align-self-center d-none d-lg-flex justify-content-lg-end">
                                    </div>
                                    --}}
                                </div>
                            </div>
                            <div class="card-footer text-bg-brighter-color">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="wrap">
                                        <i class="bi bi-clock me-2"></i>
                                        {{ $vacancy->published_at->locale('id')->diffForHumans() }}
                                        {{-- {{ date_indo_format($vacancy->closing_date) }} --}}
                                    </div>
                                    <a href="{{ route('portal.show', $vacancy->slug) }}" class="btn btn-color px-3">
                                        Rincian
                                        <i class="bi bi-box-arrow-up-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="card">
                            <div class="card-body">
                                <p class="m-0 text-center">Tidak ada data tersedia.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>

                <div class="col-12 d-flex align-items-center justify-content-center py-4">
                    <a href="{{ route('portal.index') }}" class="btn btn-lg btn-color rounded-0 px-4">
                        Lowongan Lainnya
                        <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
