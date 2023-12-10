<?php

	class Controller_Buscar{
		
		public function buildPage()
		{	
			Utils::sessionStartStore();
			
			$data = array();
			$action = Utils::getParam("action", "");
			switch ($action) {
				case ' ':
                    return false;
                break;
				default:
					// $data["file_js"][] = "categoria-store";
					if (!empty($_GET['data'])) {
						View::renderPage('Buscar');
					}
				break;
			}
		}
		
	}

?>
