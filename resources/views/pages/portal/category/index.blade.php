@extends('layouts.app')
@section('title', 'Categories')
@section('content')
@include('components.navbar')
@include('components.hero-welcome')

@auth
@if (auth()->user()->hasRole(7))
<div class="mb-4"></div>
@endif
@endauth

<div class="container px-12">
	<div class="row mb-4">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4>Kategori</h4>
					{{ Breadcrumbs::render('category.index') }}
				</div>
			</div>
		</div>
	</div>
	<div class="row g-3">
		@foreach ($categories as $category)
		<div class="col-lg-3">
			<div class="card pointer" onclick="window.location.href = '{{ route('category.show', $category->slug) }}';">
				<div class="card-body">
					<div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
					{{ $category->name }}
					<span class="badge badge-floating text-bg-color">{{ $category->vacancies_count ?? '0' }}</span>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection