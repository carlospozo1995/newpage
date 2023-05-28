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
          	session_unset();
          	session_destroy();
          	header('Location: '.BASE_URL.'login');
		}

		static public function sessionStartStore()
		{
		 	session_start();
		 	$timeSession = 7200;

		 	if (isset($_SESSION['timeout'])) {
	 			$session_in = time() - $_SESSION['inicio'];
	 			if ($session_in > $timeSession) {
	 				self::sessionEndStore();
	 			}
		 	}else{
		 		self::sessionEndStore();
		 	}
		}

		static public function sessionEndStore()
		{
          	session_unset();
          	session_destroy();
			setcookie('PHPSESSID', '', time() - 3600, '/');
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
			if(ctype_xdigit($texto) && strlen($texto) == 32){
				$objaes = new Aes(KEY_ENCRIPTAR);    
		   		$desencriptado = hex2bin($texto);
		   		return $objaes->decrypt($desencriptado);
		   	}else{
		   		return false;
		   	}
		}

		public static function extensiveDecryption($text)
		{
			$objaes = new Aes(KEY_ENCRIPTAR);    
		   	$desencriptado = hex2bin($text);
		   	return $objaes->decrypt($desencriptado);
		}

		public static function encryptStore($text)
		{
			$objaes = new Aes(KEY_ENCRIPTAR);
			$encrypted = bin2hex($objaes->encrypt($text));
			return $encrypted;
		}
		public static function descryptStore($text)
		{
			$objaes = new Aes(KEY_ENCRIPTAR);
			$decrypted = $objaes->decrypt(hex2bin($text));
			return $decrypted;
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

	    static public function getFileModal(string $url, $data)
	    {
	    	ob_start();
	    	require_once(RUTA_VIEW."/html/{$url}.php");
	    	$file = ob_get_clean();
	    	return $file;
	    }

	    static public function permissionsData(int $id_module)
	    {
	    	$id_rol = $_SESSION['data_user']['id_rol'];
	    	$arr_permissions = Models_Permissions::permissionsModule($id_rol);
	    	
			$permissions = "";
	    	$module = "";

	    	if (count($arr_permissions) > 0) {
	            $permissions = $arr_permissions;
	            $module = isset($arr_permissions[$id_module]) ? $arr_permissions[$id_module] : "";
	        }

	        $_SESSION['permissions'] = $permissions;
        	$_SESSION['module'] = $module;
	    }

	    static public function getCategories($arrdata, $parentId = null) {
		    $result = array();
		    foreach ($arrdata as $key => $value) {
		        if ($value['fatherCategory'] == $parentId) {
		            $children = self::getCategories($arrdata, $value['id_category']);
		            if ($children) {
		                $value['sons'] = $children;
		            }
		            $result[] = $value;
		        }
		    }
		    return $result;
		}

	    static public function uploadImage($data)
	    {	
	    	foreach ($data as $key => $value) {
	    		if (!empty($value['tmp_name']) && isset($value['name_upload'])) {
	    			$url_temp = $value['tmp_name'];
	    			$name_img = $value['name_upload'];
	    			
	    			isset($value['file_product']) ? $destination = 'Assets/admin/files/images/upload_products/'.$name_img : $destination = 'Assets/admin/files/images/uploads/'.$name_img;

	    			move_uploaded_file($url_temp, $destination);
	    		}
	    	}
	    }

	    static public function formatMoney($cant)
	    {
	    	return number_format($cant, 2, SPD, SPM);
	    }

	    static  function deleteFile($name){
        	unlink('Assets/admin/files/images/upload_products/'.$name);
    	}

    	static public function replaceVowel($name)
    	{
    		$table = array(
			    'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u', 'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
			);
			$name = strtr($name, $table);
			return $name;
    	}

	}

?>