@extends('layouts.panel')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
			<div class="table-responsive">
				<table class="table table-bordered table-sm">
					<thead>
						<tr>
							<th>id</th>
							<th>parent_id</th>
							<th>has_child</th>
							<th>name</th>
							<th>order</th>
						</tr>
					</thead>
					<tbody>
					@foreach (menu() as $element)
						<tr>
							<td>{{ $element->id }}</td>
							<td>{{ $element->parent_id }}</td>
							<td>{{ $element->has_child }}</td>
							<td>{{ $element->name }}</td>
							<td>{{ $element->order_number }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="mb-3"></div>
@endsection
