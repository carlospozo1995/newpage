<?php

	class Controller_Index{
		public function buildPage()
		{	
			session_start();
			$action = Utils::getParam("action", "");
			$data = array();
			$status = true;
			$msg = "";
			switch ($action) {
				case 'logout':
		          	session_unset();
		          	session_destroy();
				break;
				case 'registerClient':
					if($_POST){
						$name = $_POST['name_client'];
						$surname = $_POST['surname_client'];
						$phone = $_POST['phone_client'];
						$email = $_POST['email_client'];
						$password = $_POST['password_client'];
					
						try {
							if(empty($name) || empty($surname) || empty($phone) || empty($email) || empty($password)){
								throw new Exception("Por favor rellene todos los campos.");
								die();
							}else{
								$test_email = "/^(([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9])+\.)+([a-zA-Z0-9]{2,4}))*$/";
								$test_password = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/";
								$test_phone = "/^\d{7}(?:\d{3})?$/";
								$test_text = "/^([a-zA-ZÑñÁáÉéÍíÓóÚú\s])*$/";

								if (!preg_match($test_text, $name) || !preg_match($test_text, $surname) || !preg_match($test_phone, $phone) || !preg_match($test_email, $email) || !preg_match($test_password, $password)) {
									throw new Exception("Ha ocurrido un error al ingresar los datos. Intentelo más tarde.");
									die();
								}else{
									$request = Models_Store::insertClient($name, $surname, $phone, $email, sha1($password));
									if($request > 0 && is_numeric($request)){
										$_SESSION['idUser'] = $request;
										$_SESSION['login'] = true;
										$_SESSION['timeout'] = true;
										$_SESSION['inicio'] = time();
										Models_Usuario::dataSessionlogin($request);
										
										$status = true;
										$msg = "";
									}else{
										throw new Exception("El correo ingresado ya existe. Inténtelo de nuevo.");
										die();
									}
								}
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
					$data["file_css"][] = "index-store";
					$data["file_js"][] = "index-store"; 
					View::renderPage('Index', $data);
				break;
			}
		}
	}

?>