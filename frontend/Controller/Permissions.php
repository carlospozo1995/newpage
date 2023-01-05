<?php

	class Controller_Permissions{
		
		public function buildPage()
		{
			$action = Utils::getParam("action", "");
			$data = array();
			$msg = "";
			$status = true;

			switch ($action) {

				case 'getPermissions':
				
					if (empty(Utils::getParam("data", ""))) {
						return false;
					}else{
						$id_rol = Utils::desencriptar(Utils::getParam("data", ""));
						
						// Required role data
						$data_rol = Models_Permissions::getRol($id_rol);

						//Module table data
						$data_modules = Models_Permissions::getAllModules();
						
						//Permissions table data(empty)
						$data_permissions_rol = Models_Permissions::getPermissionsRol($id_rol);

						// Var data permissions empty //
						$arr_permissions = "";
                		// -------------------- //

						if (empty($data_permissions_rol)) {
                			$arr_permissions  =  array('ver' => 0, 'crear' => 0, 'actualizar' => 0, 'eliminar' => 0);
		                    for ($i=0; $i < count($data_modules); $i++) {
		                        $data_modules[$i]['permissions'] = $arr_permissions;
		                    }
		                }else{
		                    for ($i=0; $i < count($data_modules); $i++) { 
		                        $arr_permissions = array('ver' => 0, 'crear' => 0, 'actualizar' => 0, 'eliminar' => 0);

		                        if (isset($data_permissions_rol[$i])) {

		                            $arr_permissions = array('ver' => $data_permissions_rol[$i]['ver'],
			                                                'crear' => $data_permissions_rol[$i]['crear'],
			                                                'actualizar' => $data_permissions_rol[$i]['actualizar'],
			                                                'eliminar' => $data_permissions_rol[$i]['eliminar']
			                                                );
		                        }

		                        $data_modules[$i]['permissions'] = $arr_permissions;
		                    }
		                }

		                if ($data_rol == "error") {
		                	return ;
		                }else{
		                	$arrData_Modal = array("idRol" => $id_rol);
	                		$arrData_Modal['modules'] = $data_modules;
	                		$arrData_Modal['rol'] = $data_rol;
	                		return Utils::loadModalFile("permissions", $arrData_Modal);
		                }
					}

				break;

				case 'setPermissions':

					try {
						if (isset($_POST)) {

							if (empty($_POST['id_rol']) || empty($_POST['arr_modules'])) {
								throw new Exception("Ha existido un error de datos. Intentelo mas tarde.");
							}else{

								$id_rol = Utils::desencriptar($_POST['id_rol']);
								$arr_modules = $_POST['arr_modules'];

								Models_Permissions::deletePermission($id_rol);

								foreach ($arr_modules as $key => $value) {
									$id_module = Utils::desencriptar($value['id_module']);
																
									$ver = empty($value['ver']) ? 0 : 1;
									$crear = empty($value['crear']) ? 0 : 1;
									$actualizar = empty($value['actualizar']) ? 0 : 1;
									$eliminar = empty($value['eliminar']) ? 0 : 1;

									$arr_insert_data[] = array("rol_id" => $id_rol, "module_id" => $id_module, "ver" => $ver, "crear" => $crear, "actualizar" => $actualizar, "eliminar" => $eliminar); 		
								}

								$request_permissions = Models_Permissions::insertPermissions($arr_insert_data);

								if ($request_permissions > 0) {
									$status = true;	
									$msg = "Permisos asignados correctamente.";
								}else{
									throw new Exception("No es posible asignar los permisos. Inténtelo mas tarde.");
								}
							}

						}else{
							throw new Exception("Error de datos. Intentelo mas tarde.");
						}
					} catch (Exception $e) {
						$status = false;
						$msg = $e->getMessage();
					}

					$data = array("status" => $status, "msg" => $msg);
					echo json_encode($data);

				break;
			}
		}

	}

?>