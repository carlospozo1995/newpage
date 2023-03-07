<?php

	class Controller_Categoria{
		
		public function buildPage()
		{
			$action = Utils::getParam("action", "");
			switch ($action) {
				case ' ':
					return false;
				break;
				// case 'loadProducts':
				//     if(isset($_POST['category'])){
				//         $category = $_POST['category'];
				//         echo $category;
				//         // $id = Models_Store::getCategory($category);
				//         // echo $id;
				//         // $sons = Models_Categories::dataSons(end($id_end));
				//         // $id_sons = "";
				//         // die();
				//         // foreach ($sons as $data) {
				//         //     $id_sons .= Utils::desencriptar($data["id_son"]) . ",";
				//         // }
				//         // $id_sons = rtrim($id_sons, ",");
				//         // $id_sons = !empty($id_sons) ? $id_sons : end($id_end);
				//         // $products = Models_Store::getProducts("$id_sons");
				//     }
				// break;
					
				default:
					$data["file_css"][] = "index-store";
					$data["file_js"][] = "index-store";
					$data["url_categories"] = isset($_GET['urlCategories']) ? explode("/", $_GET['urlCategories']) : "";
					
					View::renderPage('Categoria', $data);
				break;
			}
		}
		
	}

?>