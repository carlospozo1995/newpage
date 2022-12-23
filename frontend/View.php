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


			if ($namePage == 'Dashboard') {
				$header_admin  = RUTA_VIEW . 'html/Template/header_admin.php';
				require_once $header_admin;
			}else if($namePage != ('Login' || 'ResetPassword')){
				$header_store  = RUTA_VIEW . 'html/Template/header_store.php';
				require_once $header_store;
			}

			if (file_exists($ruta_page)) {
				require_once $ruta_page;
			}

			if ($namePage == 'Dashboard') {
				$footer_admin  = RUTA_VIEW . 'html/Template/footer_admin.php';
				require_once $footer_admin;
			}else if($namePage != ('Login' || 'ResetPassword')){
				$footer_store  = RUTA_VIEW . 'html/Template/footer_store.php';
				require_once $footer_store;
			}
		}
	}

?>