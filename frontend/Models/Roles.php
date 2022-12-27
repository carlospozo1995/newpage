<?php

	class Models_Roles{

		static public function getRoles()
		{
			$sql = "SELECT * FROM roles WHERE status != ?";
			$result = $GLOBALS["db"]->selectAll($sql, array(0));
			return $result;
		}

	}

?>