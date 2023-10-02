<?php

	class Controller_Carrito{

		public function buildPage()
		{
			Utils::sessionStartStore();
			
			$data = array();
			$action = Utils::getParam("action", "");
			$msg = "";
			$status = true;

			function verifyProductsDb($ordereProducts, $payment_method, $mainTown, $street, $add_info, $addressee, $messageClient, $p_dni) {
				$shipping_cost = 0;
				$subtotal = 0;
				$iva = 0;
				$total = 0;
				$alert = "";
				$unique_code = "";
	
				$productsIdsArr = array_map(function($data){return Utils::desencriptar($data['id']);}, $ordereProducts);
				$productsAmountArr = array_map(function($data){return $data['amount_product'];}, $ordereProducts);
				$productsPriceArr = array_map(function($data){ return $data['price']; }, $ordereProducts);
				
				$productsIds = implode(',', $productsIdsArr);
							
				$requestProducts = Models_Store::getOrderedProducts($productsIds, false);
	
				$productsWithChanges = array();
				$newQuantityProduct = null;
				$newProductsArray = array();
				$stockUpdate = false;

				foreach ($requestProducts as $product) {
					$id  = $product['id_product'];
					$stock = intval( $product['stock']);
					$price = floatval($product['price']);
	
					$index = array_search($id, $productsIdsArr);
					$orderedAmount = intval($productsAmountArr[$index]);
					$orderedPrice = floatval($productsPriceArr[$index]);
	
					if (($stock < $orderedAmount || $stock <= 0 || $stock === null) || ($price != $orderedPrice) || ($product['status'] != 1)) {
						
						if ($stock < $orderedAmount || $stock <= 0 || $stock === null) {
							$newQuantityProduct = $stock;
						}
	
						if($orderedAmount < $stock){
							$newQuantityProduct = $orderedAmount;
						}
	
						if ($price != $orderedPrice && $orderedAmount == $stock) {
							$newQuantityProduct = $orderedAmount;
						}
	
						$statusProduct = $product['status'] != 1 ? false : true;
	
						$productsWithChanges[] = array('amount_product' => $newQuantityProduct, 'id' => Utils::encriptar($id), 'name' => $product['name_product'], 'price' => $price, 'stock' => $stock, 'image' => $product['images'][0]['url_image'], 'code' => intval($product['code']), 'url' => $statusProduct);
					}
				}
				
				if (empty($productsWithChanges)) {
					if (!empty($p_dni)) {
						Models_Store::updateDniClient($p_dni, $_SESSION['idUser']);
					}

					$unique_code = Utils::uniqueCode();
					$stockUpdate = Models_Store::updateStockTransaction($productsIdsArr, $productsAmountArr, $productsIds);
					
					foreach ($ordereProducts as $product) {
						$subtotal += $product['price'] * $product['amount_product'];
					}

					if ($payment_method == 1) {
						Models_Store::insertCardPurchaseValidationData($unique_code, $productsIdsArr, $productsAmountArr);
					}

					$_SESSION['paymentProcessData'] = array("uniqueCode" => $unique_code, "orderedProducts" => $ordereProducts, "idClient" => $_SESSION['idUser'], "paymentType" => $payment_method, "mainTown" => $mainTown, "street" => $street, "addInfo" => $add_info, "addressee" => $addressee, "messageClient" => $messageClient);
				}else{
					$alert = 'Estimado cliente, algunos productos han presentado cambios recientes.'; 
					
					$indexedArray2 = array();
					foreach ($productsWithChanges as $item2) {
						$indexedArray2[$item2['id']] = $item2;
					}
	
					foreach ($ordereProducts as $item1) {
						if (isset($indexedArray2[$item1['id']])) {
							$item2 = $indexedArray2[$item1['id']];
	
							if ($item2['stock'] > 0 && $item2['url'] == 1) {
								if ($item1['stock'] != $item2['stock'] || $item1['price'] != $item2['price']) {
									$newProductsArray[] = $item2;
								}else{
									$newProductsArray[] = $item1;
								}
							}
						}else{
							$newProductsArray[] = $item1; 
						}
					};
	
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
	
				return array('subtotal' => $subtotal, 'iva' => $iva , 'envio' => $shipping_cost, 'total' =>  $total, 'stockUpdate' => $stockUpdate, 'productsWithChanges' => $productsWithChanges, 'newProductsArray' => $newProductsArray, 'alert' => $alert, 'unique_code'  => $unique_code);
			}

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
						$products = Models_Store::getOrderedProducts($productIds, true);
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
						$dni_client = "";

						if (!empty($_POST['dni'])) {
							$dni_client = $_POST['dni'];
						}else{
							$dni_client = Models_Store::getDataClient($_SESSION['idUser'])['dni'];
						}

						$main_town = $_POST['main_town'];
						$street = $_POST['address'];
						$add_info = $_POST['additional_information'];
						$addressee = $_POST['addressee'];
						$customer_message = $_POST['customer_message'];
						$payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
						$info_client_state = filter_var($_POST['info_client_state'], FILTER_VALIDATE_BOOLEAN);
						$check_state = filter_var($_POST['check_state'], FILTER_VALIDATE_BOOLEAN);

						$payment_type = null;
						$verifyProductsDb = null;

						try {
							if ($dni_client != "" && $info_client_state && $check_state && $payment_method != '' && $main_town != '' && $street != '' && $addressee != '' &&  !empty($ordered_products) && is_array($ordered_products)) {
								if($payment_method == 1){
									$payment_type = true;
									$verifyProductsDb = verifyProductsDb($ordered_products, $payment_method, $main_town, $street, $add_info, $addressee, $customer_message, $_POST['dni']);
								}else if($payment_method == 2){
									$payment_type = false;
									$verifyProductsDb = verifyProductsDb($ordered_products, $payment_method, $main_town, $street, $add_info, $addressee, $customer_message, $_POST['dni']);
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
						$data = array("status"=>$status, 'paymentType' => $payment_type, "verifyProductsDb" => $verifyProductsDb, "dni_client" => $dni_client, "email_client" => $_SESSION['data_user']['email'], "phone_client" => $_SESSION['data_user']['phone'], "msg"=>$msg);
						echo json_encode($data);
					}
				break;

				case 'getDni':
					if (isset($_POST)) {
						$dniClient = Models_Store::getDataClient($_SESSION['idUser']);
						echo json_encode($dniClient);
					}
				break;

				case 'verifyDni':
					if (isset($_POST)) {
						$dni_entered = $_POST['dni'];

						try {
							if (empty($dni_entered)) {
								throw new Exception("Por favor asegúrese de no tener los campos requeridos en rojo o vacios.");
								die();
							}else{
								$test_dni = "/^\d{6,}$/";

								if (!preg_match($test_dni, $dni_entered)) {
									throw new Exception("Por favor asegúrese de no tener los campos requeridos en rojo o vacios.");
									die();
								}else{
									$sql ="SELECT * FROM users WHERE (dni = ? AND id_user != ?)";
									$request = $GLOBALS["db"]->selectAll($sql, array($dni_entered, $_SESSION['data_user']['dni']));
									
									if (!empty($request)) {
										throw new Exception("Cédula/RUC ingresado ya está en uso. Por favor, intente nuevamente.");
										die();
									}
								}
							}
						} catch (Exception $e) {
							$status = false;
							$msg = $e->getMessage();
						}

						$data = array('status' => $status, "msg" => $msg);
						echo json_encode($data);
					}
				break;

				case 'payphoneCallError':
					if (isset($_POST)) {
						$orderedProducts = $_POST['orderedProducts'];

						$updateByCancellation = Utils::updateStockByCancelation($orderedProducts);

						if ($updateByCancellation) {
							$msg = "Lamentablemente, no podemos procesar su pago mediante el método seleccionado. Le invitamos a intentarlo utilizando otro medio de pago disponible o a ponerse en contacto con nuestro equipo de atención al cliente para que podamos ayudarle en el proceso.";
						}else{
							// enviar mensaje al administrador sobre los productos no actualizados si existe un error(enviando $_POST['orderedProducts'])
						}

						if (isset($_SESSION['paymentProcessData'])) {
							unset($_SESSION['paymentProcessData']);
						}
							
						$data = array("msg"=>$msg);
						echo json_encode($data);
					}
				break;
				
				default:
					if (isset($_GET['process_payment'])) {

						if ($_GET['process_payment'] == 'procesarCompra') {
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