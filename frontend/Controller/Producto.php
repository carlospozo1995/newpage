<?php

	class Controller_Producto{
		
		public function buildPage()
		{	
			session_start();
			// $data = array();
			// $action = Utils::getParam("action", "");
			// switch ($action) {
			// 	case ' ':
			// 		return false;
			// 	break;
			
				// default:
					// $data["file_js"][] = "producto-store";
					if (isset($_GET['prod_path']) && !empty($_GET['prod_path'])) {
						View::renderPage('Producto');
					}
			// 	break;
			// }
		}
	}

?>