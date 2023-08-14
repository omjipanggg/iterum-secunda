<div class="card">
	<div class="card-header text-bg-brighter-color">
		<i class="bi bi-cup-hot me-2"></i>
		@yield('title')
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col">
				<h3>Halo, {{ Str::headline(auth()->user()->name) }}!</h3>
				<p>Sambil nungguin hak akses kamu disesuaikan, kita main <strong>kertas-gunting-batu</strong>, yuk!</p>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="spaces d-flex flex-wrap align-items-center justify-content-between" id="spaces">
					<p>Putaran: <span id="moveLeft">3</span></p>
					<p id="nextScore"></p>
				</div>
				<p id="result" class="rounded-0 py-3 d-none mb-2"></p>
				<div class="hand-container d-flex flex-wrap align-items-center justify-content-between gap-3" id="handContainer">
					<button class="btn-hand" role="button" onclick="game('✋')">✋</button>
					<button class="btn-hand" role="button" onclick="game('✌')">✌</button>
					<button class="btn-hand" role="button" onclick="game('✊')">✊</button>
				</div>
				<button class="d-none restart btn btn-color rounded-0" id="restart" role="button" onclick="window.location.href = '{{ route('dashboard.index') }}';">
					Main lagi
					<i class="bi bi-arrow-clockwise ms-1"></i>
				</button>
			</div>
		</div>
		<div class="mb-3"></div>
		<div class="row">
			<div class="col">
				<div class="text-result" id="textResult">
                    <h4 class="mt-1">
                    	{{ Str::headline(Str::of(Auth::user()->name)->explode(' ')->first()) }}:
                    	<span id="playerScore">0</span>
                    	<span class="me-3" id="playerHand"></span>
                    </h4>
					<h4 class="mb-0">Selena:
						<span id="botScore">0</span>
						<span class="me-3" id="botHand"></span>
					</h4>
				</div>
			</div>
		</div>
	</div>
</div>
