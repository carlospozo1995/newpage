<?php

	class Controller_Dashboard{

		public function buildPage()
		{
			Utils::sessionStart();
			if (empty($_SESSION['idUser'])) {
				header('Location: '.BASE_URL.'login');
			}

			Utils::permissionsData(1);
			Utils::dep("local");

			$variable["file_css"][] = "c_dashboard";
            $variable["file_js"][] = "f_dashboard";
			View::renderPage('Dashboard', $variable);
		}

	}

?>