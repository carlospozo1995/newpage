<?php

	class Controller_Categories{

		public function buildPage()
		{
			Utils::sessionStart();
			if (empty($_SESSION['idUser'])) {
				header('Location: '.BASE_URL.'login');
			}

			$action = Utils::getParam("action", "");
			$data = array();
			$msg = "";
			$status = true;
			$request = "";

			switch ($action) {
				case 'listCategories':
					$id_category = Utils::getParam("id_category", "");
					$arr_options = Models_Categories::arrCategories($id_category);
					Utils::optionsCategories($arr_options);
				break;

				case 'setCategory':
					if (isset($_POST)) {
						try {
							if (empty($_POST['name_category']) || $_POST['listCategories'] == null || empty($_POST['listStatus'])) {
								throw new Exception("Por favor asegúrese de llenar los campos requeridos.");
								die();
							}else{
								$id = $_POST['id_category'];
								$name = $_POST['name_category'];
								$option_list = $_POST['listCategories'] == 0 && is_numeric($_POST['listCategories']) ? null : Utils::desencriptar($_POST['listCategories']);
								$status = $_POST['listStatus'];

								$icon = $_FILES['icon'];
								$undef_icon = "";

								$photo = $_FILES['photo'];
								$undef_photo = "";	

								$sliderMbl = $_FILES['sliderMbl'];
								$undef_sliderMbl = "";

								$sliderDst = $_FILES['sliderDst'];
								$undef_sliderDst = "";							

								$sliderDscOne = empty($_POST['sliderDscOne']) ? null : $_POST['sliderDscOne'];
								$sliderDscTwo = empty($_POST['sliderDscTwo']) ? null : $_POST['sliderDscTwo'];

								$nameNotSpace = str_replace(' ', '-', $name);
							
								if (empty($id)) {
									$option = 1;
									if ($option_list != null){
										$undef_icon = null;
										$icon["name_upload"] = null;
										$undef_photo = null;
										$photo["name_upload"] = null;
									}else{
										if (empty($icon['name']) || empty($photo['name'])) {
											throw new Exception("Las categorias superiores deben tener icono y foto referencial.");
											die();
										}else{
											$undef_icon = "icon_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
											$icon["name_upload"] = "icon_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
											$undef_photo = "photo_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
											$photo["name_upload"] = "photo_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										}
									}

									if ((empty($sliderDst['name']) && !empty($sliderMbl['name'])) || !empty($sliderDst['name']) && empty($sliderMbl['name'])) {
										throw new Exception("Si va agregar slider deben ser ambos.");
										die();
									}

									if (!empty($sliderDst['name']) && !empty($sliderMbl['name'])) {
										$undef_sliderDst = "sliderDst_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										$sliderDst["name_upload"] = "sliderDst_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										$undef_sliderMbl = "sliderMbl_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										$sliderMbl["name_upload"] = "sliderMbl_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
									}else{
										$undef_sliderDst = null;
										$sliderDst["name_upload"] = null;
										$undef_sliderMbl = null;
										$sliderMbl["name_upload"] = null;
									}
									
									$request = Models_Categories::insertCategory($name, $undef_photo, $undef_icon, $undef_sliderDst, $undef_sliderMbl, $sliderDscOne, $sliderDscTwo, $option_list, $status);
								}

								if ($request > 0) {
									if($option == 1){
										$status = true;
										$msg = "Datos ingresados correctamente.";
										// Utils::uploadImage(array($icon, $photo, $sliderDst, $sliderMbl));
									}
								}else if($request == "exist"){
									throw new Exception("Al parecer el nombre insertado pertenece a una categoria superior. Intentelo de nuevo.");
									die();								
								}else{
									throw new Exception("Ha ocurrido un error. Intentelo mas tarde.");
									die();
								}

							}
						} catch (Exception $e) {
							$status = false;
							$msg = $e->getMessage();
						}
						$data = array("status" => $status, "msg" => $msg);
						echo json_encode($data);
					}
				break;

				default:
					Utils::permissionsData(MCATEGORIAS);

					if (empty($_SESSION['module']['ver'])) {
						header('Location: '.BASE_URL.'Dashboard');	
					}

					// $variable["file_css"][] = "c_roles";
		            $variable["file_js"][] = "f_categories";
					View::renderPage('Categories', $variable);
				break;
			}
		}

	}

?>