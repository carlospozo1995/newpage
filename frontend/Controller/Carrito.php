<?php

	class Controller_Carrito{
		
		public function buildPage()
		{	
			session_start();
			$data = array();
			$action = Utils::getParam("action", "");
			switch ($action) {
				case 'updateProductPrice':
					// if(isset($_POST)){
					// 	$id_product = Utils::desencriptar($_POST['id_product']);
					// 	$amount_product = $_POST['amount_product'];

					// 	$dataCart = array();
					// 	$total_product = 0;
					// 	$subtotal = 0;
					// 	// $total_iva = calculation and sum of all taxes
					// 	$total = 0;

					// 	if(!empty($id_product)){
					// 		$dataCart = $_SESSION['dataCart'];
					// 		for ($i=0; $i < count($dataCart); $i++) { 
					// 			if($dataCart[$i]['id'] == $id_product){
					// 				$dataCart[$i]['amount_product'] = $amount_product;
					// 				$total_product = $dataCart[$i]['price'] * $amount_product;
					// 				break;
					// 			}
					// 		}

					// 		$_SESSION['dataCart'] = $dataCart;
					// 		foreach ($_SESSION['dataCart'] as $product) {
					// 			$subtotal += $product['amount_product'] * $product['price'];
					// 			// $total_iva = calculation and sum of all taxes
					// 		}
					// 		// El total va el subtotal sumado con el total_iva
					// 		$total = $subtotal;
					// 		$data = array("status" => true,"total_product" => '$'.Utils::formatMoney($total_product), "subtotal" => '$'.Utils::formatMoney($subtotal), "total" => '$'.Utils::formatMoney($total));
					// 	}else{
					// 		$data = array("status" => false, "error" => "Ha ocurrido un error. Inténtelo más tarde.");
					// 	}
						
					// 	echo json_encode($data);
					// }
				break;
			
				default:
					// $data["file_js"][] = "producto-store";

					if (isset($_GET['process_payment'])) {
						if ($_GET['process_payment'] == 'comprar') {
							empty($_SESSION['dataCart']) ? header("Location: ".BASE_URL) : View::renderPage('Payment', $data);
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