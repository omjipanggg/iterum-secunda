@extends('layouts.panel')
@section('title', 'FAQ')
@section('content')
<div class="container-fluid px-12">
	<div class="row">
		<div class="col">
			<div class="card mb-4">
				<div class="card-body">
					<h3>Dashboard</h3>
					{{ Breadcrumbs::render('dashboard.faq') }}
				</div>
			</div>
			<div class="card">
				<div class="card-header text-bg-brighter-color">
					<i class="bi bi-question-circle me-2"></i>
					@yield('title')
				</div>
				<div class="card-body">
					<div class="accordion" id="accordionFlushExample">
						<div class="accordion-item">
					    <h2 class="accordion-header">
					      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
					        SELENA™ itu apa?
					      </button>
					    </h2>
					    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
					      <div class="accordion-body">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem aliquam maiores, laudantium. Quae nam, similique exercitationem suscipit dicta neque officia omnis aliquam possimus reiciendis ipsum temporibus aut! Obcaecati, dignissimos! Sed eveniet rem distinctio excepturi vitae laudantium modi, explicabo temporibus laboriosam vero molestiae, non repudiandae atque, reprehenderit omnis ullam animi, consequuntur?</div>
					    </div>
						</div>
						<div class="accordion-item">
					    <h2 class="accordion-header">
					      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
					        Bagaimana cara mendaftar di SELENA™?
					      </button>
					    </h2>
					    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
					      <div class="accordion-body">Lorem, ipsum dolor sit amet, consectetur adipisicing elit. Omnis quibusdam expedita quidem quaerat impedit commodi soluta ex voluptatum sequi non perspiciatis ut, aliquid inventore vitae suscipit maxime quia totam facere numquam quasi placeat iste architecto itaque sint. Tempore perferendis impedit asperiores minus?</div>
					    </div>
						</div>
						<div class="accordion-item">
					    <h2 class="accordion-header">
					      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
					        Bagaimana cara menambahkan data di SELENA™?
					      </button>
					    </h2>
					    <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
					      <div class="accordion-body">Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum, suscipit! Explicabo quidem eaque neque placeat ducimus veritatis aspernatur tempora! Libero, nesciunt quod. Repellendus mollitia impedit libero ipsa, aliquid saepe accusantium.</div>
					    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="mb-3"></div>
@endsection
