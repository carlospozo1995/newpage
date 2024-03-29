<?php

	class Controller_Login{
		public function buildPage()
		{	
			session_start();
			if (isset($_SESSION['idUser'])) {
				header('Location: '.BASE_URL.'Dashboard');
			}else{
				setcookie('PHPSESSID', '', time() - 7200, '/');
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
							die();
						}else{
							$userData = Models_Usuario::getUser($email, sha1($password));
							
							if (empty($userData)) {
								throw new Exception("Verifique si el correo o la contraseña son correctos.");
								die();
							}else{
								if ($userData['status'] == 1) {
									$_SESSION['idUser'] = $userData['id_user'];
									$_SESSION['login'] = true;
									$_SESSION['timeout'] = true;
                            		$_SESSION['inicio'] = time();	
                            		session_regenerate_id(true);
                            		Models_Usuario::dataSessionlogin($_SESSION['idUser']); 
									// Models_Usuario::updateStatuPass($_SESSION['idUser'], array('update_status' => 1));
                            		// $user = array(
                            		// 	'identificacion' => $_SESSION['data_user']['dni'],
                            		// 	'nombre' => $_SESSION['data_user']['name_user'],
                            		// 	'apellido' => $_SESSION['data_user']['surname_user'],
                            		// 	'telefono' => $_SESSION['data_user']['phone'],
                            		// 	'correo' => $_SESSION['data_user']['email']
                            		// );
                            		$status = true;
                            		$msg = "OK";								
								}else{
									throw new Exception("Lo sentimos su cuenta a sido desactivada. Solicite ayuda a " . NAME_EMPRESA);
									die();
								}
							}
						}
					} catch (Exception $e) {
						// $user = "";
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
							die();
						}else{
							$userEmail = Models_Usuario::getUserEmail($resetEmail);
							if (empty($userEmail)) {
								throw new Exception("El usuario ha recuperar la contraseña no existe o esta inactivo.");	
								die();
							}else{
								$nameUser = $userEmail['name_user'].' '.$userEmail['surname_user'];
								$token = Utils::encriptar($userEmail['id_user']."|".date("Y-m-d H:i:s"));
								
								$url_recovery = BASE_URL.'resetPassword/'.$token;

								$dataEmailUser = array( "name" => $nameUser,
														"email" => $resetEmail,
														"asunto" => 'Recuperación de contraseña - '.NAME_EMPRESA,
														"url_recovery" => $url_recovery
													); 
								
								$sendEmail = Utils::sendEmail($dataEmailUser, 'email_reset');
								
								if ($sendEmail) {
									$arrDataUpStatu['update_status'] = 2;
									Models_Usuario::updateStatuPass($userEmail['id_user'], $arrDataUpStatu);

									$status = true;
									$msg = "Se ha enviado un mensage a su cuenta de correo para restablecer tu contraseña.";
								}else{
									throw new Exception("No es posible realizar el proceso intentalo mas tarde.");
									die();
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
