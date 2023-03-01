<?php

	class Controller_Categoria{
		
		public function buildPage()
		{
			$action = Utils::getParam("action", "");
			switch ($action) {
				case ' ':
					return false;
				break;
					
				default:
					$data["file_css"][] = "index-store";
					$data["file_js"][] = "index-store";
					$data["url_categories"] = isset($_GET['urlCategories']) ? explode("/", $_GET['urlCategories']) : "";
					
					View::renderPage('Categoria', $data);
				break;
			}
		}
		
	}

?>