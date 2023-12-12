<?php

	class Controller_Resultado{
		
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
					if (!empty($_GET['search'])) {
								View::renderPage('Resultado');
						// $regexString = '/^(?:\w+-\w+|\w+)$/';
						// $regexString  = '/^(\w+(\+\w+)*(-\w+(\+\w+)*)*|\w+)$/';
						// if (preg_match($regexString, $_GET['search'])) {	
						// 	$search = explode('-', $_GET['search']);
						// 	View::renderPage('Resultado', $search);
						// }else{
						// 	header('Location: '.BASE_URL);
						// }
						
					}
				break;
			}
		}
		
	}

?>
