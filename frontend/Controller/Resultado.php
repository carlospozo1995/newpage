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
						// print_r(var_dump($_GET['search']));
						// View::renderPage('Resultado');
						// // $regexString = '/^(?:\w+-\w+|\w+)$/';
						$regexString  = '/^\w+(?:-\w+)*(?:\s\w+(?:-\w+)*)*$/';
						
						if (preg_match($regexString, $_GET['search'])) {
							
							// View::renderPage('Resultado');
							$search = explode('-', $_GET['search']);
							if (count($search) < 3) {
								View::renderPage('Resultado', $search);
							}else{
								header('Location: '.BASE_URL);
							}
						}else{
							header('Location: '.BASE_URL);
						}
						
					}
				break;
			}
		}
		
	}

?>


