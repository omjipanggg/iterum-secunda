<div class="modal fade" id="modalControl" data-bs-focus="false" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalControlLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-fullscreen-lg-down modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header text-bg-color">
        <i class="bi bi-database me-3"></i>
        <h5 class="modal-title" id="modalControlLabel">Table</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalControlBody">
      	<div id="modalControlPlaceholders">Fetching...</div>
      </div>
      <div class="modal-footer py-1 text-bg-brighter-color">
        <div class="d-flex gap-2 w-100 flex-wrap justify-content-between align-items-center">
          <p class="m-0 form-text">
            <i class="bi bi-info-circle me-1"></i>
            Mohon isi semua kolom yang tersedia.
          </p>
          <button type="button" class="btn btn-color px-3" id="trigger">
            Simpan
            <i class="bi bi-save ms-1"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>