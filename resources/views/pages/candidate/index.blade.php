@extends('layouts.app')
@section('title', 'Profile')
@section('content')
@include('components.navbar')
<div class="container px-12">
		<div class="row">
		<div class="col">
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
	</div>
</div>
@endsection