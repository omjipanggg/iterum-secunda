<form action="{{ route('candidate.updateResume', $candidate_id) }}" enctype="multipart/form-data" method="POST">
	@csrf
	@method('POST')
	<input type="file" class="form-control" name="resume" id="resume" accept="image/*, application/pdf, application/msword, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.wordprocessingml.template, application/vnd.ms-word.document.macroEnabled.12, application/vnd.ms-word.template.macroEnabled.12" required="">
	<small class="small form-text text-muted">Maksimal ukuran berkas yang diunggah adalah 4MB</small>
	<button type="submit" class="btn btn-color d-none" id="btn-modal">Simpan</button>
</form>