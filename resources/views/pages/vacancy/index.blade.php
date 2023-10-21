@extends('layouts.panel')
@section('title', 'Lowongan Kerja')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('vacancy.index') }}
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
                            <i class="bi bi-newspaper me-2"></i>
                            @yield('title')
                        </div>
                        <a href="{{ route('vacancy.create') }}" class="btn btn-outline-color btn-sm px-3">
                            Tambah
                            <i class="bi bi-box-arrow-up-right ms-1"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table m-0 table-hover table-bordered table-sm table-vacancy">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th class="text-center"><i class="bi bi-pencil-square px-2"></i></th>
                                    <th>ID Project</th>
                                    <th>Nama Mitra</th>
                                    <th>Posisi</th>
                                    <th>Kota Penempatan</th>
                                    <th class="pe-5">Wilayah</th>
                                    <th class="pe-5">Kebutuhan</th>
                                    <th class="pe-5">Pelamar</th>
                                    <th>Aksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>Status</th>
                                    <th class="text-center"><i class="bi bi-pencil-square px-2"></i></th>
                                    <th>ID Project</th>
                                    <th>Nama Mitra</th>
                                    <th>Posisi</th>
                                    <th>Kota Penempatan</th>
                                    <th>Wilayah</th>
                                    <th class="pe-5">Kebutuhan</th>
                                    <th class="pe-5">Pelamar</th>
                                    <th>Aksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
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