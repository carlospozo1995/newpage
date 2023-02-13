<?php

	class View{
		static public function renderPage($namePage, $template_vars = array())
		{
			if(!empty($template_vars)){
				extract($template_vars);
			}

			// ---------- PAGE VARIABLES ----------//
			$title_store  = NAME_EMPRESA. " - Lorem ipsum local.";
			$title_page = NAME_EMPRESA. " - " . $namePage;
			$section_name = $namePage;
			// ---------------------------------- //

			$ruta_page = RUTA_VIEW . 'html/' . $namePage .'.php';	


			if ($namePage == 'Dashboard' || $namePage == 'Roles' || $namePage == 'Users' || $namePage == 'Categories' || $namePage == 'Products') {
				require_once(RUTA_VIEW . 'html/Template/header_admin.php');
			}

			if ($namePage == 'Login' || $namePage == 'ResetPassword') {
				require_once(RUTA_VIEW . 'html/Template/header_unique.php');
			}

			if($namePage == 'Index'){
				require_once(RUTA_VIEW . 'html/Template/header_store.php');
			}

			if (file_exists($ruta_page)) {
				require_once $ruta_page;
			}

			if ($namePage == 'Dashboard' || $namePage == 'Roles' || $namePage == 'Users' || $namePage == 'Categories' || $namePage == 'Products') {
				require_once(RUTA_VIEW . 'html/Template/footer_admin.php');
			}

			if ($namePage == 'Login' || $namePage == 'ResetPassword') {
				require_once(RUTA_VIEW . 'html/Template/footer_unique.php');
			}
			if($namePage == 'Index'){
				require_once(RUTA_VIEW . 'html/Template/footer_store.php');
			}

		}
	}

?>