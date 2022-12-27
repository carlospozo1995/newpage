<?php

	class Models_Permissions{

		static public function getRol($idRol)
		{
			$sql = "SELECT * FROM roles WHERE id_rol = ?";
			$result = $GLOBALS["db"]->auto_array($sql, array($idRol));
			return $result;
		}

		static public function getAllModules()
		{
			$sql = "SELECT * FROM modules WHERE status != ?";
			$result = $GLOBALS["db"]->selectAll($sql, array(0));
			return $result;
		}

		static public function getAllPermissions($idRol)
		{
			$sql = "SELECT * FROM permissions WHERE rol_id = ?";
			$result = $GLOBALS["db"]->selectAll($sql, array($idRol));
			return $result;
		}

	}

?>