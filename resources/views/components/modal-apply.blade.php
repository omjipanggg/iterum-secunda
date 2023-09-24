<form action="{{ route('candidate.apply') }}" method="POST" enctype="multipart/form-data" id="formApply" onsubmit="validateReCaptcha(event, this);">
@csrf
<input type="hidden" name="vacancy_id" value="{{ $vacancy->id }}">
@auth
    @if (auth()->user()->hasRole(7))
        <input type="hidden" name="candidate_id" value="{{ auth()->user()->profile->candidate->id }}">
        <input type="hidden" name="resume" value="{{ auth()->user()->profile->candidate->resume }}">
    @endif
@endauth
<div class="modal fade" id="modalApply" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalApplyLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-fullscreen-lg-down modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-bg-color">
                <h5 class="modal-title" id="modalApplyLabel">Kirim Lamaran&mdash;{{ Str::headline($vacancy->name) }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalApplyBody">

            {{-- AUTHENTICATION --}}
            @auth
            @if (auth()->user()->hasRole(7))
                <div class="d-flex flex-column gap-2">
                    {{--
                    @if (auth()->user()->profile->candidate->resume)
                    <div class="form-group">
                        <input type="hidden" name="resume" value="{{ auth()->user()->profile->candidate->resume }}">
                        <a href="{{ route('home.downloadResume', auth()->user()->profile->candidate->resume) }}" target="_blank" class="dotted small fw-semibold">
                            Lihat CV Anda
                            <i class="bi bi-box-arrow-up-right ms-1"></i>
                        </a>
                    </div>
                    @else
                    <div class="form-group">
                        <small class="text-muted fw-semibold">Unggah CV Anda</small>
                        <div class="wrap d-flex gap-2 flex-wrap align-items-center">
                            <input type="file" class="form-control" name="resume" id="resumeOnModal" required="" accept="image/*, application/pdf, application/msword, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.wordprocessingml.template, application/vnd.ms-word.document.macroEnabled.12, application/vnd.ms-word.template.macroEnabled.12">
                            <button type="button" class="btn btn-color rounded-0 px-3" onclick="chooseResume()">
                                Pilih
                                <i class="bi bi-folder2-open ms-1"></i>
                            </button>
                            <label for="resumeOnModal">Tidak ada berkas terpilih</label>
                        </div>
                    </div>
                    @endif
                    --}}
                    <div class="form-group">
                        <span class="text-muted fw-semibold small">Surat Lamaran</span>
                        <textarea name="cover_letter" id="coverLetterOnModal" cols="30" rows="10" class="editor"></textarea>
                    </div>
                    <div class="d-flex flex-wrap justify-content-end align-items-start flex-column invalid-recaptcha-container">
                        <span class="invalid-feedback d-block d-none m-0 invalid-recaptcha" role="alert">
                            <strong>Mohon centang kolom di bawah ini.</strong>
                        </span>
                        {!! ReCaptcha::htmlFormSnippet() !!}
                    </div>
                </div>
            @else
                <p class="m-0 fw-bold">Hak akses terbatas.</p>
            @endif
            @else
                <p class="m-0">Silakan <a href="{{ route('login') }}" class="underlined fw-semibold">Daftar/Masuk</a> untuk melamar.</p>
            @endauth
            {{-- END OF AUTHENTICATION --}}

            </div>
            @auth
            @if (auth()->user()->hasRole(7))
            <div class="modal-footer py-1 text-bg-brighter-color">
                <button type="submit" class="btn btn-color px-3">
                    Kirim Lamaran
                    <i class="bi bi-send ms-1"></i>
                </button>
            </div>
            @else
            <div class="modal-footer py-1 text-bg-brighter-color justify-content-start">
                <small class="text-align-start small justify-content-start">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Perhatian!</strong> Fitur ini ditujukan hanya untuk Para Pencari Kerja.
                </small>
            </div>
            @endif
            @else
            <div class="modal-footer py-1 text-bg-brighter-color justify-content-start">
                <small class="text-align-start small justify-content-start">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Perhatian!</strong> Fitur ini ditujukan hanya untuk Para Pencari Kerja.
                </small>
            </div>
            @endauth
            </div>
        </div>
    </div>
</div>
</form>