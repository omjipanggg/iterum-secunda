@extends('layouts.panel')
@section('title', 'Penilaian')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('score.index') }}
                </div>
            </div>
		</div>
	</div>
    <div class="row g-3">
        <div class="col">
            <div class="card">
                <div class="card-header text-bg-color">
                    <i class="bi bi-bar-chart-line me-2"></i>
                    @yield('title')
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="no-wrap table table-bordered table-sm table-hover table-scoring">
                            <thead>
                                <tr>
                                    <th class="text-center px-2" rowspan="2"><i class="bi bi-caret-right-square"></i></th>
                                    <th rowspan="2" class="text-center px-2"><i class="bi bi-box-arrow-up-right"></i></th>
                                    <th colspan="2">Aksi</th>
                                    <th rowspan="2" class="text-center px-2"><i class="bi bi-percent"></i></th>
                                    <th rowspan="2">Sesi Wawancara</th>
                                    <th rowspan="2">Nama Pelamar</th>
                                    <th rowspan="2">Lowongan Kerja</th>
                                    <th rowspan="2">Penempatan</th>
                                    <th rowspan="2">Tgl. Awal Kontrak</th>
                                    <th rowspan="2">Tgl. Akhir Kontrak</th>
                                    <th rowspan="2">THP</th>
                                    <th rowspan="2">Status</th>
                                    {{--
                                    <th>Tipe</th>
                                    <th>Lokasi/Tautan</th>
                                    <th>Status</th>
                                    --}}
                                </tr>
                                <tr>
                                    <th>Terima</th>
                                    <th>Tolak</th>
                                </tr>
                            </thead>
                            <tbody id="scoreParentBody"></tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center px-2"><i class="bi bi-caret-right-square"></i></th>
                                    <th class="text-center px-2"><i class="bi bi-box-arrow-up-right"></i></th>
                                    <th>Terima</th>
                                    <th>Tolak</th>
                                    <th class="text-center px-2"><i class="bi bi-percent"></i></th>
                                    <th>Sesi Wawancara</th>
                                    <th>Nama Pelamar</th>
                                    <th>Lowongan Kerja</th>
                                    <th>Penempatan</th>
                                    <th>Tgl. Awal Kontrak</th>
                                    <th>Tgl. Akhir Kontrak</th>
                                    <th>THP</th>
                                    <th>Status</th>
                                    {{--
                                    <th>Tipe</th>
                                    <th>Lokasi/Tautan</th>
                                    <th>Status</th>
                                    --}}
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-bg-brighter-color">
                    <i class="bi bi-info-circle me-2"></i>
                    Mohon isi seluruh kolom yang disediakan.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection