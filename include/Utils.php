<?php
	
	// FILES PHP MAILER - RECOVERY PASSWORD EMAIL //
	require RUTA_INCLUDE.'PHPMailer/src/Exception.php';
	require RUTA_INCLUDE.'PHPMailer/src/PHPMailer.php';
    require RUTA_INCLUDE.'PHPMailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    // ***************************************** //

	class Utils{

		 static public function log($msg,$bypass=false){
          	$filename = dirname(__FILE__). "/log.txt";
          	$fd = fopen($filename, "a");
          	date_default_timezone_set(TIMEZONE);
          	$str = "[" . date("Y/m/d h:i:s") . "] " . $msg;
          	fwrite($fd, $str . "\n");
          	fclose($fd);
        }

		static public function getParam($paramName, $default=false, $data=false)
		{

			// Call var global = GET||POST
			global $_SUBMIT;

			if (!$data) {
				$data = $_SUBMIT;
			}

			if (is_array($data)){      
		        if(isset($data[$paramName])){         
		       		return $data[$paramName];                       
		        }
      		}
	      
	      	return $default;
		}

		static public function isLogged()
		{
			if(isset($_SESSION['idUser'])){
				return true;
			}else{
				return false;
			}
		}

		static public function sessionStart()
		{
		 	session_start();
		 	$timeSession = 7200;

		 	if (isset($_SESSION['timeout'])) {
	 			$session_in = time() - $_SESSION['inicio'];
	 			if ($session_in > $timeSession) {
	 				self::sessionEnd();
	 			}
		 	}else{
		 		self::sessionEnd();
		 	}
		}

		static public function sessionEnd()
		{
			session_start();
          	session_unset();
          	session_destroy();

          	header('Location: '.BASE_URL.'login');
		}

		// EMAIL FUNCTIONS - RECOVER PASSWORD

		static public function tokenReset()
		{
			$r1 = bin2hex(random_bytes(10));
	        $r2 = bin2hex(random_bytes(10));
	        // $r3 = bin2hex(random_bytes(10));
	        // $r4 = bin2hex(random_bytes(10));

	        $token = $r1.$r2;
	        return $token;
		}

		public static function encriptar($texto){      
		    $objaes = new Aes(KEY_ENCRIPTAR);
		    $encriptado = $objaes->encrypt($texto);
		    return bin2hex($encriptado);
		}

		public static function desencriptar($texto){   
		   $objaes = new Aes(KEY_ENCRIPTAR);    
		   $desencriptado = hex2bin($texto);
		   return $objaes->decrypt($desencriptado);
		}
		
		static public function sendEmail($data, $template)
		{	
        	$nameUser = $data['name'];
	        $mailUser = $data['email'];
	        $recovery = $data['url_recovery'];
	        $asunto = utf8_decode($data['asunto']);
        
	        ob_start();
	        require_once(RUTA_VIEW."html/Template/".$template.".php");
	        $message = ob_get_clean();

	        $mail = new PHPMailer();

	        try {
	            //Server settings
	            $mail->SMTPDebug = 0;                      
	            $mail->isSMTP();                                            
	            $mail->Host       = MAIL_HOST;                     
	            $mail->SMTPAuth   = true;                                   
	            $mail->Username   = MAIL_USERNAME;                     
	            $mail->Password   = MAIL_PASSWORD;                               
	            $mail->SMTPSecure = 'ssl';            
	            $mail->Port       = 465;                                    

	            //Recipients
	            $mail->setFrom(MAIL_USERNAME);
	            $mail->addAddress($mailUser, $nameUser);

	            //Attachments
	            // $mail->addAttachment('/var/tmp/file.tar.gz');         
	            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    

	            //Content
	            $mail->isHTML(true);                                  
	            $mail->Subject = $asunto;
	            $mail->Body    = $message;
	            // $mail->AltBody = strip_tags();

	            return $mail->send();
	            
	        } catch (Exception $e) {
	            echo $mail->ErrorInfo;
	        }
		}

		// static public function confirmUser($email_recovery, $token)
		// {
			// if(empty($email_recovery) || empty($token)){
			// 	// header('Location: '.BASE_URL.'login');
			// }else{
			// 	// $arrResponse =  Models_Usuario::getUserResetPass($email_recovery, $token);
			// 	// if(empty($arrResponse)){
			// 		header('Location: '.BASE_URL.'login');	
			// 	// }else{

			// 	// }
			// }
		// }

	}

?>