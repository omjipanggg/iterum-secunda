@extends('layouts.app')
@section('title', 'Portal')
@section('content')
@include('components.navbar')
<section id="portal">
    {{--
    <div class="container">
        <div class="row">
	       	<div class="col-12">
	       		<div class="d-flex align-items-center justify-content-center">
		       		<img src="{{ asset('img/search.webp') }}" alt="Search" class="img-fluid img-hero">
	       		</div>
        	</div>
        </div>
    </div>
    --}}
    <div class="container">
    	<div class="row">
        	<div class="col-lg-8 offset-lg-2">
                <form action="{{ route('portal.index') }}" method="GET" class="w-100">
                    <div class="filter w-100 d-flex flex-column flex-sm-row">
                        <div class="position-relative flex-fill">
                            <i class="bi bi-briefcase icon-floating position-absolute"></i>
                            <input type="text" class="form-control py-3" name="keyword" autocomplete="off" placeholder="Pencarian" id="query" value="{{ request()->get('keyword') ?? old('keyword') }}">
                            <label for="query" class="visually-hidden">Pencarian</label>
                        </div>
                        <button type="submit" class="btn btn-color px-4">
                            Telusuri
                            <i class="bi bi-search ms-2"></i>
                        </button>
                    </div>
                </form>
        	</div>
    	</div>

        <div class="mt-12"></div>

        <div class="row position-relative">

            @if ($vacancies->count() > 0)
            <div class="col-12">
                @if(request()->get('keyword'))
                    <p class="mb-4">Menampilkan data dengan kata kunci: <strong>"{{ request()->get('keyword') }}"</strong></p>
                @endif
            </div>
            @endif

            <div class="col-12">
                <div class="d-flex flex-wrap gap-3 vacancy-container justify-content-between">
                    @forelse ($vacancies as $vacancy)
                    <div class="card vacancy-single pointer" onclick="window.location.href = '{{ route('portal.show', $vacancy->slug) }}';">
                        <div class="card-body position-relative">
                            <div class="row">
                                <div class="col-12 col-lg-9 mb-3">
                                    <span class="badge text-bg-color mb-3">
                                        {{ $vacancy->type->name }}
                                    </span>
                                    <div class="wrap">
                                        <h4 class="fw-semibold mb-0">
                                            <a href="{{ route('portal.show', $vacancy->slug) }}" class="dotted">
                                                {{ $vacancy->name }}
                                            </a>
                                        </h4>
                                        <p class="text-muted mb-0">
                                            @if ($vacancy->hidden_partner)
                                                &nbsp;
                                            @else
                                                {{ $vacancy->project->partner->name }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                @if(!$vacancy->hidden_salary)
                                <div class="col-12">
                                    <p class="mb-0">
                                        <i class="bi bi-cash-coin me-1"></i>
                                        {{ 'Rp' . money_indo_format($vacancy->min_limit) }}&mdash;{{ 'Rp' . money_indo_format($vacancy->max_limit) }}
                                    </p>
                                </div>
                                @endif
                                @if (!$vacancy->hidden_placement)
                                <div class="col-12">
                                    <p class="mb-0">
                                        <i class="bi bi-geo-alt me-1"></i>
                                        {{ $vacancy->placement }}
                                    </p>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer text-bg-brighter-color">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                <div class="wrap">
                                    <i class="bi bi-clock me-1"></i>
                                    Dipublikasikan sejak {{ $vacancy->published_at->locale('id')->diffForHumans() }}
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
                    <div class="card flex-fill">
                        <div class="card-body">
                            <p class="m-0 text-center">Data tidak ditemukan</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    	{{--
    	<div class="row py-4 gy-4">
    		@foreach ($vacancies as $vacancy)
        	<div class="col-lg-4 col-md-6">
        		<div class="card">
        			<div class="card-header">
        				<i class="bi bi-database me-2"></i>
        				{{ $vacancy->name }}
        			</div>
        			<div class="card-body">
        				{{ $vacancy->placement }}
        			</div>
        		</div>
        	</div>
    		@endforeach
    	</div>
    	--}}


        @if ($vacancies->count() > 0)
        <div class="row pt-4">
            <div class="col">
                <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start justify-content-between">
                    <p class="d-none d-md-block m-0">Halaman {{ $vacancies->currentPage() }} dari {{ $vacancies->lastPage() }}</p>
                    {!! $vacancies->appends(request()->except('page'))->links() !!}
                </div>
            </div>
        </div>
        @endif

    </div>
</section>
@endsection