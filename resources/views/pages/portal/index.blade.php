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
            <div class="col-12">
                <div class="d-flex flex-wrap gap-4 vacancy-container justify-content-between">
                    @forelse ($vacancies as $vacancy)
                    <div class="card vacancy-item flex-fill pointer" onclick="window.location.href = '{{ route('portal.show', $vacancy->slug) }}';">
                        <div class="card-body position-relative">
                            <div class="row">
                                <div class="col">
                                    <span class="badge text-bg-color">
                                        {{ $vacancy->type->name }}
                                    </span>
                                </div>
                                <div class="col-12">
                                    <div class="wrap py-3">
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
                                <div class="col-12 align-self-center">
                                    <p class="m-0">
                                        <i class="bi bi-geo me-1"></i>
                                        @if ($vacancy->hidden_placement)
                                            Disembunyikan
                                        @else
                                            {{ $vacancy->placement }}
                                        @endif
                                    </p>
                                    <p class="m-0">
                                        <i class="bi bi-people me-1"></i>
                                        {{ $vacancy->candidates_count }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-bg-brighter-color">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                <div class="wrap">
                                    <i class="bi bi-clock me-1"></i>
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
                    <div class="card flex-fill">
                        <div class="card-body">
                            <p class="m-0 text-center">Tidak ada data dengan kata kunci <strong>"{{ request()->get('keyword') }}"</strong></p>
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


        <div class="row pt-4">
            <div class="col">
                <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start justify-content-between">
                    <p class="d-none d-md-block m-0">Halaman {{ $vacancies->currentPage() }} dari {{ $vacancies->lastPage() }}</p>
                    {!! $vacancies->appends(request()->except('page'))->links() !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection