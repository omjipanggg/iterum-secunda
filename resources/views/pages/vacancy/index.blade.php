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
                            <i class="bi bi-database me-2"></i>
                            @yield('title')
                        </div>
                        <a href="{{ route('vacancy.create') }}" class="btn btn-outline-color px-3">
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
                                    <th rowspan="2">Status</th>
                                    <th rowspan="2">ID Project</th>
                                    <th rowspan="2">Nama Mitra</th>
                                    <th rowspan="2">Posisi</th>
                                    <th rowspan="2">Kota Penempatan</th>
                                    <th rowspan="2">Regional</th>
                                    <th rowspan="2">Kebutuhan Personel</th>
                                    <th rowspan="2">Total Pelamar</th>
                                    <th rowspan="2">Sunting</th>
                                    <th colspan="2">Aksi</th>
                                </tr>
                                <tr>
                                    <th>Terbitkan</th>
                                    <th>Arsipkan</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>Status</th>
                                    <th>ID Project</th>
                                    <th>Nama Mitra</th>
                                    <th>Posisi</th>
                                    <th>Kota Penempatan</th>
                                    <th>Regional</th>
                                    <th>Kebutuhan Personel</th>
                                    <th>Total Pelamar</th>
                                    <th>Sunting</th>
                                    <th>Terbitkan</th>
                                    <th>Arsipkan</th>
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