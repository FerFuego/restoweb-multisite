<?php /* Template Name: Escanear */?>

<?php get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<h3>Escaneá el código QR de tu mesa</h3>

			<div id="reader"></div>

			<script>
				function onScanSuccess(qrCodeMessage) {
					// handle on success condition with the decoded message
					window.location.replace(qrCodeMessage);
				}
				function onScanFailure(error) {
					// handle scan failure, usually better to ignore and keep scanning
					alert(`QR error = ${error}`);
				}
				var html5QrcodeScanner = new Html5QrcodeScanner(
						"reader", { fps: 10, qrbox: 250 }, true
				);
				html5QrcodeScanner.render(onScanSuccess);
			</script>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php get_footer(); ?>