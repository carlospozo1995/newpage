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
						$products = Models_Store::getOrderedProducts($productIds);
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
						$ordered_products = $_POST['ordered_products'];
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

						$payment_type = "";
						$verifyProductsDb = self::verifyProductsDb($ordered_products, $main_town);

						try {
							if ($info_client_state && $check_state && $payment_method != '' && $main_town != '' && $street != '' && $addressee != '' && $ordered_products != '') {
								if($payment_method == 'bank-transfer'){
									$payment_type = false;
								}else if($payment_method == 'credit-card'){
									$payment_type = true;
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
						$data = array("status"=>$status, 'paymentType' => $payment_type, 'verifyProductsDb' => $verifyProductsDb, "msg"=>$msg);
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

		public function verifyProductsDb($ordereProducts, $mainTown) {
			$unique_code = Utils::uniqueCode();
			$shipping_cost = 0;
			$subtotal = 0;
			$iva = 0;
			$total = 0;

			$productsIdsArr = array_map(function($data){return Utils::desencriptar($data['id']);}, $ordereProducts);
			$productsAmountArr = array_map(function($data){return $data['amount_product'];}, $ordereProducts);
			$productsPriceArr = array_map(function($data){ return $data['price']; }, $ordereProducts);
			
			$productsIds = implode(',', $productsIdsArr);
						
			$requestProducts = Models_Store::getOrderedProducts($productsIds);
			
			$productsWithChanges = array();
			$newQuantityProduct = null;
			$newProductsArray = array();
			$stockUpdate = true;

			foreach ($requestProducts as $product) {
				$id  = $product['id_product'];
				$stock = intval( $product['stock']);
				$price = floatval($product['price']);

				$index = array_search($id, $productsIdsArr);
				$orderedAmount = intval($productsAmountArr[$index]);
				$orderedPrice = floatval($productsPriceArr[$index]);

				if (($stock < $orderedAmount || $stock <= 0 || $stock === null) || ($price != $orderedPrice)) {
					
					$stockUpdate = false;
					if ($stock < $orderedAmount || $stock <= 0 || $stock === null) {
						$newQuantityProduct = $stock;
					}

					if($orderedAmount < $stock){
						$newQuantityProduct = $orderedAmount;
					}

					$productsWithChanges[] = array('amount_product' => $newQuantityProduct, 'id' => Utils::encriptar($id), 'name' => $product['name_product'], 'price' => $price, 'stock' => $stock, 'image' => $product['images'][0]['url_image'], 'code' => intval($product['code']), 'url' => '');
				}
			}

			if($stockUpdate === true){
				Models_Store::updateStockTransaction($productsIdsArr, $productsAmountArr, $productsIds);
			}
			
			if (empty($productsWithChanges)) {
				foreach ($ordereProducts as $product) {
					$subtotal += $product['price'] * $product['amount_product'];
				}
			}else{
				$indexedArray2 = array();
				foreach ($productsWithChanges as $item2) {
					$indexedArray2[$item2['id']] = $item2;
				}
				foreach ($ordereProducts as $item1) {
					if (isset($indexedArray2[$item1['id']])) {
						$item2 = $indexedArray2[$item1['id']];
						
						if ($item1['stock'] != $item2['stock'] || $item1['price'] != $item2['price']) {
							$newProductsArray[] = $item2;
						}else{
							$newProductsArray[] = $item1;
						}
					}else{
						$newProductsArray[] = $item1; 
					}
				}

				foreach ($productsWithChanges as $item2) {
					if(!isset($indexedArray2[$item2['id']])){
						$newProductsArray[] = $item2;
					}
				}

				foreach ($newProductsArray as $value) {
					$subtotal += floatval($value['price']) * intval($value['amount_product']);
				}

			}

			if ($subtotal < 100) {
				if($mainTown == 1){
					$shipping_cost = 0;
				}else if($mainTown == 2){
					$shipping_cost = 5;
				}else{
					$shipping_cost = 10;
				}
			}

			if ($subtotal > 0) {
				$total = $subtotal + $iva + $shipping_cost;
			}

			return array('total' =>  $total, 'flag_stockUpdate' => $stockUpdate, 'productsWithChanges' => $productsWithChanges, 'newProductsArray ' => $newProductsArray);
		}

	}

?>
