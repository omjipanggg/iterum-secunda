@extends('layouts.panel')
@section('title', 'Pelamar')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('candidate.show', $candidate) }}
                </div>
            </div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					{{ $candidate }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection