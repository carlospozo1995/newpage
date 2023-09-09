	
<?php
	$transationData = $template_vars;
	// Utils::dep($transationData);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Confirmación de compra</title>
</head>
<body>	
	<button><a href="<?= BASE_URL; ?>">Seguir comprando</a></button>

	<script> const base_url = "<?= BASE_URL; ?>"; </script>
    <script> const media_store= "<?= MEDIA_STORE; ?>"; </script>
	<script src="<?= MEDIA_STORE; ?>js/vendor/jquery-3.5.1.min.js"></script>
	<script src="<?= MEDIA_STORE; ?>js/transaction-complete.js"></script>
</body>
</html>
