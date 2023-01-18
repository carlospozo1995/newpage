<?php

	class Controller_Categories{

		public function buildPage()
		{
			Utils::sessionStart();
			if (empty($_SESSION['idUser'])) {
				header('Location: '.BASE_URL.'login');
			}

			$action = Utils::getParam("action", "");
			$data = array();
			$msg = "";
			$status = true;
			$request = "";

			switch ($action) {
				case 'listCategories':
					$id_category = Utils::getParam("id_category", "");
					$arr_options = Models_Categories::arrCategories($id_category);
					Utils::optionsCategories($arr_options);
				break;

				default:
					Utils::permissionsData(MCATEGORIAS);

					if (empty($_SESSION['module']['ver'])) {
						header('Location: '.BASE_URL.'Dashboard');	
					}

					// $variable["file_css"][] = "c_roles";
		            $variable["file_js"][] = "f_categories";
					View::renderPage('Categories', $variable);
				break;
			}
		}

	}

?>