@extends('layouts.panel')
@section('title', 'Seleksi')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('recruitment.index') }}
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
                            <i class="bi bi-binoculars me-2"></i>
                            @yield('title')
                        </div>
                        <div class="group">
                            <a href="{{ route('recruitment.filter') }}" class="btn btn-outline-color btn-sm px-3" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="Seleksi" data-bs-type="Saring" onclick="event.preventDefault();" title="Saring">
                                Saring
                                <i class="bi bi-funnel ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(request()->query->count() > 0)
                        @php($param=[])
                        @foreach (request()->query->keys() as $key)
                            @if ($key == 'age')
                                @if (!empty(request()->get('age')))
                                    @php($param[]='Usia')
                                @endif
                            @elseif ($key == 'city')
                                @php($param[]='Kota Domisili')
                            @elseif ($key == 'gender')
                                @php($param[]='Jenis Kelamin')
                            @elseif ($key == 'education')
                                @php($param[]='Pendidikan')
                            @elseif ($key == 'min_limit')
                                @if (!empty(request()->get('min_limit')))
                                    @php($param[]='Gaji (Bawah)')
                                @endif
                            @elseif ($key == 'max_limit')
                                @if (!empty(request()->get('max_limit')))
                                    @php($param[]='Gaji (Atas)')
                                @endif
                            @elseif ($key == 'ready_to_work')
                                @php($param[]='Ketersediaan')
                            @elseif ($key == '_method' || $key == '_token')
                            @else
                                @php($param[]='Lainnya')
                            @endif
                        @endforeach
                        <p id="candidates-filter-info">Menampilkan hasil penyaringan entri dengan parameter: <strong>[{{ implode(', ', $param) }}]</strong> <a href="{{ route('recruitment.index') }}" onclick="reloadCandidatesTable(event, '#table-candidates');" class="underlined">Hapus</a></p>
                    @endif
                            {{-- @if (!empty(request()->get($key))) --}}
                            {{-- @endif --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm table-candidates" id="table-candidates">
                            <thead>
                                <th>No</th>
                                <th>Dokumen</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Jenis Kelamin</th>
                                <th>Kota Domisili</th>
                                <th>Tanggal Lahir</th>
                                <th>Pendidikan</th>
                                <th>Harapan Gaji</th>
                                <th>Ketersediaan</th>
                                <th>Total Lamaran</th>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <th>No</th>
                                <th>Dokumen</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Jenis Kelamin</th>
                                <th>Kota Domisili</th>
                                <th>Tanggal Lahir</th>
                                <th>Pendidikan</th>
                                <th>Harapan Gaji</th>
                                <th>Ketersediaan</th>
                                <th>Total Lamaran</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
                 <div class="card-footer text-bg-brighter-color">
                    <i class="bi bi-info-circle me-2"></i>
                    Jika terjadi kesalahan, <a href="#" class="dotted" onclick="underMaintenance(event);">silakan laporkan melalui tautan ini</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection