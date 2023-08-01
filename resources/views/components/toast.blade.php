<?php if (isset($_SESSION['toast'])) { ?>
<p id="toast-message" class="d-none"><?= $_SESSION['toast']; ?></p>
<?php } ?>
<div class="toast-container" id="toast-container">
	<div class="toast fade" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="1600" data-bs-autohide="true">
	  <div class="toast-header"><p class="me-auto"><strong>Notification</strong></p>
	  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
	  </div>
	  <div class="toast-body">
	  	<p class="toast-text"><?php if (isset($_SESSION['toast'])) { echo $_SESSION['toast']; } ?></p>
	  </div>
	</div>
</div>
<?php unset($_SESSION['toast']); ?>