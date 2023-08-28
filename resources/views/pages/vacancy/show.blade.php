@extends('layouts.panel')
@section('title', 'Lowongan Kerja')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('vacancy.show', $vacancy) }}
                </div>
            </div>
		</div>
	</div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-bg-color">
                    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                    <div class="wrap">
                        <i class="bi bi-database me-2"></i>
                        @yield('title')
                    </div>
                    <div class="wrap">
                        @if ($vacancy->active)
                            <a href="{{ route('vacancy.archive', $vacancy->id) }}" class="btn btn-outline-color px-3">
                                Arsipkan
                                <i class="bi bi-archive ms-1"></i>
                            </a>
                        @else
                            <a href="{{ route('vacancy.publish', $vacancy->id) }}" class="btn btn-outline-color px-3">
                                Terbitkan
                                <i class="bi bi-send ms-1"></i>
                            </a>
                        @endif
                        <a href="{{ route('vacancy.edit', $vacancy->id) }}" class="btn btn-outline-color px-3">
                            Sunting
                            <i class="bi bi-pencil-square ms-1"></i>
                        </a>
                    </div>
                    </div>
                </div>
                <div class="card-body">
                    {{ $vacancy }}
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3"></div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-bg-color">
                    <i class="bi bi-database me-2"></i>
                    Lainnya
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse ($similar as $relate)
                            <a href="{{ route('vacancy.show', $relate->id) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                    {{ $relate->name }}
                                    <span class="badge text-bg-color">{{ ($relate->placement) }}</span>
                                </div>
                            </a>
                        @empty
                        <div class="list-group-item">Tidak ada data</div>
                        @endforelse
                    </div>
                </div>
                <div class="card-footer text-bg-brighter-color">
                    <i class="bi bi-info-circle me-2"></i>
                    Lowongan Kerja lain dengan <abbr title="{{ $vacancy->project->project_number }}">ID Project</abbr> yang sama.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection