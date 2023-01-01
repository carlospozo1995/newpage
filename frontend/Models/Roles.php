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
				$result = $GLOBALS["db"]->insert_multiple("roles",$data);
			}else{
				$result = "exists_data";
			}
			
			return $result;
		}

	}

?>