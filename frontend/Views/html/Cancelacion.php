<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<div>
		<h1 style="color: blue; font-size: 40px;">¡HA CANCELADO EL PROCESO DE COMPRA!</h1>
		<?php
			Utils::dep($_SESSION['paymentProcessData']);
		?>
		<button><a href="<?= BASE_URL; ?>">Seguir comprando</a></button>
	</div>

</body>
</html>

