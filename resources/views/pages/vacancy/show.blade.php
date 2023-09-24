@extends('layouts.panel')
@section('title', 'Lowongan Kerja: '. $vacancy->name)
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
                            <a href="{{ route('vacancy.archive', $vacancy->id) }}" onclick="archiveOrPublish(event);" data-bs-param="warning" data-bs-position="{{ Str::upper($vacancy->name) }}" class="btn btn-sm btn-outline-color px-3">
                                Arsipkan
                                <i class="bi bi-archive ms-1"></i>
                            </a>
                        @else
                            @if (!empty($vacancy->closing_date) && $vacancy->closing_date > today())
                            <a href="{{ route('vacancy.publish', $vacancy->id) }}" onclick="archiveOrPublish(event);" data-bs-param="info" data-bs-position="{{ Str::upper($vacancy->name) }}" class="btn btn-sm btn-outline-color px-3">
                                Terbitkan
                                <i class="bi bi-send ms-1"></i>
                            </a>
                            @endif
                        @endif
                        <a href="{{ route('vacancy.edit', $vacancy->id) }}" class="btn btn-sm btn-outline-color px-3">
                            Sunting
                            <i class="bi bi-pencil-square ms-1"></i>
                        </a>
                    </div>
                    </div>
                </div>
                <div class="card-body position-relative">
                    @if ($vacancy->active && $vacancy->closing_date > today())
                    <span class="position-absolute badge-left-floating badge text-bg-success">
                        <i class="bi bi-check-circle me-1"></i>
                        Published
                    </span>
                    @elseif (!$vacancy->active && $vacancy->closing_date > today())
                    <span class="position-absolute badge-left-floating badge text-bg-primary">
                        <i class="bi bi-info-circle me-1"></i>
                        Draft
                    </span>
                    @elseif ($vacancy->active && $vacancy->closing_date < today())
                    <span class="position-absolute badge-left-floating badge text-bg-danger">
                        <i class="bi bi-x-circle me-1"></i>
                        Expired
                    </span>
                    @elseif (!$vacancy->active && $vacancy->closing_date < today())
                    <span class="position-absolute badge-left-floating badge text-bg-danger">
                        <i class="bi bi-x-circle me-1"></i>
                        Expired
                    </span>
                    @else
                    <span class="position-absolute badge-left-floating badge text-bg-dark">
                        <i class="bi bi-question-circle me-1"></i>
                        Unknown
                    </span>
                    @endif

                    <div class="mt-5">
                        <p class="fs-5"><i class="bi bi-geo-alt-fill me-2"></i>{{ $vacancy->placement }}</p>
                        <p class="fs-2 mb-0">
                            <em>{{ $vacancy->project->project_number ?? 'Belum diperbarui' }}</em>
                            <span class="px-2">&middot;</span>
                            {{ $vacancy->name }}
                        </p>
                        <h5 class="mb-5 text-muted">{{ $vacancy->project->partner->name ?? 'Belum diperbarui' }}</h5>
                    </div>

                    @if ($similar->count() > 0)
                    <div class="card rounded-0 mt-3">
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @foreach ($similar as $relate)
                                    <a href="{{ route('vacancy.show', $relate->id) }}" class="list-group-item list-group-item-action">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                                            {{ $relate->name }}
                                            <div class="group">
                                                <span class="badge text-bg-color"><i class="bi bi-geo-alt-fill me-1"></i>{{ Str::slug($relate->placement) }}</span>
                                                @if ($relate->active)
                                                    <span class="badge text-bg-success"><i class="bi bi-check-circle-fill me-1"></i>active</span>
                                                @else
                                                    <span class="badge text-bg-danger"><i class="bi bi-x-circle-fill me-1"></i>inactive</span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
                <div class="card-footer text-bg-brighter-color">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <p class="m-0"><i class="bi bi-clock me-2"></i>{{ date_indo_format($vacancy->closing_date) ?? 'Belum diperbarui' }}</p>
                        <p class="m-0"><i class="bi bi-people me-2"></i>{{ $vacancy->quantity ?? '0' }}&nbsp;/&nbsp;{{ $vacancy->candidates->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-3"></div>

    <div class="row">
        <div class="col">
            <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link px-5 py-3 active" id="pills-primary-tab" data-bs-toggle="pill" data-bs-target="#pills-primary" type="button" role="tab" aria-controls="pills-primary" aria-selected="true">Pelamar</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link px-5 py-3" id="pills-secondary-tab" data-bs-toggle="pill" data-bs-target="#pills-secondary" type="button" role="tab" aria-controls="pills-secondary" aria-selected="false">Lainnya</button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-primary" role="tabpanel" aria-labelledby="pills-primary-tab" tabindex="0">
                <div class="card">
                    <div class="card-header text-bg-color">
                        <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                            <div class="group">
                                <i class="bi bi-people me-2"></i>
                                Pelamar
                            </div>
                            {{-- <a href="{{ route('recruitment.index') }}" class="btn btn-sm btn-outline-color px-3">Pilih Pelamar Lain</a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover nowrap table-applied-candidates" data-bs-vacancy-id="{{ $vacancy->id }}">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="px-2">Aksi</th>
                                        <th>Dokumen</th>
                                        <th>Tgl. Melamar</th>
                                        <th class="text-bg-lighest-color">Nama</th>
                                        <th class="text-bg-lighest-color">Alamat email</th>
                                        <th class="text-bg-lighest-color">No. Telepon</th>
                                        <th>Pendidikan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tgl. Lahir</th>
                                        <th>Kota Domisili</th>
                                        <th>Harapan Gaji</th>
                                        <th>Ketersediaan</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th class="px-2">Aksi</th>
                                        <th>Dokumen</th>
                                        <th>Tgl. Melamar</th>
                                        <th class="text-bg-lighest-color">Nama</th>
                                        <th class="text-bg-lighest-color">Alamat email</th>
                                        <th class="text-bg-lighest-color">No. Telepon</th>
                                        <th>Pendidikan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tgl. Lahir</th>
                                        <th>Kota Domisili</th>
                                        <th>Harapan Gaji</th>
                                        <th>Ketersediaan</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-bg-brighter-color">
                        <i class="bi bi-info-circle me-2"></i>
                        Tekan tombol <strong>[Lainnya]</strong> untuk memilih pelamar lainnya.
                    </div>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-secondary" role="tabpanel" aria-labelledby="pills-secondary-tab" tabindex="0">
                <div class="card">
                    <div class="card-header text-bg-color">
                        <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                            <div class="group">
                                <i class="bi bi-people me-2"></i>
                                Lainnya
                            </div>
                            {{-- <a href="{{ route('recruitment.index') }}" class="btn btn-sm btn-outline-color px-3">Pilih Pelamar Lain</a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover nowrap table-other-candidates" data-bs-vacancy-id="{{ $vacancy->id }}" data-bs-closing-date="{{ $vacancy->closing_date }}">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="text-center">Aksi</th>
                                        <th>Dokumen</th>
                                        <th class="text-bg-lighest-color">Nama</th>
                                        <th>Alamat email</th>
                                        <th>No. Telepon</th>
                                        <th>Pendidikan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Kota Domisili</th>
                                        <th>Harapan Gaji</th>
                                        <th>Ketersediaan</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th class="text-center">Aksi</th>
                                        <th>Dokumen</th>
                                        <th class="text-bg-lighest-color">Nama</th>
                                        <th>Alamat email</th>
                                        <th>No. Telepon</th>
                                        <th>Pendidikan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Kota Domisili</th>
                                        <th>Harapan Gaji</th>
                                        <th>Ketersediaan</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-bg-brighter-color">
                        <i class="bi bi-info-circle me-2"></i>
                        Tekan tombol <strong>[Pelamar]</strong> untuk melihat pelamar terdaftar.
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    {{--
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
                                    <div class="group">
                                        <span class="badge text-bg-color py-1"><i class="bi bi-geo-alt-fill me-1"></i>{{ Str::slug($relate->placement) }}</span>
                                        @if ($relate->active)
                                            <span class="badge text-bg-success py-1"><i class="bi bi-check-circle-fill me-1"></i>active</span>
                                        @else
                                            <span class="badge text-bg-danger py-1"><i class="bi bi-x-circle-fill me-1"></i>inactive</span>
                                        @endif
                                    </div>
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
    --}}
</div>
@endsection