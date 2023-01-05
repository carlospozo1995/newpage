<?php

	class Models_Permissions{

		static public function getRol($idRol)
		{
			$sql = "SELECT * FROM roles WHERE id_rol = ?";
			$request = $GLOBALS["db"]->auto_array($sql, array($idRol));
			
			!empty($request) ? $result = $request : $result = "error"; 
			return $result;
		}

		static public function getAllModules()
		{
			$sql = "SELECT * FROM modules WHERE status != ?";
			$result = $GLOBALS["db"]->selectAll($sql, array(0));
			return $result;
		}

		static public function getPermissionsRol($idRol)
		{
			$sql = "SELECT * FROM permissions WHERE rol_id = ?";
			$result = $GLOBALS["db"]->selectAll($sql, array($idRol));
			return $result;
		}

		static public function deletePermission($idRol)
		{
			if(empty($idRol)){ return false; }
			$result = $GLOBALS["db"]->delete("permissions", "rol_id=".$idRol."");
			return $result;
		}

		static public function insertPermissions($data)
		{
			if(empty($data) || !is_array($data)){return false;}
			return $GLOBALS["db"]->insert_multiple("permissions",$data);
		}

		static public function permissionsModule($idRol)
		{
			$sql = "SELECT p.rol_id, p.module_id, m.name_module AS modulo, p.ver, p.crear, p.actualizar, p.eliminar FROM permissions p INNER JOIN modules m ON p.module_id = m.id_module WHERE p.rol_id = ? ";
			$result = $GLOBALS["db"]->selectAll($sql, array($idRol));
			
			$newArrPermissions = array();

			for ($i=0; $i < count($result); $i++) { 
				$newArrPermissions[$result[$i]['module_id']] = $result[$i];
			}

			return $newArrPermissions;
		}
	}