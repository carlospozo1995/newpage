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

			// ---------- MODIFY URL ----------//
			$current_url = preg_replace('/\/{2,}/', '/', $_SERVER['REQUEST_URI']);
			$current_url = preg_replace('/\/+$/', '', $current_url);

			if("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] != BASE_URL){
				if ($current_url != $_SERVER['REQUEST_URI']){
					header("Location: " . $current_url, true, 301);
					exit();
				}
			}
			// ---------------------------------- //

			// ---------- CODIGO DE ARRIBA PERO MODIFICADO PARA EL SERVER ----------//
			// if($section_name != 'Index'){
		    //     // ---------- MODIFY URL ----------//
    		// 	$current_url = preg_replace('/\/{2,}/', '/', $_SERVER['REQUEST_URI']);
    		// 	$current_url = preg_replace('/\/+$/', '', $current_url);
    
    		// 	if("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] != BASE_URL){
    		// 		if ($current_url != $_SERVER['REQUEST_URI']){
    		// 			header("Location: " . $current_url, true, 301);
    		// 			exit();
    		// 		}
    		// 	}
    		// 	// ---------------------------------- //
		    // }else{
            //     // Obtener la URL actual
            //     $currentUrlMain = $_SERVER['REQUEST_URI'];
                
            //     // Verificar si la URL tiene múltiples diagonales al final
            //     if (substr($currentUrlMain, -2) === '//') {
            //         // Reemplazar las diagonales múltiples por una sola diagonal
            //         $correctUrl = rtrim($currentUrlMain, '/') . '/';
                
            //         // Generar la URL completa
            //         $redirectUrl = 'https://' . $_SERVER['HTTP_HOST'] . $correctUrl;
                
            //         // Redirigir al usuario a la nueva URL
            //         header('Location: ' . $redirectUrl);
            //         exit();
            //     }
		    // }

			$ruta_page = RUTA_VIEW . 'html/' . $namePage .'.php';	

			if ($namePage == 'Dashboard' || $namePage == 'Roles' || $namePage == 'Users' || $namePage == 'Categories' || $namePage == 'Products') {
				require_once(RUTA_VIEW . 'html/Template/header_admin.php');
			}

			if ($namePage == 'Login' || $namePage == 'ResetPassword') {
				require_once(RUTA_VIEW . 'html/Template/header_unique.php');
			}

			if($namePage == 'Index' || $namePage == 'Test' || $namePage == 'Categoria' || $namePage == 'Producto' || $namePage == 'Carrito' || $namePage == 'Payment' || $namePage == 'Confirmarcompra'){
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
			if($namePage == 'Index' || $namePage == 'Test' || $namePage == 'Categoria' || $namePage == 'Producto' || $namePage == 'Carrito' || $namePage == 'Payment' || $namePage == 'Confirmarcompra'){
				require_once(RUTA_VIEW . 'html/Template/footer_store.php');
			}

		}
	}

?>