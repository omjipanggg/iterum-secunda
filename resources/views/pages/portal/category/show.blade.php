@extends('layouts.app')
@section('title', 'Kategori: ' . Str::headline($data->name))
@section('content')
@include('components.navbar')
<div class="container px-12">
	<div class="row mb-4">
		<div class="col">
			<h4>@yield('title')</h4>
			{{ Breadcrumbs::render('category.show', $data) }}
		</div>
	</div>
    <div class="row position-relative">
        <div class="col-12">
            <div class="d-flex flex-wrap gap-3 vacancy-container justify-content-between">
                @forelse ($vacancies as $vacancy)
                <div class="card vacancy-item flex-fill pointer" onclick="window.location.href = '{{ route('portal.show', $vacancy->slug) }}';">
                    <div class="card-body position-relative py-4">
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
    </div>

    <div class="row pt-3">
        <div class="col">
            <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start justify-content-between">
                <p class="d-none d-md-block m-0">Halaman {{ $vacancies->currentPage() }} dari {{ $vacancies->lastPage() }}</p>
                {!! $vacancies->appends(request()->except('page'))->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection