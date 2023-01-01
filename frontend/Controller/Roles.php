<?php

	class Controller_Roles{

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
			// $option = "";

			switch ($action) {
				case 'setRol':

					$id_rol = Utils::getParam("id", "");
					$name_rol = Utils::getParam("name", "");
					$descrip_rol = Utils::getParam("description", "");
					$status_rol = Utils::getParam("status", "");

					try {
						if (empty($name_rol) || empty($descrip_rol) || empty($status_rol)){
							throw new Exception("Rellene todos los campos.");
						}else{
							if (empty($id_rol)) {
								$option	= 1;
								$arrData[] = array("name_rol" => ucfirst($name_rol), "description_rol" => ucfirst($descrip_rol), "status" => $status_rol); 
								$request = Models_Roles::insertRol($arrData);
							}

							if ($request > 0) {
								if ($option == 1) {
									$status = true;
									$msg = "Datos ingresados correctamente";
									$data_request = array("id_request" => Utils::encriptar(strval($request)), "id_user" => $_SESSION['idUser']); 
								}
							}else if($request == "exists_data"){
								throw new Exception("El rol a ingresar ya existe. Intentelo de nuevo.");								
							}
						}
						
					} catch (Exception $e) {
						$status  = false;
						$msg = $e->getMessage();
						$data_request = "";
					}

					$data = array("status"=>$status,"msg"=>$msg, "data_request" => $data_request);
					echo json_encode($data);

				break;
				
				default:
					Utils::permissionsData(MUSUARIOS);

					if (empty($_SESSION['module']['ver'])) {
						header('Location: '.BASE_URL.'Dashboard');	
					}

					// $variable["file_css"][] = "c_roles";
		            $variable["file_js"][] = "f_roles";
					View::renderPage('Roles', $variable);
				break;
			}

			
		}

	}

?>