<?php

	class Controller_Permissions{
		
		public function buildPage()
		{
			$action = Utils::getParam("action", "");
			switch ($action) {
				case 'getPermissions':
					$id_rol = Utils::desencriptar(Utils::getParam("data", ""));

					if ($id_rol > 0) {

						// Required role data
						$data_rol = Models_Permissions::getRol($id_rol);
						
						// Module table data
						$data_modules = Models_Permissions::getAllModules();
						
						//Permissions table data(empty)
						$data_permissions = Models_Permissions::getAllPermissions($id_rol);

						// -------------------- //
						$arr_permissions = array('ver' => 0, 'crear' => 0, 'actualizar' => 0, 'eliminar' => 0);
                		$arrData_Modal = array("idRol" => $id_rol);
                		// -------------------- //

                		if (empty($data_permissions)) {
                			for ($i=0; $i < count($data_modules) ; $i++) { 
                				$data_modules[$i]['permissions'] = $arr_permissions;
                			}
                		}

                		$arrData_Modal['modules'] = $data_modules;
                		$arrData_Modal['rol'] = $data_rol;

                		echo Utils::loadModalFile("permissions", $arrData_Modal);
					}
				break;
				
			}
		}

	}

?>