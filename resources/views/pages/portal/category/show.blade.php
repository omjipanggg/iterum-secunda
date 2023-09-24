@extends('layouts.app')
@section('title', 'Kategori: ' . $data->name)
@section('content')
@include('components.navbar')
@include('components.hero-welcome')

@auth
@if (auth()->user()->hasRole(7))
<div class="mb-4"></div>
@endif
@endauth

<div class="container px-12">
	<div class="row">
		<div class="col">
            <div class="card mb-4">
                <div class="card-body">
                	<h4>@yield('title')</h4>
        			{{ Breadcrumbs::render('category.show', $data) }}
                </div>
            </div>
		</div>
	</div>
    <div class="row position-relative">
        <div class="col-12">
            <div class="d-flex flex-wrap gap-3 vacancy-container justify-content-between">
                @forelse ($vacancies as $vacancy)
                <div class="card vacancy-single">
                {{-- <div class="card vacancy-single pointer" onclick="window.location.href = '{{ route('portal.show', $vacancy->slug) }}';"> --}}
                    <div class="card-body position-relative py-4">
                        <div class="category-floating position-absolute w-72 gap-1 d-flex flex-wrap justify-content-end">
                            @foreach ($vacancy->categories as $category)
                            <span class="badge text-bg-color">
                                <a href="{{ route('category.show', $category->slug) }}" class="dotted">
                                    {{ $category->name }}
                                </a>
                            </span>
                            @endforeach
                        </div>
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
                                        @if (!$vacancy->hidden_partner)
                                            {{ $vacancy->project->partner->name }}
                                        @else
                                            &nbsp;
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 align-self-center">
                                @if (!$vacancy->hidden_placement)
                                    <i class="bi bi-geo-alt me-1"></i>
                                    {{ $vacancy->placement }}
                                @else
                                    &nbsp;
                                @endif
                            </div>
                            <div class="col-12 align-self-center">
                                @if(!$vacancy->hidden_salary)
                                    <i class="bi bi-cash-coin me-1"></i>
                                    {{ 'Rp' . money_indo_format($vacancy->min_limit) }}&mdash;{{ 'Rp' . money_indo_format($vacancy->max_limit) }}
                                @else
                                    &nbsp;
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-bg-brighter-color">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                            <div class="wrap">
                                <i class="bi bi-clock me-2"></i>
                                Dipublikasikan sejak {{ $vacancy->published_at->locale('id')->diffForHumans() }}
                                {{-- {{ $vacancy->published_at->locale('id')->diffForHumans() }} --}}
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
                <p class="m-0 text-center">Tidak ada lowongan tersedia.</p>
                @endforelse
            </div>
        </div>
    </div>

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
@endsection