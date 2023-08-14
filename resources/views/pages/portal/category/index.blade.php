@extends('layouts.app')
@section('title', 'Categories')
@section('content')
@include('components.navbar')
<div class="container px-12">
	<div class="row mb-4">
		<div class="col-12">
			<h4>Kategori</h4>
			{{ Breadcrumbs::render('category.index') }}
		</div>
	</div>
	<div class="row g-2">
		@foreach ($categories as $category)
		<div class="col-lg-3">
			<div class="card pointer" onclick="window.location.href = '{{ route('category.show', $category->slug) }}';">
				<div class="card-body">
					<div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
					{{ $category->name }}
					<span class="badge badge-floating text-bg-color">{{ $category->vacancies_count }}</span>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection