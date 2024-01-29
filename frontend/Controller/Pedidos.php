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

                case "statusOrder":
					try {
						if (isset($_POST)) {
							$id_order = Utils::desencriptar($_POST['id_order']);

							if (!empty($id_order)) {
								$request = Models_Pedidos::getStatusOrder($id_order);
							}else{
								throw new Exception("Ha ocurrido un error. Inténtelo de nuevo.");
								die();
							}
						}else{
							throw new Exception("Ha ocurrido un error. Inténtelo de nuevo.");
							die();
						}
					} catch (Exception $e) {
						$status = false;
						$msg = $e->getMessage();
					}
					$data = array("status" => $status, "msg" => $msg, "request" => $request);
					echo json_encode($data);
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