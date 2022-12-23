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

		static public function updateStatuPass($idUser, $upStatusPass)
		{
			if(empty($idUser) || empty($upStatusPass) || !is_array($upStatusPass)){return false;}
			$result = $GLOBALS["db"]->update("usuario", $upStatusPass, "id='".$idUser."'");
			return $result;
		}

		static public function getUpdateStatu($idUser)
		{
			$sql = "SELECT update_status FROM usuario WHERE id = ? AND status = 1";
			$result = $GLOBALS["db"]->auto_array($sql, array($idUser));
			return $result;
		}

		static public function updatePassword($idUser, $newPassword)
		{
			if(empty($idUser) || empty($newPassword) || !is_array($newPassword)){return false;}
			$result = $GLOBALS["db"]->update("usuario", $newPassword, "id='".$idUser."'");
			return $result;
		}
	}

?>