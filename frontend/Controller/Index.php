<?php

	class Controller_Index{
		public function buildPage()
		{	
			session_start();
			$action = Utils::getParam("action", "");
			$data = array();
			switch ($action) {
				case 'addCartProduct':
					if($_POST){
						$id_product = Utils::desencriptar($_POST['id_product']);
						if(!empty($id_product)){
							$arrInfoProd = Models_Store::getProductId($id_product);
							if(!empty($arrInfoProd)){
								$data_product = array('id' => $_POST['id_product'],
													'code' => $arrInfoProd['code'],
													'name' => $arrInfoProd['name_product'],
													'price' => $arrInfoProd['price'],
													'stock' => $arrInfoProd['stock'],
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

				case 'delItemCart':
					if (isset($_POST)) {
						$dataCart = array();
						$amountCart  = 0;
						$subtotal = 0;
						// $total_iva = calculation and sum of all taxes
						$total = 0;
						$option = $_POST['option'];
						$id_product = Utils::desencriptar($_POST['id_product']);
						if(!empty($id_product) AND ($option == 1 OR $option == 2)){
							$dataCart = $_SESSION['dataCart'];
							for ($i=0; $i < count($dataCart); $i++) { 
								if($dataCart[$i]['id'] == $id_product){
									unset($dataCart[$i]);
								}
							}
							sort($dataCart);
							$_SESSION['dataCart'] = $dataCart;

							foreach ($_SESSION['dataCart'] as $product) {
								$amountCart += $product['amount_product'];
								$subtotal += $product['amount_product'] * $product['price'];
								// $total_iva = calculation and sum of all taxes
							}
							// El total va el subtotal sumado con el total_iva
							$total = $subtotal;

							$html_shoppingCart = "";
							if ($option == 1) {
								$html_shoppingCart = Utils::getFileModal('Template/Modals/shoppingCart_modal', $_SESSION['dataCart']);
							}
							$data = array("status" => true, "html_shoppingCart" => $html_shoppingCart, "amountCart" => $amountCart, "subtotal" => Utils::formatMoney($subtotal), "total" => Utils::formatMoney($total));
						}else{
							$data = array("status" => false, "error" => "Ha ocurrido un error. Inténtelo más tarde.");
						}
						echo json_encode($data);
					}
				break;

				case 'logout':
		          	session_unset();
		          	session_destroy();
				break;

				default:
					$data["file_css"][] = "index-store";
					$data["file_js"][] = "index-store"; 
					View::renderPage('Index', $data);
				break;
			}
			
		}
	}

?>