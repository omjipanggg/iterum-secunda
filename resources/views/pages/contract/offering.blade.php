@extends('layouts.panel')
@section('title', 'Offering Letter')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Dashboard</h3>
                    {{ Breadcrumbs::render('contract.offering') }}
                </div>
            </div>
			<div class="card">
				<div class="card-body">
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam officia iure in voluptatibus ea tenetur, odit, aliquid exercitationem quo. Molestiae sunt qui quis ipsa, dignissimos molestias repudiandae, recusandae, iste earum expedita architecto! Consectetur quibusdam debitis animi eligendi, officiis dolorum quam perferendis! Labore, illum? Ipsa enim, necessitatibus non perferendis commodi facilis molestiae facere saepe, fuga, odio suscipit laborum itaque porro molestias? Magni dolores numquam, expedita, error similique iure perspiciatis delectus rem consequuntur nostrum, sequi modi iusto aspernatur commodi nulla at excepturi voluptates. Earum voluptatibus non natus sit facilis est quisquam, distinctio, repellat ad quae minus officia, harum atque maiores iste, facere!
				</div>
			</div>
		</div>
	</div>
</div>
@endsection