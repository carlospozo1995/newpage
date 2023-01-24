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

					$id_category == "" ? $data = "" : $data = Utils::desencriptar($id_category);
					$arr_options = Models_Categories::arrCategories($data);
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
								$photo = $_FILES['photo'];	
								$sliderMbl = $_FILES['sliderMbl'];
								$sliderDst = $_FILES['sliderDst'];		
												
								$sliderDscOne = empty($_POST['sliderDscOne']) ? null : $_POST['sliderDscOne'];
								$sliderDscTwo = empty($_POST['sliderDscTwo']) ? null : $_POST['sliderDscTwo'];

								$nameNotSpace = str_replace(' ', '-', $name);
							
								if (empty($id)) {
									$option = 1;
									if ($option_list != null){
										$undef_icon = null;
										$undef_photo = null;
										$icon["name_upload"] = null;
										$photo["name_upload"] = null;
									}else{
										if (empty($icon['name']) || empty($photo['name'])) {
											throw new Exception("Las categorias superiores deben tener icono y foto referencial.");
											die();
										}else{
											$undef_icon = "icon_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
											$undef_photo = "photo_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
											$icon["name_upload"] = "icon_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
											$photo["name_upload"] = "photo_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										}
									}

									if ((empty($sliderDst['name']) && !empty($sliderMbl['name'])) || !empty($sliderDst['name']) && empty($sliderMbl['name'])) {
										throw new Exception("Si va agregar slider deben ser ambos.");
										die();
									}

									if (!empty($sliderDst['name']) && !empty($sliderMbl['name'])) {
										$undef_sliderDst = "sliderDst_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										$undef_sliderMbl = "sliderMbl_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										$sliderDst["name_upload"] = "sliderDst_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										$sliderMbl["name_upload"] = "sliderMbl_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
									}else{
										$undef_sliderDst = null;
										$undef_sliderMbl = null;
										$sliderDst["name_upload"] = null;
										$sliderMbl["name_upload"] = null;
									}
									
									$request = Models_Categories::insertCategory($name, $undef_photo, $undef_icon, $undef_sliderDst, $undef_sliderMbl, $sliderDscOne, $sliderDscTwo, $option_list, $status);
								}else{
									$option = 2;
									Utils::dep($_POST);
									Utils::dep($_FILES);
									if ($option_list != null){
										$undef_icon = null;
										$undef_photo = null;
										$icon["name_upload"] = null;
										$photo["name_upload"] = null;
									}else{

									}
								}

								if ($request > 0) {

									$undef_sliderDst != null ? $data_dst = MEDIA_ADMIN.'files/images/uploads/'.$undef_sliderDst : $data_dst = "";
									$undef_sliderMbl != null ? $data_mbl = MEDIA_ADMIN.'files/images/uploads/'.$undef_sliderMbl : $data_mbl = "";

									if($option == 1){
										$status = true;
										$msg = "Datos ingresados correctamente.";
										$data_request = array("id_encrypt" => Utils::encriptar(strval($request)), "sliderDst" => $data_dst, "sliderMbl" => $data_mbl, "module" => $_SESSION['module'], "id_user" => $_SESSION['idUser']);
										Utils::uploadImage(array($icon, $photo, $sliderDst, $sliderMbl));
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
							$data_request = "";
						}
						$data = array("status" => $status, "msg" => $msg, "data_request" => $data_request);
						echo json_encode($data);
					}
				break;

				case 'getCategory':

					if (empty(Utils::getParam("data", ""))) {
						die();
					}else{
						$id_category = Utils::desencriptar(Utils::getParam("data", ""));
						$arrCategories = Models_Categories::arrCategories("");
						// ********************

						try {
						 	$data_category = Models_Categories::selectCategory($id_category);
						 	if (empty($data_category)) {
						 		throw new Exception("Ha ocurrido un error. Intentelo mas tarde.");
						 		die();
						 	}else{
						 		$data_category['option_encrypt'] = Utils::encriptar($data_category['fatherCategory']);
						 		
						 		if (!empty($data_category['photo']) && !empty($data_category['icon'])) {
		                            $data_category['url_photo'] = MEDIA_ADMIN.'files/images/uploads/'.$data_category['photo'];
		                            $data_category['url_icon'] = MEDIA_ADMIN.'files/images/uploads/'.$data_category['icon']; 
		                        }

		                        if (!empty($data_category['sliderDst']) && !empty($data_category['sliderMbl'])) {
		                            $data_category['url_sliderDst'] = MEDIA_ADMIN.'files/images/uploads/'.$data_category['sliderDst'];
		                            $data_category['url_sliderMbl'] = MEDIA_ADMIN.'files/images/uploads/'.$data_category['sliderMbl'];
		                        }

		                        $status = true;
		                        $msg = "";
		                        $data_request = array("data_category" => $data_category);
						 	}
						} catch (Exception $e) {
						 	$status = false;
						 	$msg = $e->getMessage();
						 	$data_request = "";
						}

						$data = array("status" => $status, "msg" => $msg, "data_request" => $data_request);
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