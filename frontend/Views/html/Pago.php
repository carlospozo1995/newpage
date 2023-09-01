	
<?php
	$data = json_encode($template_vars);

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "https://pay.payphonetodoesposible.com/api/button/V2/Confirm");
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt_array($curl, array(
	CURLOPT_HTTPHEADER => array(
	"Authorization: Bearer H69wgPGoCNlXxD_4pm4YhDd_EY2mC7K5hK7xHx2-qFcREHkmoCYl96ObQwSg-5mwVtjksrSwdhLe8_wuvkrhS33RFMolMbw2z3xcqaWRglZqSzVTyZ4F_pQwO2R-Uo6CRoOgrgLfWdl0E8rbmFaAYKsIdeCMQqTjZ0Keh1nl-3G1IRZr5TqAf1J9gqkjEGNGdjZgZS3O91rzyymlyl5AmmDommGDDChPV7_J9I-5XnY3M4X5x4Z7GqUpoCYUdBf0whGh8p2Qa_CEPJWEFHsssbunkZrF0l3RPxXPs8I0ecUH1I0xF6IhLyqiXvWKApjjTgYL8iFC2eG5tXupeZfTT_-hue0", "Content-Type:application/json"),
	));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($curl);
	curl_close($curl);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<div>
	<?php

	$data_transaction = json_decode($result, true);
	$statusCode = $data_transaction['statusCode'];
	$dateTransaction = $data_transaction['date'];

	if($statusCode == 2){
		// if (isset($_SESSION['productsIdsArr'], $_SESSION['productsAmountArr'], $_SESSION['productsIds'])) {
		// 	Models_Store::updatStockByCancellation($_SESSION['productsIdsArr'], $_SESSION['productsAmountArr'], $_SESSION['productsIds']);
		// 	unset($_SESSION['productsIdsArr'], $_SESSION['productsAmountArr'], $_SESSION['productsIds']);
		// }
	?>
		<h1><?= $data_transaction['message']; ?></h1>
	<?php
	}else{
		echo '<h1>COMPRA EXITOSA</h1>';
		Utils::dep($_SESSION['productsIdsArr']);
	}
	?>
		
	</div>
	
	<script> const base_url = "<?= BASE_URL; ?>"; </script>
    <script> const media_store= "<?= MEDIA_STORE; ?>"; </script>
	<script src="<?= MEDIA_STORE; ?>js/vendor/jquery-3.5.1.min.js"></script>
	<?php if ($statusCode != 2 && isset($_SESSION['productsIdsArr'], $_SESSION['productsAmountArr'], $_SESSION['productsIds'])): ?>
	<!-- <script src="<?= MEDIA_STORE; ?>js/store-transaction.js"></script> -->
	<script>
		localStorage.removeItem("shoppingCartData");
	</script>
	<?php 
		// unset($_SESSION['productsIdsArr'], $_SESSION['productsAmountArr'], $_SESSION['productsIds']); 
	endif ?>
</body>
</html>