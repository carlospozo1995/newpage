<?php

	class Controller_Categoria{
		
		public function buildPage()
		{	

			$action = Utils::getParam("action", "");
			switch ($action) {
				case 'loadProducts':
					echo json_encode($_POST['category']);
				break;
					
				default:
					$data["file_js"][] = "categoria-store";
					if (!empty($_GET['urlData'])) {
						View::renderPage('Categoria', $data);
					}
				break;
			}
		}
		
	}

?>