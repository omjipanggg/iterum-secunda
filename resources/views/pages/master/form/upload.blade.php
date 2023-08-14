<form action="{{ $action }}" enctype="multipart/form-data" method="POST">
    @method('POST')
    @csrf
    @error('file')
        <span class="form-text text-danger fw-bold">{{ $message }}</span>
    @enderror
    <input type="file" class="@error('file') is-invalid @enderror form-control" name="file" required="" accept=".csv">
    <button type="submit" class="btn btn-color d-none" id="btn-modal">
        Submit
        <i class="bi bi-send ms-1"></i>
    </button>
    <span class="form-text">(*/) Mohon sesuaikan format dokumen dan nama-nama kolom yang tersedia.</span>
</form>