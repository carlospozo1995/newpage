<?php

	class Controller_Users{

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
				case 'setUser':
                    $id = Utils::getParam("id", "");
                    $dni = Utils::getParam("dni", "");
					$name = Utils::getParam("name", "");
					$surname = Utils::getParam("surname", "");
					$phone = Utils::getParam("phone", "");
					$email = Utils::getParam("email", "");
					$list_rol = Utils::getParam("list_rol", "");
					$status = Utils::getParam("status", "");
					$password = Utils::getParam("password", "");

					try {
						if (empty($dni) || empty($name) || empty($surname) || empty($phone) || empty($email) || empty($list_rol) || empty($status)) {
							throw new Exception("Rellene todos los campos.");
							die();
						}else{
							$test_email = "/^(([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9])+\.)+([a-zA-Z0-9]{2,4}))*$/";
							$test_pass = "/^(?=.*\d)(?=.*[a-z]).{8,}$/";
							$test_number = "/^([0-9]{7,10})$/";
							$test_text = "/^([a-zA-ZÑñÁáÉéÍíÓóÚú\s])*$/";

							if (!preg_match($test_text, $name) || !preg_match($test_text, $surname) || !preg_match($test_number, $phone) || !preg_match($test_email, $email)) {
								die();
							}

							if(empty($id)){
								$option = 1;

								if (empty($password)) {
									throw new Exception("Rellene todos los campos.");
									die();
								}else{
									!preg_match($test_pass, $password) ? die() : $password = $password;
								}

								if (!empty($_SESSION['module']['crear'])) {
									$request = Models_Users::insertUser($dni, $name, $surname, $phone, $email, sha1($password), Utils::desencriptar($list_rol), $status);
								}
							}else{
								$option = 2;

								if (empty($password)) {
									$password = $password;
								}else{
									!preg_match($test_pass, $password) ? die() : $password = sha1($password);
								}

								if (!empty($_SESSION['module']['actualizar'])) {
									$request = Models_Users::updateUser(Utils::desencriptar($id), $dni, $name, $surname, $phone, $email, $password, Utils::desencriptar($list_rol), $status);
								}
							}

							if ($request > 0) {
								if ($option == 1) {
									$status = true;
									$msg = "Datos ingresados correctamente.";
									$data_request = array("idr_decrypt" => strval($request), "idr_encrypt" => Utils::encriptar(strval($request)), "id_user" => $_SESSION['idUser'], "module" => $_SESSION['module']);
								}else{
									$status = true;
									$msg = "Datos actualizados correctamente";
									$data_request = "";
								}
							}else if($request == "both_exist"){
								throw new Exception("La identificación y el correo ingresados ya existen. Inténtelo de nuevo.");
								die();
							}else if($request == "dni_exist"){
								throw new Exception("La identificación ingresada ya existe. Inténtelo de nuevo.");
								die();
							}else if($request == "email_exist"){
								throw new Exception("El correo ingresado ya existe. Inténtelo de nuevo.");
								die();
							}else{
								throw new Exception("Ha ocurrido un error. Inténtelo mas tarde.");
								die();
							}
						}
					} catch (Exception $e) {
						$status = false;
						$msg = $e->getMessage();
						$data_request = "";
					}

					$data = array("status" => $status,"msg" => $msg, "data_request" => $data_request);
					echo json_encode($data);
				break;
				
				case 'getUser':

					if (empty(Utils::getParam("data", ""))) {
						die();
					}else{
						$id_user = Utils::desencriptar(Utils::getParam("data", ""));
						
						try {
							$data_user = Models_Users::selectUser($id_user);
							if (!empty($data_user)) {
								$status = true;
								$msg = "";
								$data_request = array("id_user" => Utils::encriptar($data_user["id_user"]), "dni" => $data_user["dni"], "name_user" => $data_user["name_user"], "surname_user" => $data_user["surname_user"], "phone" => $data_user["phone"], "email" => $data_user["email"], "rolid" => Utils::encriptar($data_user["rolid"]), "date_create" => $data_user["date_create"], "name_rol" => $data_user["name_rol"], "status" => $data_user["status"]);
							}else{
								throw new Exception("Ha ocurrido un error. Intentelo mas tarde.");
								die();
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

				case 'delUser':
					if (empty(Utils::getParam("data", ""))) {
						die();
					}else{
						$id_user = Utils::desencriptar(Utils::getParam("data", ""));
						try {
							$delUser = Models_Users::deleteUser($id_user);

							if ($delUser == "ok") {
								$status = true;
								$msg = "Se ha eliminado el usuario con exito.";
							}else{
								throw new Exception("Ha ocurrido un error. Intentelo mas tarde.");
								die();
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
		            $variable["file_js"][] = "f_users";
					View::renderPage('Users', $variable);
				break;
			}
		}

	}

?>