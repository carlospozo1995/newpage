<?php

	class Controller_Index{
		public function buildPage()
		{	
			$action = Utils::getParam("action", "");
			switch ($action) {
				case 'loadMore':
					// Recuperar los siguientes tres productos
					$products = Models_Store::getProductsLimit($_POST['start'], $_POST['perLoad']);

					// Cargar la plantilla HTML
					$output = "";
					foreach ($products as $product) {

					    $output .= '<div style="border:1px solid blue;width: max-content">';
						$output .=	'<p>'.$product['name_product'].'</p>';
						$output .=	'<p>'.$product['price'].'</p>';
						$output .= '</div>';	
					}
					echo $output;

				break;
				
				default:
					$data["file_css"][] = "index-store";
					$data["file_js"][] = "index-store"; 
					View::renderPage('Index', $data);
				break;
			}
			
		}
	}

?>