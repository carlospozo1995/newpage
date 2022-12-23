
<?php

	class Controller_ResetPassword{
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
				case 'updatePassword':
		
					try {
						if (empty($_SESSION['id_user_token']) || empty($_SESSION['time_token'])) {
							throw new Exception("Error de datos. Intentelo mas tarde.");
						}else{
							$pass = Utils::getParam("password", "");
							$confirmPass = Utils::getParam("confirmPassword", "");

							if (empty($pass) || empty($confirmPass)) {
								throw new Exception("Rellene los campos requeridos.");
							}else{
								if (preg_match("/^(?=.*\d)(?=.*[a-z]).{8,}$/", $pass) == 0) {
									throw new Exception("La contraseña debe contener números y letras con un mínimo de 8 caracteres.");
								}

								if ($pass != $confirmPass) {
									throw new Exception("La contraseñas deben ser iguales.");	
								}
								
								$arrPassUpdate['password'] = sha1($pass);
								$arrPassUpdate['update_status'] = 1;

								$updatePass = Models_Usuario::updatePassword($_SESSION['id_user_token'], $arrPassUpdate);

								if ($updatePass) {
									$status = true;
									$msg = "Contraseña actualizada correctamente";
								}else{
									throw new Exception("No es posible realizar el proceso intentelo mas tarde.");
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
				
				default:
					$tokenDecrypt = Utils::desencriptar($_GET['token']);
					$arr_token = explode("|", $tokenDecrypt);

					if (empty($arr_token) || count($arr_token) != 2) {
						header('Location: '.BASE_URL.'login');
					}else{
						$idToken = $arr_token[0];
						$time_token = $arr_token[1];

						$dataUpdateStatu = Models_Usuario::getUpdateStatu($idToken);

						$add_time = strtotime("+ 1 hour", strtotime($time_token));
						$current_time = strtotime(date("Y-m-d H:i:s"));

						if ($add_time < $current_time || $dataUpdateStatu['update_status'] == 1) {
							header('Location: '.BASE_URL.'login');	
						}else{
							$_SESSION['id_user_token'] = $arr_token[0];
							$_SESSION['time_token'] = $arr_token[1];
							View::renderPage('ResetPassword', "");
						}
					}
				break;
			}
		}
	}

?>