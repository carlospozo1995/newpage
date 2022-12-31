<?php

	class Controller_Roles{

		public function buildPage()
		{
			Utils::sessionStart();
			if (empty($_SESSION['idUser'])) {
				header('Location: '.BASE_URL.'login');
			}

			Utils::permissionsData(MUSUARIOS);

			if (empty($_SESSION['module']['ver'])) {
				header('Location: '.BASE_URL.'Dashboard');	
			}

			// $variable["file_css"][] = "c_roles";
            $variable["file_js"][] = "f_roles";
			View::renderPage('Roles', $variable);
		}

	}

?>