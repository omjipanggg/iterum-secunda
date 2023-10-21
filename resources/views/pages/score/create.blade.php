@extends('layouts.panel')
@section('title', 'Penilaian')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
            <div class="card">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('score.create') }}
                </div>
            </div>
		</div>
	</div>
</div>
@endsection