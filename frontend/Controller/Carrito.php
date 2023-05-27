<?php

	class Controller_Carrito{
		
		public function buildPage()
		{	
			Utils::sessionStartStore();
			// session_start();
			$data = array();
			$action = Utils::getParam("action", "");
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
			
				default:
					// $data["file_js"][] = "producto-store";
					if (isset($_GET['process_payment'])) {
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