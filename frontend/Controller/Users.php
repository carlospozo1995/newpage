<?php

	class Controller_Users{

		public function buildPage()
		{
			Utils::sessionStart();
			if (empty($_SESSION['idUser'])) {
				header('Location: '.BASE_URL.'login');
			}

			$action = Utils::getParam("action", "");
			$data = array();
			$msg = "";
			$status = true;
			$request = "";
			// $option = "";

			switch ($action) {
				case ' ':
                    return "";
				break;
				
				default:
					Utils::permissionsData(MUSUARIOS);

					if (empty($_SESSION['module']['ver'])) {
						header('Location: '.BASE_URL.'Dashboard');	
					}

					// $variable["file_css"][] = "c_roles";
		            $variable["file_js"][] = "f_users";
					View::renderPage('Users', $variable);
				break;
			}

			
		}

	}

?>