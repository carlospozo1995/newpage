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

				case 'paymentProcess':
					if(isset($_POST)){
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
								if($payment_method == 'bank-transfer'){
									$data = 'transfer';
								}else if($payment_method == 'credit-card'){
									$data = 'credit';
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

						$data = array("status"=>$status,"msg"=>$msg);
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