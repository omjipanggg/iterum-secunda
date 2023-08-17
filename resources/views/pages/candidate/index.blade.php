@extends('layouts.app')
@section('title', 'Profile')
@section('content')
@include('components.navbar')
<div class="container px-12">
	<div class="row">
		<div class="col">
			<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
			  <li class="nav-item" role="presentation">
			    <button class="nav-link active+
			    " id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Data Diri</button>
			  </li>
			  <li class="nav-item" role="presentation">
			    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Data Pendidikan</button>
			  </li>
			  <li class="nav-item" role="presentation">
			    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Data Pengalaman</button>
			  </li>
			  <li class="nav-item" role="presentation">
			    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Data Keahlian</button>
			  </li>
			  <li class="nav-item" role="presentation">
			    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Data Keluarga</button>
			  </li>
			  <li class="nav-item" role="presentation">
			    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Data Pengalaman</button>
			  </li>
			  <li class="nav-item" role="presentation">
			    <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-disabled" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false" disabled>Disabled</button>
			  </li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
					<div class="card">
						<div class="card-header text-bg-brighter-color">
							<i class="bi bi-person-fill me-2"></i>
							@yield('title')
						</div>
						<div class="card-body">
							{{-- <select name="school" id="school" class="select2-ajax-school form-select"></select> --}}
							<div class="form-select-floating">
								<label for="user">Pengguna</label>
								<select name="user" id="user" class="select2-server form-select" data-bs-table="users"></select>
							</div>
						</div>
						<div class="card-footer text-bg-brighter-color">
							<i class="bi bi-info-circle me-2"></i>
							Mohon pastikan bahwa data yang Anda kirimkan sudah benar.
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">...</div>
				<div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">...</div>
			</div>
		</div>
	</div>
</div>
@endsection