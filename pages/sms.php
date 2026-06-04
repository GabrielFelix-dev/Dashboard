<?php if (isset($_SESSION['sms'])): ?>

	<div class="toast-notification" id="systemToast" role="alert">
		<div class="toast-icon">
			<i data-lucide="bell"></i>
		</div>

		<div class="toast-content">
			<p class="toast-message"><?= htmlspecialchars($_SESSION['sms']); ?></p>
		</div>

		<button type="button" class="toast-close" aria-label="Close" onclick="document.getElementById('systemToast').style.display='none'">
			<i data-lucide="x"></i>
		</button>
	</div>

<?php
	unset($_SESSION['sms']);
endif;
?>