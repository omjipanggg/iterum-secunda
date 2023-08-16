@extends('layouts.app')
@section('title', Str::headline($vacancy->name))
@section('content')
@include('components.modal-apply')
@include('components.navbar')
<section id="portal">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-body">
                        {{ Breadcrumbs::render('portal.show', $vacancy) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="wrap py-4">
                            <h3 class="mb-0">{{ Str::headline($vacancy->name) }}</h3>
                            @if ($vacancy->hidden_partner)
                            <p class="text-muted">Disembunyikan</p>
                            @else
                            <p class="text-muted">{{ Str::headline($vacancy->project->partner->name) }}</p>
                            @endif
                        </div>
                        <div class="d-flex flex-wrap gap-2 mb-2 box-info">
                            <div class="border position-relative">
                                <span class="icon-box-floating position-absolute d-none d-sm-block"><i class="bi bi-geo-alt-fill"></i></span>
                                <small class="text-muted small">Kota Penempatan</small>
                                @if ($vacancy->hidden_placement)
                                <p class="m-0 fw-semibold">Disembunyikan</p>
                                @else
                                <p class="m-0 fw-semibold">{{ Str::headline($vacancy->placement) }}</p>
                                @endif
                            </div>
                            <div class="border position-relative">
                                <span class="icon-box-floating position-absolute d-none d-sm-block"><i class="bi bi-briefcase-fill"></i></span>
                                <small class="text-muted small">Tipe Pekerjaan</small>
                                <p class="m-0 fw-semibold">{{ $vacancy->type->name }}</p>
                            </div>
                            <div class="border position-relative">
                                <span class="icon-box-floating position-absolute d-none d-sm-block"><i class="bi bi-people-fill"></i></span>
                                <small class="text-muted small">Total Pelamar</small>
                                <p class="m-0 fw-semibold">{{ $vacancy->candidates_count }}</p>
                            </div>
                            <div class="border position-relative">
                                <span class="icon-box-floating position-absolute d-none d-sm-block"><i class="bi bi-clock-fill"></i></span>
                                <small class="text-muted small">Batas Akhir Pelamaran</small>
                                <p class="m-0 fw-semibold">{{ date_indo_format($vacancy->closing_date) }}</p>
                            </div>
                        </div>
                        {{--
                        <div class="qualification">
                            <h5>Kualifikasi</h5>
                            <p>{!! Str::headline(htmlspecialchars_decode(stripslashes($vacancy->qualification))) !!}</p>
                        </div>
                        <div class="description">
                            <h5>Deskripsi</h5>
                            <p>{!! Str::headline(htmlspecialchars_decode(stripslashes($vacancy->description))) !!}</p>
                        </div>
                        --}}
                        @include('pages.portal.accordion-detail')
                        {{--
                        <div class="skills pb-4 pt-3">
                            <h5>Keahlian</h5>
                            @foreach ($vacancy->skills as $skill)
                            <span class="badge text-bg-color">
                                {{ Str::slug($skill->name) }}
                            </span>
                            @endforeach
                        </div>
                        --}}
                    </div>
                    {{--
                    <div class="card-footer text-bg-brighter-color">
                        <i class="bi bi-info-circle me-2"></i>
                        Mohon pastikan data diri Anda sudah lengkap sebelum melanjutkan.
                    </div>
                    --}}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex flex-column gap-3">
                <div class="card order-2 order-md-1">
                    <div class="card-header text-bg-color">
                        <i class="bi bi-info-circle me-2"></i>
                        Ringkasan
                    </div>
                    <div class="card-body px-0">
                        <div class="d-flex flex-column box-info">
                            <div class="border-bottom position-relative">
                                <p class="summary-content text-muted">Posisi</p>
                                <p class="summary-header">{{ Str::headline($vacancy->name) }}</p>
                            </div>
                            <div class="border-bottom position-relative">
                                <p class="summary-content text-muted">Kota Penempatan</p>
                                <p class="summary-header">
                                @if ($vacancy->hidden_placement)
                                    Disembunyikan
                                @else
                                    {{ Str::headline($vacancy->placement) }}
                                @endif
                                </p>
                            </div>
                            <div class="position-relative">
                                <p class="summary-content text-muted">Kategori</p>
                                <div class="summary-header">
                                    @foreach ($vacancy->categories as $category)
                                        <a href="{{ route('category.show', $category->slug) }}" class="dotted">{{ Str::headline($category->name) }}</a>@if (!$loop->last),@endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="border-top position-relative">
                                <p class="summary-content text-muted">Dipublikasikan</p>
                                <p class="summary-header">{{ $vacancy->published_at->locale('id')->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-bg-brighter-color py-3">
                        <button type="button" class="btn btn-lg btn-color w-100" data-bs-toggle="modal" data-bs-target="#modalApply">
                            Lamar
                            <i class="bi bi-send ms-1"></i>
                        </button>
                    </div>
                </div>

                @if (!$vacancy->hidden_partner)
                <div class="card card-partner order-1 order-md-2">
                    <div class="card-header text-bg-color">
                        <i class="bi bi-building me-2"></i>
                        Informasi Mitra
                    </div>
                    @if ($vacancy->project->partner->picture == 'landscape.webp')
                        <img src="{{ asset('img/landscape.webp') }}" alt="Tables" class="card-img-top">
                    @endif
                    {{--
                    @else
                    @endif
                    --}}
                    <div class="card-body">
                        <div class="wrap">
                            <h5 class="mb-2">{{ $vacancy->project->partner->name }}</h5>
                            @isset($vacancy->project->partner->description)
                                <p class="text-justify">{{ Str::words($vacancy->project->partner->description, 64, '...') }}</p>
                            @endisset
                        </div>

                        <div class="wrap mt-3">
                            <p class="summary-header">Tahun</p>
                            @isset($vacancy->project->partner->established_year)
                                <p>{{ $vacancy->project->partner->established_year }}</p>
                            @else
                                <p>-</p>
                            @endisset
                        </div>

                        <div class="wrap mt-3">
                            <p class="summary-header">Alamat</p>
                            @isset($vacancy->project->partner->address)
                                <p>{{ $vacancy->project->partner->address }}</p>
                            @else
                                <p>-</p>
                            @endisset
                        </div>

                        <div class="wrap mt-3">
                            <p class="summary-header">Situs</p>
                            @isset($vacancy->project->partner->website)
                                <p>{{ Str::lower($vacancy->project->partner->website) }}</p>
                            @else
                                <p>-</p>
                            @endisset
                        </div>
                    </div>
                </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection