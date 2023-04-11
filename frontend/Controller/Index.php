<?php

	class Controller_Index{
		public function buildPage()
		{	
			$action = Utils::getParam("action", "");
			$data = array();
			switch ($action) {
				case 'addCartProduct':
					if($_POST){
						$amountCart = 0;
						$id_product = Utils::desencriptar($_POST['id_product']);
						$amountProduct = $_POST['amount_product'];
						$data = "";
						if(!empty($id_product)){
							$arrInfoProd = Models_Store::getProductId($id_product);
						}else{
							// $data = "eror";
						}
						echo json_encode($arrInfoProd);
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