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
							}else{
								$option	= 2;
								$request = Models_Roles::updateRol(Utils::desencriptar($id_rol), $name_rol, $descrip_rol, $status_rol);
							}

							if ($request > 0) {
								if ($option == 1) {
									$status = true;
									$msg = "Datos ingresados correctamente.";
									$data_request = array("id_request" => Utils::encriptar(strval($request)), "id_user" => $_SESSION['idUser']); 
								}else{
									$status = true;
									$msg = "Datos actualizados correctamente";
									$data_request = "";
								}
							}else if($request == "exists_data"){
								throw new Exception("El rol a ingresar ya existe. Intentelo de nuevo.");								
							}else{
								throw new Exception("Ha ocurrido un error. Intentelo mas tarde.");
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

				case 'getRol':
					if (empty(Utils::getParam("data", ""))) {
						return false;
					}else{
						$id_rol = Utils::desencriptar(Utils::getParam("data", ""));

						try {
							$data_rol = Models_Roles::selectRol($id_rol);
							if (!empty($data_rol)) {
								$status = true;
								$msg = "";
								$data_request = array("id_rol" => Utils::encriptar($data_rol["id_rol"]), "name_rol" => $data_rol["name_rol"], "description_rol" => $data_rol["description_rol"], "status" => $data_rol["status"]);
							}else{
								throw new Exception("Ha ocurrido un error. Intentelo mas tarde.");
							}
						} catch (Exception $e) {
							$status = false;
							$msg = $e->getMessage();
							$data_request = "";
						}
						$data = array("status" => $status,"msg" => $msg, "data_request" => $data_request);
						echo json_encode($data);
					}
				break;

				case 'delRol':
					if (empty(Utils::getParam("data", ""))) {
						return false;
					}else{
						$id_rol = Utils::desencriptar(Utils::getParam("data", ""));
						try {
							$delRol = Models_Roles::deleteRol($id_rol);

							if ($delRol == "ok") {
								$status = true;
								$msg = "Se ha eliminado el rol con existo.";
							}else if ($delRol == "exists") {
								throw new Exception("No es posible elimininar un rol asociado a un usuario.");
							}else{
								throw new Exception("Ha ocurrido un error. Intentelo mas tarde.");
							}
						} catch (Exception $e) {
							$status = false;
							$msg = $e->getMessage();
						}

						$data = array("status" => $status,"msg" => $msg);
						echo json_encode($data);
					}
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