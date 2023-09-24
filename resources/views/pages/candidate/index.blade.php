@extends('layouts.panel')
@section('title', 'Pelamar')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('candidate.index') }}
                </div>
            </div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-sm table-bordered table-hover">
							<thead>
								<tr>
									<th>No</th>
									<th>ID</th>
									<th>Nama</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr>
									<th>No</th>
									<th>ID</th>
									<th>Nama</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection