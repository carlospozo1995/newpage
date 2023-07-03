<?php

	class Controller_Carrito{
		
		public function buildPage()
		{	
			Utils::sessionStartStore();
			// session_start();
			$data = array();
			$action = Utils::getParam("action", "");
			$msg = "";
			$status = true;
			switch ($action) {
				case 'addCartProduct':
					if($_POST){
						$id_product = Utils::desencriptar($_POST['id_product']);
						if(!empty($id_product)){
							$arrInfoProd = Models_Store::getProductId($id_product);
							if(!empty($arrInfoProd)){
								$data_product = array('id' => $_POST['id_product'],
													'code' => intval($arrInfoProd['code']),
													'name' => $arrInfoProd['name_product'],
													'price' => floatval($arrInfoProd['price']),
													'stock' => intval($arrInfoProd['stock']),
													'url' => $arrInfoProd['url'],
													'image' => $arrInfoProd['images'][0]['url_image']);
							
								$data = array("status" => true, "product_added" => $data_product);
							}
						}else{
							$data = array("status" => false, "error" => "Ha ocurrido un error. Inténtelo más tarde.");
						}
						echo json_encode($data);
					}
				break;
				case 'getProducts':
					if (isset($_POST)) {
				        $productIds = implode(',', array_map(function($data) {
						    return Utils::desencriptar($data);
						}, $_POST['productIds']));
						$products = Models_Store::getProductsStorage($productIds);
						if(!empty($products)){

							$newArray = array();

							foreach ($products as $product) {
							    $newProduct = array(
							        'id' => Utils::encriptar($product['id_product']),
							        'code' => intval($product['code']),
							        'name' => $product['name_product'],
							        'price' => floatval($product['price']),
							        'stock' => intval($product['stock']),
							        'url' => $product['url'],
									'image' => $product['images'][0]['url_image']
							    );

							    $newArray[] = $newProduct;
							}
							echo json_encode($newArray);
						}
					}	
				break;

				case 'paymentTypeValidation':
					if(isset($_POST)){
						$card_payment = "";
						// $data_storage = $_POST['dataStorage'];
						// $unique_code = "";
						// $shipping_cost = 0;
						// $subtotal = 0;
						// $iva = 0;
						// $total = 0;
						$dni_client = $_POST['dni'];
						$name_client = $_POST['name'];
						$surname_client = $_POST['surname'];
						$email_client = $_POST['email'];
						$phone_client = $_POST['phone'];
						$main_town = $_POST['main_town'];
						$street = $_POST['address'];
						$add_info = $_POST['additional_information'];
						$addressee = $_POST['addressee'];
						$customer_message = $_POST['customer_message'];
						$payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
						$info_client_state = filter_var($_POST['info_client_state'], FILTER_VALIDATE_BOOLEAN);
						$check_state = filter_var($_POST['check_state'], FILTER_VALIDATE_BOOLEAN);				
						
						try {
							if ($info_client_state && $check_state && $payment_method != '' && $main_town != '' && $street != '' && $addressee) {
								// foreach ($data_storage as $value) {
								// 	$subtotal += $value['price'] * $value['amount_product'];
								// }

								// if ($subtotal < 100) {
								// 	if($main_town == 1){
								// 		$shipping_cost = 0;
								// 	}else if($main_town == 2){
								// 		$shipping_cost = 5;
								// 	}else{
								// 		$shipping_cost = 10;
								// 	}
								// }

								// $total = $subtotal + $iva + $shipping_cost;

								if($payment_method == 'bank-transfer'){
									$card_payment = false;
									// $unique_code = Utils::uniqueCode();
								}else if($payment_method == 'credit-card'){
									$card_payment = true;
									// $unique_code = Utils::uniqueCode();
								}else{
									throw new Exception("No es posible realizar el proceso intentelo mas tarde.");
								}
							}else{
								throw new Exception("No es posible realizar el proceso intentelo mas tarde.");
							}
						} catch (Exception $e) {
							$status = false;
							$msg = $e->getMessage();
						}
						$data = array("status"=>$status,"msg"=>$msg, "card_payment" => $card_payment);
						// $data = array("status"=>$status,"msg"=>$msg, "card_payment" => $card_payment, "total" => $total, "unique_code" => $unique_code);
						echo json_encode($data);
					}
				break;

				case 'checkProductStock':
					if (isset($_POST)) {
						$localStorage = $_POST['cartStorage'];
						$main_town = $_POST['main_town'];
						$unique_code = Utils::uniqueCode();
						$shipping_cost = 0;
						$subtotal = 0;
						$iva = 0;
						$total = 0;

						$productsIdsArr = array_map(function($data){
							return Utils::desencriptar($data['id']);
						}, $localStorage);
						$amountProductsArr = array_map(function($data){
							return $data['amount_product'];
						}, $localStorage); 
						$productsIds = implode(',', $productsIdsArr);
						$amountProducts = implode(',', $amountProductsArr);
						$priceProducts = implode(',', array_map(function($data){
							return $data['price'];
						}, $localStorage));

						$request = Models_Store::getProductsStorage($productsIds);

						$notEnoughStock = array();
						$storageChanges = "";
						$amountProductNewArr = "";
						$newArrayStorage = "";
						foreach ($request as $row) {
						    $productId = $row['id_product'];
						    $productStock = $row['stock'];
						    $productPrice = $row['price'];

						    $index = array_search($productId, explode(',', $productsIds));
						    $requestedAmount = explode(',', $amountProducts)[$index];
						    $requestedPrice = explode(',', $priceProducts)[$index];

						    if (($productStock < $requestedAmount || $requestedAmount <= 0 || $requestedAmount === null) || (floatval($productPrice) != floatval($requestedPrice))) {

						    	if (($productStock < $requestedAmount || $requestedAmount <= 0 || $requestedAmount === null) && (floatval($productPrice) != floatval($requestedPrice))) {
						    		$amountProductNewArr = $productStock;
						    	}

						    	if($productStock < $requestedAmount || $requestedAmount <= 0 || $requestedAmount === null){$amountProductNewArr = $productStock;}

						    	if(floatval($productPrice) != floatval($requestedPrice) && $productStock == $requestedAmount){
						    		$amountProductNewArr = $requestedAmount;
						    	}

						    	$notEnoughStock[] = array('amount_product' =>$amountProductNewArr, 'id' => Utils::encriptar($productId), 'name' => $row['name_product'], 'price' => $row['price'], 'stock' => $productStock, 'image' => $row['images'][0]['url_image'], 'code' => $row['code'], 'url' => '');
						    }
						}

						if (empty($notEnoughStock)) {
							foreach ($localStorage as $value) {
								$subtotal += $value['price'] * $value['amount_product'];
							}

							if ($subtotal < 100) {
								if($main_town == 1){
									$shipping_cost = 0;
								}else if($main_town == 2){
									$shipping_cost = 5;
								}else{
									$shipping_cost = 10;
								}
							}

							$total = $subtotal + $iva + $shipping_cost;

							if (count($productsIdsArr) == count($amountProductsArr)) {
							    $updateStock = Models_Store::updateStockTransaction($productsIdsArr, $amountProductsArr, $productsIds);
							}
						} else {
						    $status = false;
						    $storageChanges = $notEnoughStock;

							$newArray = array();

							$indexedArray2 = array();
							foreach ($storageChanges as $item2) {
							    $indexedArray2[$item2['id']] = $item2;
							}

							foreach ($localStorage as $item1) {
							    if (isset($indexedArray2[$item1['id']])) {
							        $item2 = $indexedArray2[$item1['id']];

							        if ($item1['stock'] != $item2['stock'] || $item1['price'] != $item2['price']) {
							            $newArray[] = $item2;
							        } else {
							            $newArray[] = $item1;
							        }
							    } else {
							        $newArray[] = $item1;
							    }
							}

							foreach ($storageChanges as $item2) {
							    if (!isset($indexedArray2[$item2['id']])) {
							        $newArray[] = $item2;
							    }
							}

							$newArrayStorage = $newArray;

							foreach ($newArrayStorage as $value) {
								$subtotal += floatval($value['price']) * intval($value['amount_product']);
							}

							if ($subtotal < 100) {
								if($main_town == 1){
									$shipping_cost = 0;
								}else if($main_town == 2){
									$shipping_cost = 5;
								}else{
									$shipping_cost = 10;
								}
							}

							$total = $subtotal + $iva + $shipping_cost;

						}
						$data = array('status' => $status, 'storageChanges' => $storageChanges, 'newArrayStorage' => $newArrayStorage , "total" => $total, "unique_code" => $unique_code);
						echo json_encode($data);

					}
				break;
			
				default:
					// $data["file_js"][] = "producto-store";
					if (isset($_GET['process_payment'])) {

						// if(isset($_SESSION['login'])){
						// 	echo "local";
						// }

						if ($_GET['process_payment'] == 'comprar') {
							$data["file_js"][] = "payment";
							View::renderPage('Payment', $data);
						}else{
							header("Location: ".BASE_URL."carrito/");
						}
					}else{
						View::renderPage('Carrito', $data);
					}

				break;
			}
		}
	}

?>