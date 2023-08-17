<div class="modal fade" id="modalApply" tabindex="-1" aria-labelledby="modalApplyLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-fullscreen-lg-down modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-bg-color">
                <h5 class="modal-title" id="modalApplyLabel">Kirim Lamaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('candidate.apply') }}" method="POST">
            <div class="modal-body" id="modalApplyBody">

            {{-- AUTHENTICATION --}}
            @auth
            @if (auth()->user()->hasRole(7))
                @csrf
                <div class="d-flex flex-column gap-2">
                    <small class="text-muted fw-semibold">Surat Lamaran</small>
                    <textarea name="cover_letter" id="coverLetterOnModal" cols="30" rows="10" class="editor"></textarea>
                    <small class=".text-muted fw-semibold">Unggah CV Anda</small>
                    <div class="wrap d-flex gap-2 flex-wrap align-items-center">
                        <button type="button" class="btn btn-color rounded-0 px-3" onclick="chooseResume()">
                            Pilih
                            <i class="bi bi-folder2-open ms-1"></i>
                        </button>
                        <input type="file" class="form-control d-none" name="resume" id="resumeOnModal" onchange="changePlaceholder(event)" accept="image/*, application/pdf, application/msword, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.wordprocessingml.template, application/vnd.ms-word.document.macroEnabled.12, application/vnd.ms-word.template.macroEnabled.12">
                        <label for="resumeOnModal">Tidak ada berkas terpilih</label>
                    </div>
                </div>
            @else
                <p class="m-0 fw-bold">Hak akses terbatas.</p>
            @endif
            @else
                <p class="m-0"><a href="{{ route('login') }}" class="underlined">Daftar/Masuk</a> untuk melamar.</p>
            @endauth

            </div>
            <div class="modal-footer py-1 text-bg-brighter-color">
            @auth
            @if (auth()->user()->hasRole(7))
                <button type="submit" class="btn btn-color px-3">
                    Kirim
                    <i class="bi bi-send ms-1"></i>
                </button>
            @endif
            @endauth
            </div>
            </form>
        </div>
    </div>
</div>