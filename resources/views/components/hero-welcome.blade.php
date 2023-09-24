@auth
@if (auth()->user()->hasRole(7))
<div class="container">
    <div class="row g-3">
        <div class="col">
            <div class="card">
                <div class="card-body p-3 py-4 position-relative">
                    <p class="m-0 mb-2"><i class="bi bi-clock me-2"></i><span id="clock">{{ date('d F Y H:i:s') }}</span></p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                    @endif
                    <h3 class="fs-4">Selamat datang, {{ Str::headline(Auth::user()->name) }}!</h3>
                    <p class="mt-3 mb-0">Riwayat akses terakhir kali pada tanggal <strong>{{ date_time_indo_format(\Log::latestLog(auth()->user()->id)->created_at) }}</strong></p>
                    <p>Data Anda diperbarui terkahir pada tanggal <strong>{{ date_time_indo_format(auth()->user()->profile->updated_at) }}</strong></p>
                    <p>Apakah Anda ingin memperbarui data diri Anda? <a href="{{ route('profile.index') }}" class="dotted">Ya, Perbarui Data</a></p>

                    <hr>

                    <div class="mb-3">
                    <p class="mb-0">Riwayat pelamaran pekerjaan Anda:</p>
                    <ul class="square m-0">
                    @forelse (auth()->user()->profile->candidate->appliedTo as $proposal)
                        <li><a href="{{ route('portal.show', $proposal->slug) }}" class="dotted">{{ date_indo_format($proposal->pivot->created_at) }}, {{ Str::headline($proposal->name) }}</a>
                            <ul class="ps-3 m-0">
                                @foreach ($proposal->tests as $test)
                                    @php($taken=false)
                                    @php($completed=false)
                                    <li>
                                        @if($taken)
                                        <strike>{{ $test->name }}</strike> (Diselesaikan pada {{ date_indo_format($completed) }})<i class="bi bi-check-circle ms-2"></i>
                                        @else
                                        <a href="#" class="dotted">{{ $test->name }}</a>
                                        {{-- <a href="{{ route('exam.show', $test->id) }}" class="dotted" onclick="startExamNow(event)">{{ $test->name }}</a> --}}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @empty
                        <li>Belum ada lamaran terkirim</li>
                    @endforelse
                    </ul>
                    </div>
                    <a href="{{ route('portal.index') }}" class="dotted">Telusuri lowongan pekerjaan lainnya</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endauth