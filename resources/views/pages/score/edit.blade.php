@extends('layouts.panel')
@section('title', 'Penilaian: ' . Str::upper($schedule->id))
@section('content')
<div class="container-fluid px-12">
	<div class="row g-4">
		<div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('score.edit', $schedule) }}
                </div>
            </div>
		</div>
        <div class="col">
            <div class="card">
                <div class="card-header text-bg-color">
                    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                        <div class="group">
                            <i class="bi bi-bar-chart-line me-2"></i>
                            @yield('title')
                        </div>
                        <a href="{{ route('score.store', $schedule->id) }}" onclick="triggerClick(event, '#formScoring');" class="btn btn-outline-color btn-sm px-3">
                            Simpan
                            <i class="bi bi-save ms-1"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                        <form action="{{ route('score.update', $schedule->id) }}"></form>
                </div>
                <div class="card-footer text-bg-brighter-color">
                    <i class="bi bi-info-circle me-2"></i>
                    Mohon isi semua kolom yang tersedia.
                </div>
            </div>
        </div>
	</div>
</div>
@endsection