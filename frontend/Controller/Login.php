<?php

	class Controller_Login{
		public function buildPage()
		{
			session_start();
		
			if (Utils::isLogged()) {
				header('Location: '.BASE_URL.'Dashboard');
			}

			$action = Utils::getParam("action", "");

			switch ($action) {
				case 'ajaxLogin':
					
					$email = Utils::getParam("email", "");
					$password = Utils::getParam("password", "");
					
					if (empty($email) || empty($password)) {
						$arrResponse = array('status' => false, 'msg' => 'Verifique si los campos estan llenos.');
					}else{
						$userData = Models_Usuario::getUser($email, sha1($password));
						
						if (empty($userData)) {
							$arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecto.');
						}else{
							$arrUser = $userData;

							if ($arrUser['status'] == 1) {

								$_SESSION['idUser'] = $arrUser['id'];
								$_SESSION['login'] = true;
								$_SESSION['timeout'] = true;
                            	$_SESSION['inicio'] = time();
                            	
                            	$arrResponse = array('status' => true, 'msg' => 'OK');
							}else{
								$arrResponse = array('status' => true, 'msg' => 'El usuario esta inactivo.');
							}
						}
					}

					echo json_encode($arrResponse);

				break;

				case 'ajaxReset':

					$emailReset = Utils::getParam("emailReset", "");

					if (empty($emailReset)) {
						// $arrResponse = array('status' => false, 'msg' => 'Verifique si los campos estan llenos.');
					}else{
						$token = Utils::tokenReset();
						$userEmail = Models_Usuario::getUserEmail($emailReset);
						// print_r($userEmail);
						if (empty($userEmail)) {
							$arrResponse = array('status' => false, 'msg' => 'El usuario ha recuperar la contraseña no existe.');
						}else{
							$idUser = $userEmail['id'];
							$nameUser = $userEmail['nombres'].' '.$userEmail['apellidos'];
						}
					}
				break;
				
				default:

					$data["file_css"][] = "login";
					$data["file_js"][] = "login"; 
					View::renderPage('Login', $data);
				
				break;
			}
		}
	}

?>