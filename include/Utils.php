<?php

	class Utils{

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

		static public function tokenReset()
		{
			$r1 = bin2hex(random_bytes(10));
	        $r2 = bin2hex(random_bytes(10));
	        $r3 = bin2hex(random_bytes(10));
	        $r4 = bin2hex(random_bytes(10));

	        $token = $r1.$r2.$r3.$r4;
	        return $token;
		}

	}

?>