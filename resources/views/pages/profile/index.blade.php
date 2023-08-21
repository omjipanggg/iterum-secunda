@extends('layouts.app')
@section('title', 'Profile')
@section('content')
@include('components.navbar')
<div class="container px-12">
	<div class="row">
		<div class="col">
			<div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
				<i class="bi bi-exclamation-circle me-2"></i>
				<strong>Perhatian!</strong> Mohon lengkapi data diri Anda sebelum melanjutkan proses pelamaran.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<div class="card mb-4">
				<div class="card-body">
				<ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
				  <li class="nav-item" role="presentation">
				    <button class="nav-link px-5 active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Pribadi</button>
				  </li>
				  <li class="nav-item" role="presentation">
				    <button class="nav-link px-5" id="pills-education-tab" data-bs-toggle="pill" data-bs-target="#pills-education" type="button" role="tab" aria-controls="pills-education" aria-selected="false">Pendidikan</button>
				  </li>
				  <li class="nav-item" role="presentation">
				    <button class="nav-link px-5" id="pills-experience-tab" data-bs-toggle="pill" data-bs-target="#pills-experience" type="button" role="tab" aria-controls="pills-experience" aria-selected="false">Pengalaman</button>
				  </li>
				  <li class="nav-item" role="presentation">
				    <button class="nav-link px-5" id="pills-skill-tab" data-bs-toggle="pill" data-bs-target="#pills-skill" type="button" role="tab" aria-controls="pills-skill" aria-selected="false">Keahlian</button>
				  </li>
				  <li class="nav-item" role="presentation">
				    <button class="nav-link px-5" id="pills-family-tab" data-bs-toggle="pill" data-bs-target="#pills-family" type="button" role="tab" aria-controls="pills-family" aria-selected="false">Keluarga</button>
				  </li>
				</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<div class="tab-content" id="pills-tabContent">
				@include('pages.candidate.tabs.profile')
				@include('pages.candidate.tabs.education')
				@include('pages.candidate.tabs.experience')
				@include('pages.candidate.tabs.skill')
				@include('pages.candidate.tabs.family')
			</div>
		</div>
	</div>
</div>
@endsection