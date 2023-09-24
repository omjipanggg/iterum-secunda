@extends('layouts.panel')
@section('title', 'Search')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('dashboard.search') }}
                </div>
            </div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<p>Menampilkan hasil pencarian dengan kata kunci: <strong>"{{ request()->input('keyword') }}"</strong></p>
					<p>Tidak ditemukan hasil apa-apa, maaf ya.</p>
					<a href="{{ route('dashboard.index') }}" class="underlined">Kembali ke Dashboard</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection