@extends('layouts.panel')
@section('title', 'Offering Letter')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('contract.offering') }}
                </div>
            </div>
			<div class="card">
				<div class="card-header text-bg-color">
					<div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
						<div class="group">
							<i class="bi bi-envelope-paper me-2"></i>
							@yield('title')
						</div>
						<a href="{{ route('contract.sendOffering') }}" onclick="triggerClick(event, '#btn-send-offering');" class="btn btn-outline-color btn-sm px-3">
							Kirim
							<i class="bi bi-envelope ms-1"></i>
						</a>
					</div>
				</div>
				<div class="card-body">
					@error('offered')
					<div class="alert alert-danger rounded-0" role="alert">
						<i class="bi bi-info-circle me-2"></i>
						<strong>Kesalahan!</strong>
						Mohon beri tanda (☑) pada kolom yang tersedia.
					</div>
					@enderror
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-sm disabled-order">
							<thead>
								<tr>
									<th class="text-center @error('offered') is-invalid @enderror">#</th>
									<th class="text-center px-2"><i class="bi bi-pencil-square"></i></th>
									<th>Lowongan Kerja</th>
									<th>Penempatan</th>
									<th>Tgl. Awal Kontrak</th>
									<th>Tgl. Akhir Kontrak</th>
									<th>THP</th>
									<th>Nama</th>
									<th>Email</th>
									<th>No. Telepon</th>
									<th>Persentase</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($offerings as $offer)
								<tr>
									<td class="@error('offered') is-invalid @enderror">
										<div class="form-check d-flex align-items-center justify-content-center">
											<input class="form-check-input check-box-offering" type="checkbox" value="{{ $offer->id }}" id="offered-{{ $offer->id }}">
										</div>
									</td>
									<td class="text-center"><a href="{{ route('score.show', $offer->schedule->id) }}" class="dotted"><i class="bi bi-pencil-square"></i></a></td>
									<td>
										<em>{{ Str::upper($offer->schedule->proposal->vacancy->project->project_number) }}</em>
										&middot;
										{{ Str::upper($offer->schedule->proposal->vacancy->name) }}
									</td>
									<td>{{ $offer->placement_to_be }}</td>
									<td>{{ date_indo_format($offer->starting_date) ?? date_indo_format($offer->schedule->proposal->vacancy->project->starting_date) }}</td>
									<td>{{ date_indo_format($offer->ending_date) ?? date_indo_format($offer->schedule->proposal->vacancy->project->ending_date) }}</td>
									<td>Rp{{ money_indo_format($offer->first_salary + $offer->second_salary) }},-</td>
									<td>{{ Str::upper($offer->schedule->proposal->candidate->profile->name) }}</td>
									<td>{{ Str::lower($offer->schedule->proposal->candidate->profile->primary_email) }}</td>
									<td>{{ $offer->schedule->proposal->candidate->profile->phone_number }}</td>
									<td>{{ number_format((((($offer->personality + $offer->teamwork + $offer->leadership + $offer->comperhension + $offer->work_motivation + $offer->interest_in_work)/30)*100) + ((($offer->computer_basic + $offer->computer_advance + $offer->linguistics + $offer->work_knowledge)/20)*100) + ((($offer->suitability)/5)*100))/3, 2) }}%</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th class="text-center @error('offered') is-invalid @enderror">#</th>
									<th class="text-center px-2"><i class="bi bi-pencil-square"></i></th>
									<th>Lowongan Kerja</th>
									<th>Penempatan</th>
									<th>Tgl. Awal Kontrak</th>
									<th>Tgl. Akhir Kontrak</th>
									<th>THP</th>
									<th>Nama</th>
									<th>Email</th>
									<th>No. Telepon</th>
									<th>Persentase</th>
								</tr>
							</tfoot>
						</table>
					</div>
					<form action="{{ route('contract.sendOffering') }}" method="POST" id="formOffering">
						@csrf
						@method('POST')
						<div id="offering-placeholder"></div>
						<button type="submit" class="d-none" id="btn-send-offering">Kirim</button>
					</form>
				</div>
				<div class="card-footer text-bg-brighter-color">
					<i class="bi bi-info-circle me-2"></i>
					Mohon berikan tanda (☑) untuk memilih kandidat.
				</div>
			</div>
		</div>
	</div>
</div>
@endsection