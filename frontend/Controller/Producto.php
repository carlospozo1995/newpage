<?php

	class Controller_Producto{
		
		public function buildPage()
		{	
			$data = array();
			$action = Utils::getParam("action", "");
			switch ($action) {
				case ' ':
					return false;
				break;
			
				default:
					$data["file_js"][] = "producto-store";
					if (!empty($_GET['prod_path'])) {
						View::renderPage('Producto', $data);
					}
				break;
			}
		}
	}

?>