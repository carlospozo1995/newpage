<?php

	class Controller_Carrito{
		
		public function buildPage()
		{	
			session_start();
			$data = array();
			$action = Utils::getParam("action", "");
			switch ($action) {
				case ' ':
					return false;
				break;
			
				default:
					// $data["file_js"][] = "producto-store";
					View::renderPage('Carrito', $data);
				break;
			}
		}
	}

?>