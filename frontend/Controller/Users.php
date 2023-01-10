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
						if (empty($dni) || empty($name) || empty($surname) || empty($phone) || empty($email) || empty($list_rol) || empty($status) || empty($password)) {
							// Utils::dep($dni);
							// Utils::dep($name);
							// Utils::dep($surname);
							// Utils::dep($phone);
							// Utils::dep($email);
							// Utils::dep($list_rol);
							// Utils::dep($status);
							// Utils::dep($password);
							throw new Exception("Rellene todos los campos.");
							
							return false;
						}else{
							$test_email = "/^(([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9])+\.)+([a-zA-Z0-9]{2,4}))*$/";
							$test_pass = "/^(?=.*\d)(?=.*[a-z]).{8,}$/";
							$test_number = "/^([0-9]{7,10})$/";
							$test_text = "/^([a-zA-ZÑñÁáÉéÍíÓóÚú\s])*$/";

							// if (preg_match($test_text, $name) == 0 || preg_match($test_text, $surname) == 0 || preg_match($test_number, $phone) == 0 || preg_match($test_email, $email) == 0 || preg_match($test_pass, $password) == 0) {
							// 	throw new Exception("Verifique si los campos estan llenos de manera correcta.");
							// 	return false;
							// }

							Utils::dep($dni);
							Utils::dep($name);
							Utils::dep($surname);
							Utils::dep($phone);
							Utils::dep($email);
							Utils::dep($list_rol);
							Utils::dep($status);
							Utils::dep($password);
						}
					} catch (Exception $e) {
						$msg = $e->getMessage();
					}

					echo json_encode($msg);
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