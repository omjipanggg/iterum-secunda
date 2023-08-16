<div class="modal fade" id="modalApply" tabindex="-1" aria-labelledby="modalApplyLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-fullscreen-lg-down modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header text-bg-color">
        <i class="bi bi-send me-3"></i>
        <h5 class="modal-title" id="modalApplyLabel">Lamar&mdash;{{ $vacancy->name }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalApplyBody">
        <div id="modalApplyPlaceholders">Fetching...</div>
      </div>
      <div class="modal-footer py-1 text-bg-brighter-color">
        <button type="button" class="btn btn-color" id="trigger">
          Simpan
          <i class="bi bi-file-earmark-plus ms-1"></i>
        </button>
      </div>
    </div>
  </div>
</div>