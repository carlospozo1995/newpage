<?php

	class View{
		static public function renderPage($namePage, $template_vars = array())
		{
			if(!empty($template_vars)){
				extract($template_vars);
			}

			// ---------- PAGE VARIABLES ----------//
			$name_empresa  = "EMPRESA";
			$title_page = "EMPRESA - " . $namePage;
			$section_name = $namePage;
			// ---------------------------------- //

			$ruta_page = RUTA_VIEW . 'html/' . $namePage .'.php';	


			if ($namePage == 'Dashboard' || $namePage == 'Roles' || $namePage == 'Users') {
				require_once(RUTA_VIEW . 'html/Template/header_admin.php');
			}

			if ($namePage == 'Login' || $namePage == 'ResetPassword') {
				require_once(RUTA_VIEW . 'html/Template/header_unique.php');
			}

			if (file_exists($ruta_page)) {
				require_once $ruta_page;
			}

			if ($namePage == 'Dashboard' || $namePage == 'Roles' || $namePage == 'Users') {
				require_once(RUTA_VIEW . 'html/Template/footer_admin.php');
			}

			if ($namePage == 'Login' || $namePage == 'ResetPassword') {
				require_once(RUTA_VIEW . 'html/Template/footer_unique.php');
			}

		}
	}

?>