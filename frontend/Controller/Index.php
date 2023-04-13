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
						$dataCart = array();
						$data_product = "";
						$amountCart = 0;
						$id_product = Utils::desencriptar($_POST['id_product']);
						$amountProduct = $_POST['amount_product'];
						if(!empty($id_product)){
							$arrInfoProd = Models_Store::getProductId($id_product);
							if(!empty($arrInfoProd)){
								$data_product = array('id' => $id_product,
													'code' => $arrInfoProd['code'],
													'name' => $arrInfoProd['name_product'],
													'amount_product' => $amountProduct,
													'precio' => $arrInfoProd['price'],
													'image' => $arrInfoProd['images'][0]['url_image']);
							
								if (isset($_SESSION['dataCart'])) {
									$on = true;
									$dataCart = $_SESSION['dataCart'];

									for ($pr=0; $pr < count($dataCart); $pr++) {
										if($dataCart[$pr]['id'] == $id_product){
											$dataCart[$pr]['amount_product'] += $amountProduct;
											$on = false;
										}
									}

									if($on){
										array_push($dataCart,$data_product);
									}

									$_SESSION['dataCart'] = $dataCart;
								}else{
									array_push($dataCart, $data_product);
									$_SESSION['dataCart'] = $dataCart;
								}
								$data = array($data_product);
							}
						}else{
							$data = array($data_product);
						}
						echo json_encode($data_product);
					}
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