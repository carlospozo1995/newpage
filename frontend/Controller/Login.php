<?php

	class Controller_Login{
		public function buildPage()
		{
			session_start();
		
			if (Utils::isLogged()) {
				header('Location: '.BASE_URL.'Dashboard');
			}

			$action = Utils::getParam("action", "");
			$data = array();
			$msg = "";
			$status = true;

			switch ($action) {
				case 'ajaxLogin':

					$email = Utils::getParam("email", "");
					$password = Utils::getParam("password", "");

					try {
						if (empty($email) || empty($password)) {
							throw new Exception("Verifique si los campos estan llenos.");
						}else{
							$userData = Models_Usuario::getUser($email, sha1($password));

							if (empty($userData)) {
								throw new Exception("El usuario o la contraseña es incorrecto.");
							}else{
								if ($userData['status'] == 1) {
									$_SESSION['idUser'] = $userData['id'];
									$_SESSION['login'] = true;
									$_SESSION['timeout'] = true;
                            		$_SESSION['inicio'] = time();	

                            		$status = true;
                            		$msg = "OK";								
								}
							}
						}
					} catch (Exception $e) {
						$status = false;
						$msg = $e->getMessage();
					}
					$data = array("status"=>$status,"msg"=>$msg);
					echo json_encode($data);

				break;

				case 'ajaxEmailSend':

					$resetEmail = Utils::getParam("resetEmail", "");

					try {
						if (empty($resetEmail)) {
							throw new Exception("Verifique si los campos estan llenos.");
						}else{
							$userEmail = Models_Usuario::getUserEmail($resetEmail);
							if (empty($userEmail)) {
								throw new Exception("El usuario ha recuperar la contraseña no existe.");	
							}else{
								$nameUser = $userEmail['nombres'].' '.$userEmail['apellidos'];
								$token = Utils::encriptar($userEmail['id']."|".date("Y-m-d H:i:s"));
								
								$url_recovery = BASE_URL.'resetPassword/'.$token;

								$dataEmailUser = array( "name" => $nameUser,
														"email" => $resetEmail,
														"asunto" => 'Recuperación de contraseña -'.NAME_EMPRESA,
														"url_recovery" => $url_recovery
													); 

								
								$sendEmail = Utils::sendEmail($dataEmailUser, 'email_reset');

								if ($sendEmail) {
									$arrDataUpStatu['update_status'] = 2;
									Models_Usuario::updateStatuPass($userEmail['id'], $arrDataUpStatu);

									$status = true;
									$msg = "Se ha enviado un mensage a su cuenta de correo para restablecer tu contraseña.";
								}else{
									$status = false;
									throw new Exception("No es posible realizar el proceso intentalo mas tarde.");
								}
								
							}
						}
					} catch (Exception $e) {
						$status = false;
						$msg = $e->getMessage();
					}

					$data = array("status" => $status, "msg" => $msg);
					echo json_encode($data);

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
