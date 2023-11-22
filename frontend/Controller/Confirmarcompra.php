<?php
	class Controller_Confirmarcompra{
		
		public function buildPage()
		{	
			Utils::sessionStartStore();

			$url_payment = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

			$queryString = parse_url($url_payment, PHP_URL_QUERY);
			parse_str($queryString, $params);

			$transaction = $params['id'];
			$client = $params['clientTransactionId'];
			$data_array = array(
				"id"=> (int)$transaction,
				"clientTxId"=>$client
			);

			$data = json_encode($data_array);
			
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, "https://pay.payphonetodoesposible.com/api/button/V2/Confirm");
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			curl_setopt_array($curl, array(
			CURLOPT_HTTPHEADER => array(
			"Authorization: Bearer A9IblYZbxZFqSIlahmjnYea1CeAKEFWZoUrNtux1YOeQV-fhvTQ7ouwKqYhYK1vQIqJy165MCSGuANYVJDzdzFW1f2_5M24mlmA4iedc0Ii5h4fQkXilX-4PTxlNq7VzJdAblwueJs2RVWieA6-e8AZnB-zSu5G2dEUkVhVxt9gKdUOLYT4MWK1TVUFPayfwumHLOwhqMeuzkE9CJmSlyQjbUTXc_-ofXi4G8qV1Zfyg4ABO7e03p_e3FiK-v3bdIhQZBUom6dOXOSA7LKMgL_3I-vHkCEB-U1DQhhb4C9a0gGrMeZxysUNdbYpuqHtxQ8-ApQ", "Content-Type:application/json"),
			));
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$result = curl_exec($curl);
			curl_close($curl);
			$result = json_decode($result, true);

			if(isset($_SESSION['login']) && isset($transaction) && isset($client) && !isset($result['errorCode'])){

				if (isset($_SESSION['paymentProcessData'])){
					$orderData = $_SESSION['paymentProcessData'];
					if ($orderData['uniqueCode'] == $client) {
						$shipping_costs = [
							1 => ['cost' => 0, 'name' => 'Balao'],
							2 => ['cost' => 5, 'name' => 'Santa Rita'],
							3 => ['cost' => 10, 'name' => 'San Carlos'],
						];
						$mainTown = isset($shipping_costs[$orderData['mainTown']]) ? $shipping_costs[$orderData['mainTown']]['name'] : '';
						$subtotal = 0;
						$iva = 0;
						$total = 0;

						foreach ($orderData['orderedProducts'] as $order) {
							$subtotal += $order['price'] * $order['amount_product'];
						}

						$shipping_cost = $subtotal < 100 ? $shipping_costs[$orderData['mainTown']]['cost'] : 0;
						$iva = $subtotal * 0.12;
						// iva function
						if ($subtotal > 0) {
							$total = $subtotal + number_format($iva, 2) + $shipping_cost;
						}

						$addInfo = !empty($orderData['addInfo']) ? '-'.$orderData['addInfo'] : "";
						$message = !empty($orderData['messageClient']) ? $orderData['messageClient'] : null;

						$insertedData = array("num_order" => crc32(date("Y-m-d h:i:s")), "transaction_uniqueCode" => $orderData['uniqueCode'], "id_transactionCard" => $result['transactionId'], "cardData" => json_encode($result), "user_id" => $orderData['idClient'], "shipping_cost" => $shipping_cost, "total" => $total, "payment_type_id" => $orderData['paymentType'], "addressee" => $orderData['addressee'], "shipping_address" => $mainTown .'-'. $orderData['street'] .$addInfo, "message" => $message, "status" => $result['transactionStatus']);

						$insertOrders = Models_Store::insertOrders($insertedData, true);
						
						if ($insertOrders > 0) {
							$arrDetailProducts = array();
							// enviar correo al cliente sobre su compra
							foreach ($orderData['orderedProducts'] as $order) {
								$insertOrdersDetails = array("order_id" => $insertOrders, "product_id" => Utils::descryptStore($order['id']), "name_product" => $order['name'], "price" => $order['price'], "quantityOrdered" => $order['amount_product'], "url_product" => $order['url']);

								$insertDetails = Models_Store::insertOrders($insertOrdersDetails, false);
								$arrDetailProducts[] = $insertDetails;
							}
							
							if (count($arrDetailProducts) > 0){
								// if ($result['statusCode'] == 3) {
								// 	$sendData = Models_Store::showOrderClient($client);
								// 	$asunto = "¡Su pedido fue realizado con éxito!";
									
								// 	if (count($sendData['ordered_products']) == 1) {
								// 		$palabras = explode(' ', $sendData['ordered_products'][0]['name_product']);
								// 		$nuevoNombre = (count($palabras) > 1) ? $palabras[0] . ' ' . substr($palabras[1], 0, strlen($palabras[1]) / 2) . '...' : $sendData['ordered_products'][0]['name_product'];
								// 		$asunto = "Su pedido de " .$nuevoNombre." ¡fue realizado con éxito!";
								// 	}
								// 	$dataEmailTest = array( "name" => $sendData['name_user'] ." ". $sendData['surname_user'],
								// 							"email" => $sendData['email'],
								// 							"asunto" => $asunto,
								// 						); 
							
								// 	$sendEmail = Utils::sendEmail($dataEmailTest, 'email_buyConfirm', $sendData);
								// }
							}else{
								// enviar mensaje al administrador sobre los detalles de los productos no insertados en la tabla detallePedidos mandando el array $insertOrdersDetails
							}
						}else{
							// enviar mensaje al administrador sobre los productos no insertados en la tabla pedido mandando el array $insertedData
						}

						if ($result['statusCode'] != 3) {
							$updateByCancellation = Utils::updateStockByCancelation($orderData['orderedProducts']);
							if ($updateByCancellation == false) {
								// enviar mensaje al administrador sobre los productos no actualizados si existe un error(enviando $orderData['orderedProducts'])
							}
						}
					}
				}

				$idClient_transaction = Models_Store::getIdClient($result['clientTransactionId']);
				if (!empty($idClient_transaction) && $idClient_transaction['user_id'] == $_SESSION['idUser']) {
					View::renderPage('Confirmarcompra', $result);
				}else{
					header("Location: ".BASE_URL);
				}
			
				if (isset($_SESSION['paymentProcessData']) && $orderData['uniqueCode'] == $client) {
					unset($_SESSION['paymentProcessData']);
				}

			}else{
				header("Location: ".BASE_URL);
			}
		}
	}


?>