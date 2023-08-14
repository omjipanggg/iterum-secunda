@extends('layouts.app')
@section('title', 'Pengaturan')
@section('content')
@include('components.navbar')
<div class="container">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header text-bg-color">
					<i class="bi bi-sliders me-2"></i>
					@yield('title')
				</div>
				<div class="card-body">
					<p class="m-0 text-justify">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem veritatis eum cumque cum totam porro doloribus fugiat maiores ratione dolores sapiente sit quaerat mollitia eius, odio vel unde culpa necessitatibus quia expedita. Blanditiis corrupti accusamus, eligendi necessitatibus reprehenderit eum quaerat quo pariatur, culpa quis rem cum earum nulla libero dolorem repellendus, obcaecati harum, commodi asperiores. Magnam ea soluta facilis qui doloribus omnis et dolores officiis saepe quasi libero, sed necessitatibus autem quod accusantium quaerat, maxime, obcaecati. Earum iure, fugit quia assumenda adipisci tempore non illum dignissimos, explicabo accusamus maxime doloremque aperiam impedit quaerat ducimus sit. Animi, id, deserunt? Quaerat, eaque rerum architecto eligendi voluptates vero provident? Accusamus atque inventore pariatur. Exercitationem odio quia deserunt consequatur numquam aperiam adipisci. Dolorum, saepe.
					</p>
				</div>
				<div class="card-footer text-bg-brighter-color">
					<i class="bi bi-info-circle me-2"></i>
					Mohon pastikan semua data sudah sesuai sebelum melanjutkan.
				</div>
			</div>
		</div>
	</div>
</div>
@endsection