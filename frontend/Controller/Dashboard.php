<?php

	class Controller_Dashboard{

		public function buildPage()
		{
			Utils::sessionStart();
			if (empty($_SESSION['idUser'])) {
				header('Location: '.BASE_URL.'login');
			}
			View::renderPage('Dashboard', "");
		}

	}

?>