<?php

	class Models_Roles{

		static public function getRoles()
		{
			$sql = "SELECT * FROM roles WHERE status != ?";
			$result = $GLOBALS["db"]->selectAll($sql, array(0));
			return $result;
		}

		static public function insertRol($data)
		{
			if(empty($data) || !is_array($data)){return false;}

			$name_test;
			$result;

			foreach ($data as $key => $value) {
				$name_test = $value['name_rol'];	
			}

			$sql = "SELECT * FROM roles WHERE name_rol = ?";
			$request = $GLOBALS["db"]->auto_array($sql, array($name_test));
			if (empty($request)) {
				$result = $GLOBALS["db"]->insert_multiple("roles", $data);
			}else{
				$result = "exists_data";
			}
			
			return $result;
		}

		static public function selectRol($data)
		{
			if(empty($data)){return false;}
			$sql = "SELECT * FROM roles WHERE id_rol = ?";
			return $GLOBALS["db"]->auto_array($sql, array($data));
		}

		static public function updateRol($id, $name, $description, $status)
		{	
			$sql = "SELECT * FROM roles WHERE name_rol = ? AND id_rol != ?";
			$request = $GLOBALS["db"]->auto_array($sql, array($name, $id));

			if (empty($request)) {
				if (empty($id)) {return false;}
				$arrData = array("name_rol" => ucfirst($name), "description_rol" => ucfirst($description), "status" => $status);
				$result = $GLOBALS["db"]->update("roles", $arrData, "id_rol='".$id."'");
				return $result;
			}else{
				$result = "exists_data";
			}

			return $result;
		}

		static public function deleteRol($data)
		{
			$sql = "SELECT * FROM users WHERE rolid = ?";
			$request = $GLOBALS["db"]->auto_array($sql, array($data));
			
			if (empty($request)) {
				if (empty($data)) {return false;}
				$status['status'] = 0;
				$request_update =  $GLOBALS["db"]->update("roles", $status, "id_rol='".$data."'");
				
				if($request_update) { $result = "ok"; }
			}else{
				$result = "exists";
			}

			return $result;
		}
	}

?>