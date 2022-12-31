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

        static public function dep($data){
	        $format = print_r('<pre>');
	        $format .= print_r($data);
	        $format .= print_r('</pre>');
        	return $format;
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

		// static public function fileHeader($namePage)
		// {	
		// 	$fileHeaderAdmin = "";
		// 	switch ($namePage) {
		// 		case '':
					
		// 		break;
				
		// 		default:
					
		// 		break;
		// 	}
		// }

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

		static public function date(){
	        $day = date("d");
	        $month = date("m");
	        $year = date("Y");

	        $day_week = [
	            "Monday"=>"Lunes",
	            "Tuesday"=>"Martes",
	            "Wednesday"=>"Miercoles",
	            "Thursday"=>"Jueves",
	            "Friday"=>"Viernes",
	            "Saturday"=>"Sabado",
	            "Sunday"=>"Domingo",
	        ];

	        $month_year = [
	            "01"=>"Enero",
	            "02"=>"Febrero",
	            "03"=>"Marzo",
	            "04"=>"Abril",
	            "05"=>"Mayo",
	            "06"=>"Junio",
	            "07"=>"julio",
	            "08"=>"Agosto",
	            "09"=>"Septiembre",
	            "10"=>"Octubre",
	            "11"=>"Noviembre",
	            "12"=>"Diciembre",
	        ];

	        $final_date = $day_week[date("l")]." ".$day." de ".$month_year[$month]." del ".$year."<br>".date("g:i a");
	        return$final_date;
	    }

	    static public function loadModalFile($name_modal="", $data_modal="")
	    {
	    	if (!empty($name_modal)) {
	    		$file_modal = RUTA_VIEW . 'html/Template/Modals/' . $name_modal . '_modal.php';
	    		file_exists($file_modal) ? require_once($file_modal) : ""; 
	    	}
	    }

	    static public function permissionsData(int $id_module)
	    {
	    	$id_rol = $_SESSION['data_user']['id_rol'];
	    	$arr_permissions = Models_Permissions::permissionsModule($id_rol);
	    	// Utils::dep($arr_permissions);

	    	$permissions = "";
	    	$module = "";

	    	if (count($arr_permissions) > 0) {
	            $permissions = $arr_permissions;
	            $module = isset($arr_permissions[$id_module]) ? $arr_permissions[$id_module] : "";
	        }

	        $_SESSION['permissions'] = $permissions;
        	$_SESSION['module'] = $module;
	    }

	}

?>