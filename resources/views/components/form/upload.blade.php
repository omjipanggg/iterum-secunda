<form action="{{ route('home.upload') }}" enctype="multipart/form-data" method="POST">
    @method('POST')
    @csrf
    <div class="group mb-2">
    @error('file')
        <span class="form-text text-danger fw-bold">Kolom di bawah ini bersifat wajib.</span>
    @enderror
    <input type="file" class="@error('file') is-invalid @enderror form-control" name="file">
    </div>
    <button type="submit" class="btn btn-secondary">
    Submit
    <i class="bi bi-send ms-1"></i>
    </button>
</form>