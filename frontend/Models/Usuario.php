<?php

	class Models_Usuario{

		static public function getUser($email, $password)
		{
			$sql = "SELECT id, status FROM usuario WHERE email = ? AND password = ? AND status = 1";			
			$result = $GLOBALS["db"]->auto_array($sql, array($email, $password));
			return $result;
		}

		static public function getUserEmail($emailReset)
		{
			$sql = "SELECT id, nombres, apellidos, status FROM usuario WHERE email = ? AND status = 1";
			$result = $GLOBALS["db"]->auto_array($sql, array($emailReset));
			return $result;
		}

	}

?>