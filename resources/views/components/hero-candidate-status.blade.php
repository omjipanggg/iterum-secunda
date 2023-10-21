@if ($data->interviewSchedules->count() > 0)
@php($param=['icon'=> 'check-circle', 'variant' => 'success', 'title' => 'Lamaran Anda terkirim!', 'message' => '<p>Kami akan segera menghubungi Anda melalui alamat email atau nomor telepon terdaftar, mohon periksa email Anda secara berkala, serta <a href="/profile" class="dotted">mutahirkan data diri Anda</a> demi kelancaran proses pelamaran kerja.</p>'])
@foreach ($data->interviewSchedules as $schedule)
	@if ($schedule->proposal->vacancy_id === $vacancy->id)
		@if ($schedule->status === 0)
			@php($param=['icon' => 'envelope', 'variant' => 'secondary', 'title' => 'Pembaruan dikirimkan melalui email Anda!', 'message' => '<p>Silakan periksa email Anda secara berkala untuk mengetahui perkembangan proses lamaran Anda.</p>'])
		@elseif ($schedule->status === 1)
			@php($param=['icon' => 'check-circle', 'variant' => 'success', 'title' => 'Sesi Wawancara diterima!', 'message' => '<p class="m-0">Sesi Wawancara dijadwalkan pada hari, <span class="fw-semibold">'. day_indo_format($schedule->interview_date) .', '. date_indo_format($schedule->interview_date) .' '. $schedule->interview_time .' WIB</span>, mohon <a href="/profile" class="dotted" target="_blank">mutahirkan data diri Anda</a> demi kelancaran proses pelamaran kerja, dan mohon kerjakan serangkaian tes di bawah ini (bila tersedia).</p>'])
		@elseif ($schedule->status === 2)
			@php($param=['icon' => 'x-circle', 'variant' => 'danger', 'title' => 'Sesi Wawancara ditolak!', 'message' => '<p class="m-0">Sayang sekali Anda tidak dapat mengikuti Sesi Wawancara yang kami tawarkan. Semoga tetap ada kemungkinan untuk bekerja sama di lain kesempatan. Sebagai alternatif, silakan telusuri lowongan kerja lainnya melalui <a href="/portal" class="dotted" target="_blank">tautan ini</a>.</p>'])
		@elseif ($schedule->status === 3 || $schedule->status === 5)
		@elseif ($schedule->status === 9)
			@php($param=['icon' => 'info-circle', 'variant' => 'warning', 'title' => 'Sesi Wawancara dijadwalkan ulang!', 'message' => '<p>Permintaan Anda terkait penjadwalan ulang Sesi Wawancara untuk hari, <strong>'. day_indo_format($schedule->interview_date) .', '. date_indo_format($schedule->interview_date) .' '. $schedule->interview_time .' WIB</strong> sudah kami terima. Mohon menunggu, dan <a href="/profile" target="_blank" class="dotted">mutahirkan data diri Anda</a> demi kelancaran proses pelamaran kerja.</p>'])
		@else
			@php($param=['icon' => 'question-circle', 'variant' => 'danger', 'title' => 'Data tidak ditemukan!', 'message' => '<p class="m-0">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente pariatur ducimus eos ipsam illum expedita recusandae nostrum, tempore eius. Sed, sit maiores architecto magnam, quod inventore, numquam esse fugit odio quasi, quas.</p>'])
		@endif
	@endif
@endforeach
<div class="alert alert-{{ $param['variant'] }} rounded-0 alert-dismissible fade show" role="alert">
	<h4 class="alert-heading"><i class="bi bi-{{ $param['icon'] }} me-3"></i>{{ $param['title'] }}</h4>
	{!! $param['message'] !!}
	@if ($param['variant'] != 'danger')
	<hr>
	<p class="mb-0">Rangkaian Tes Tersedia:</p>
	<ul class="ps-3 mb-0 square">
		@forelse($vacancy->tests as $test)
		<li>
			@php($taken=false)
			@php($completed=false)
			@if($taken)
			<strike>{{ $test->name }}</strike> (Diselesaikan pada {{ date_indo_format($completed) }})<i class="bi bi-check-circle ms-2"></i>
			@else
			<a href="#" class="dotted" onclick="underMaintenance(event);">{{ $test->name }}</a>
			@endif
		</li>
		@empty
		<li>Belum ada tes tersedia</li>
		@endforelse
	</ul>
	@endif
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@else
<div class="alert alert-success rounded-0 alert-dismissible fade show" role="alert">
	<h4 class="alert-heading"><i class="bi bi-check-circle me-3"></i>Lamaran Anda terkirim!</h4>
	<p>Kami akan segera menghubungi Anda melalui alamat email atau nomor telepon terdaftar, mohon <a href="{{ route('profile.index') }}" class="dotted">mutahirkan data diri Anda</a> demi kelancaran proses pelamaran kerja.</p>
	<hr>
	<p class="mb-0">Rangkaian Tes Tersedia:</p>
	<ul class="ps-3 mb-0 square">
		@forelse($vacancy->tests as $test)
		<li>
			@php($taken=false)
			@php($completed=false)
			{{--
			@forelse($testScores as $score)
				@if($score->proposal_question_id == $test->id)
					@if ($score->submit)
						@php($taken=true)
						@php($completed=$score->updated_at)
					@endif
				@endif
			@empty
			@endforelse
			--}}
			@if($taken)
			<strike>{{ $test->name }}</strike> (Diselesaikan pada {{ date_indo_format($completed) }})<i class="bi bi-check-circle ms-2"></i>
			@else
			<a href="#" class="dotted">{{ $test->name }}</a>
			{{-- <a href="{{ route('exam.show', $test->id) }}" class="dotted" onclick="startExamNow(event)">{{ $test->name }}</a> --}}
			@endif
		</li>
		@empty
		<li>Belum ada tes tersedia</li>
		@endforelse
	</ul>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif