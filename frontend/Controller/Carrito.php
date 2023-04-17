<?php

	class Controller_Carrito{
		
		public function buildPage()
		{	
			session_start();
			$data = array();
			$action = Utils::getParam("action", "");
			switch ($action) {
				case 'updateProductPrice':
					if(isset($_POST)){
						$id_product = Utils::desencriptar($_POST['id']);
						$amountProduct = $_POST['amount'];
						// echo json_encode($id_product."+++",$amountProduct);
						echo json_encode("...");
					}
				break;
			
				default:
					// $data["file_js"][] = "producto-store";
					View::renderPage('Carrito', $data);
				break;
			}
		}
	}

?>