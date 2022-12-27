<?php

	class Models_Usuario{

		static public function getUser($email, $password)
		{
			$sql = "SELECT id_user, status FROM users WHERE email = ? AND password = ?";			
			$result = $GLOBALS["db"]->auto_array($sql, array($email, $password));
			return $result;
		}

		static public function getUserEmail($emailReset)
		{
			$sql = "SELECT id_user, name_user, surname_user, status FROM users WHERE email = ? AND status = 1";
			$result = $GLOBALS["db"]->auto_array($sql, array($emailReset));
			return $result;
		}

		static public function dataSessionlogin($idUser)
		{
			$sql = "SELECT u.id_user, u.dni, u.name_user, u.surname_user, u.phone, u.email, r.id_rol, r.name_rol, r.status FROM users u INNER JOIN roles r ON u.rolid = r.id_rol WHERE u.id_user = ?";
			$result = $GLOBALS["db"]->auto_array($sql, array($idUser));
			$_SESSION['data_user'] = $result;
			return $result;			 
		}

		static public function updateStatuPass($idUser, $upStatusPass)
		{
			if(empty($idUser) || empty($upStatusPass) || !is_array($upStatusPass)){return false;}
			$result = $GLOBALS["db"]->update("users", $upStatusPass, "id_user='".$idUser."'");
			return $result;
		}

		static public function getUpdateStatu($idUser)
		{
			$sql = "SELECT update_status FROM users WHERE id_user = ? AND status = 1";
			$result = $GLOBALS["db"]->auto_array($sql, array($idUser));
			return $result;
		}

		static public function updatePassword($idUser, $newPassword)
		{
			if(empty($idUser) || empty($newPassword) || !is_array($newPassword)){return false;}
			$result = $GLOBALS["db"]->update("users", $newPassword, "id_user='".$idUser."'");
			return $result;
		}
	}

?>