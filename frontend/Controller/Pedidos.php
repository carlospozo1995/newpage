<?php

	class Controller_Pedidos{

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

                case " ":
                    return false;
                break;

				default:
					Utils::permissionsData(MPEDIDOS);

					if (empty($_SESSION['module']['ver'])) {
						header('Location: '.BASE_URL.'Dashboard');	
					}

		            $variable["file_js"][] = "f_pedidos";
                    View::renderPage('Pedidos', $variable);
				break;

			}
		}

	}