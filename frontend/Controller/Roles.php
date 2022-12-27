<?php

	class Controller_Roles{

		public function buildPage()
		{
			Utils::sessionStart();
			if (empty($_SESSION['idUser'])) {
				header('Location: '.BASE_URL.'login');
			}

			// $variable["file_css"][] = "c_roles";
            $variable["file_js"][] = "f_roles";
			View::renderPage('Roles', $variable);
		}

	}

?>