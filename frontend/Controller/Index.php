<?php

	class Controller_Index{
		public function buildPage()
		{	
			session_start();
			$action = Utils::getParam("action", "");
			$data = array();
			switch ($action) {
				case 'logout':
		          	session_unset();
		          	session_destroy();
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