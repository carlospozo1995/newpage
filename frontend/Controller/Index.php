<?php

	class Controller_Index{
		public function buildPage()
		{	
			$action = Utils::getParam("action", "");
			$data = array();
			switch ($action) {
				case ' ':
					return false;
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