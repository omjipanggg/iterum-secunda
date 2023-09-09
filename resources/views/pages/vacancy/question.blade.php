@extends('layouts.panel')
@section('title', 'Tes Rekrutmen')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('vacancy.question') }}
                </div>
            </div>
		</div>
	</div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-bg-color">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                        <div class="wrap">
                            <i class="bi bi-vector-pen me-2"></i>
                            @yield('title')
                        </div>
                        <a href="#" class="btn btn-outline-color px-3">
                            Tambah
                            <i class="bi bi-box-arrow-up-right ms-1"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    Tes Rekrutmen
                </div>
                 <div class="card-footer text-bg-brighter-color">
                    <i class="bi bi-info-circle me-2"></i>
                    Mohon untuk dapat melengkapi seluruh kolom yang disediakan.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection