@extends('layouts.panel')
@section('title', 'Master')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
			<h3>Dashboard</h3>
			@include('components.breadcrumbs')
			<div class="card">
				<div class="card-header">
					<i class="bi bi-database-lock me-2"></i>
					@yield('title')
				</div>
				<div class="card-body">
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum corporis quasi nemo voluptates architecto rerum suscipit incidunt soluta dolores eum nisi deserunt similique libero voluptatem a corrupti eos temporibus, quia inventore. Error, enim vero ipsa iusto ipsam sed eaque, quaerat consequatur deleniti quisquam esse. Officia corrupti ratione quo, voluptatibus iste totam velit, voluptates, perferendis inventore excepturi earum. Voluptates, voluptas a sit et aliquid blanditiis, hic, neque molestias, animi praesentium minima. Numquam iste, ex aliquam sequi nulla, voluptate doloribus dignissimos enim dolor debitis, ad ea quisquam animi ipsum totam corporis. Eaque eveniet recusandae est debitis natus dolorum quibusdam veritatis voluptas sint.
				</div>
			</div>
		</div>
	</div>
</div>
<div class="mb-3"></div>
@endsection
