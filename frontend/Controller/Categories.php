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
			$status = "";
			$request = "";

			switch ($action) {
				case 'listCategories':
					$id_category = Utils::getParam("id_category", "");

					$id_category == "" ? $data = "" : $data = Utils::desencriptar($id_category);
					$arrCategories = Models_Categories::arrCategories($data);
					$categories = Utils::getCategories($arrCategories);
					
					$html_options = '<option value="0">-- CATEGORIA SUPERIOR --</option>';
					function getCategoriesOptions($arrCtg, $level = 0) {
						$html = "";
					    foreach ($arrCtg as $category) {
					        $html .= '<option value="'.Utils::encriptar($category['id_category']).'">' . str_repeat('-', $level) . $category['name_category'] . '</option>';
					        if (isset($category['sons'])) {
					            $html .= getCategoriesOptions($category['sons'], $level + 1);
					        }
					    }
					    return $html;
					}
					$html_options .= getCategoriesOptions($categories);
					echo json_encode($html_options);
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
								$bannerLarge = $_FILES['lgbanner'];
								$sliderMbl = $_FILES['sliderMbl'];
								$sliderDst = $_FILES['sliderDst'];		
												
								$sliderDesOne = empty($_POST['sliderDesOne']) ? null : $_POST['sliderDesOne'];
								$sliderDesTwo = empty($_POST['sliderDesTwo']) ? null : $_POST['sliderDesTwo'];

								$nameNotSpace = str_replace(' ', '-', Utils::replaceVowel($name));
							
								if (empty($id)) {
									$option = 1;
									if ($option_list != null){
										$undef_icon = null;
									}else{
										if (empty($icon['name'])) {
											throw new Exception("Las categorias superiores deben tener icono.");
											die();
										}else{
											$undef_icon = "icon_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
											$icon["name_upload"] = "icon_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										}
									}

									if (empty($photo['name'])) {
										$undef_photo = null;
									}else{
										$undef_photo = "photo_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										$photo["name_upload"] = "photo_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
									}

									if (empty($bannerLarge['name'])) {
										$undef_bannerlg = null;
									}else{
										$undef_bannerlg = "bannerlg_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										$bannerLarge["name_upload"] = "bannerlg_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
									}
									
									if ((empty($sliderDst['name']) && !empty($sliderMbl['name'])) || (!empty($sliderDst['name']) && empty($sliderMbl['name']))) {
										throw new Exception("Si desea agregar sliders, debe agregar ambos.");
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
									}
									
									$request = Models_Categories::insertCategory($name, $undef_photo, $undef_bannerlg, $undef_icon, $undef_sliderDst, $undef_sliderMbl, $sliderDesOne, $sliderDesTwo, $option_list, $status);
								}else{
									$option = 2;
									
									// UPDATE PHOTO- ICON
									if ($option_list != null){
										$undef_icon = null;
									}else{
										$exist_icon = Models_Categories::selectImg("categories", "icon", $_POST['icon_actual']);

										if(empty($exist_icon)){
											throw new Exception("Error de imagenes. Intentelo mas tarde.");
											die();
										}

										if (empty($icon['name'])) {
											if($_POST['icon_remove'] >= 1 || empty($_POST['icon_actual']) && $_POST['icon_remove'] <= 0){
												throw new Exception("Las categorias superiores deben tener icono.");
												die();
											}else{
												$undef_icon = $_POST['icon_actual'];
											} 
										}else{
											$undef_icon = "icon_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
											$icon["name_upload"] = "icon_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										}
									}
									// ----------------------
									if(!empty($_POST['photo_actual'])){
										$data_photo = Models_Categories::selectImg("categories", "photo", $_POST['photo_actual']);
										if (empty($data_photo)) {
											throw new Exception("Error de imagenes. Intentelo mas tarde.");
											die();	
										}
									}

									if (empty($photo['name'])) {

										if(!empty($_POST['photo_actual'])){
											$_POST['photo_remove'] <= 0 ? $undef_photo = $_POST['photo_actual'] : $undef_photo = null;
										}else{
											$undef_photo = null;
										}
									}else{
										$undef_photo = "photo_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										$photo["name_upload"] = "photo_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
									}
									// ----------------------
									if(!empty($_POST['lgbanner_actual'])){
										$data_bannerlg = Models_Categories::selectImg("categories", "banner_large", $_POST['lgbanner_actual']);
										if (empty($data_bannerlg)) {
											throw new Exception("Error de imagenes. Intentelo mas tarde.");
											die();	
										}
									}

									if (empty($bannerLarge['name'])) {

										if(!empty($_POST['lgbanner_actual'])){
											$_POST['lgbanner_remove'] <= 0 ? $undef_bannerlg = $_POST['lgbanner_actual'] : $undef_bannerlg = null;
										}else{
											$undef_bannerlg = null;
										}
									}else{
										$undef_bannerlg = "bannerlg_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										$bannerLarge["name_upload"] = "bannerlg_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
									}

									// ----------------------

									// UPDATE SLIDERS (MOBILE - DESKTOP)
									if(!empty($_POST['sliderMbl_actual']) && !empty($_POST['sliderDst_actual'])){
										$data_sliders = Models_Categories::selectImages("categories", "sliderDst", "sliderMbl", $_POST['sliderDst_actual'] , $_POST['sliderMbl_actual']);
										if (empty($data_sliders)) {
											throw new Exception("Error de imagenes. Intentelo mas tarde.");
											die();	
										}
									}

									if (empty($sliderMbl['name'])) {
										if(!empty($_POST['sliderMbl_actual'])){
											$_POST['sliderMbl_remove'] <= 0 ? $undef_sliderMbl = $_POST['sliderMbl_actual'] : $undef_sliderMbl = null;
										}else{
											$undef_sliderMbl = null;
										}
									}else{
										$undef_sliderMbl = "sliderMbl_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										$sliderMbl["name_upload"] = "sliderMbl_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";										
									}

									if (empty($sliderDst['name'])) {
										if (!empty($_POST['sliderDst_actual'])) {
											$_POST['sliderDst_remove'] <= 0 ? $undef_sliderDst = $_POST['sliderDst_actual'] : $undef_sliderDst = null;
										}else{
											$undef_sliderDst = null;
										}
									}else{
										$undef_sliderDst = "sliderDst_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										$sliderDst["name_upload"] = "sliderDst_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
									}

									if(($undef_sliderMbl == null && !empty($undef_sliderDst)) || ($undef_sliderDst == null && !empty($undef_sliderMbl))){
										throw new Exception("Si desea agregar sliders, debe agregar ambos.");
										die();
									}
									
									$request = Models_Categories::updateCategory(Utils::desencriptar($id), $name, $undef_photo, $undef_bannerlg, $undef_icon, $undef_sliderDst, $undef_sliderMbl, $sliderDesOne, $sliderDesTwo, $option_list, $status);	
								}

								if ($request > 0) {

									$undef_sliderDst != null ? $data_dst = MEDIA_ADMIN.'files/images/uploads/'.$undef_sliderDst : $data_dst = "";
									$undef_sliderMbl != null ? $data_mbl = MEDIA_ADMIN.'files/images/uploads/'.$undef_sliderMbl : $data_mbl = "";

									if($option == 1){
										$status = true;
										$msg = "Datos ingresados correctamente.";
										$data_request = array("id_encrypt" => Utils::encriptar(strval($request)), "sliderDst" => $data_dst, "sliderMbl" => $data_mbl, "module" => $_SESSION['module'], "id_user" => $_SESSION['idUser']);
										Utils::uploadImage(array($icon, $photo, $bannerLarge, $sliderDst, $sliderMbl));
									}else{
										$status = true;
										$msg = "Datos actualizados correctamente.";
										$data_request = array("data_sons" => Models_Categories::dataSons(Utils::desencriptar($id)), "sliderDst" => $data_dst, "sliderMbl" => $data_mbl,);
										Utils::uploadImage(array($icon, $photo, $bannerLarge, $sliderDst, $sliderMbl));
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
						// print_r($id_category);
						try {
						 	$data_category = Models_Categories::selectCategory($id_category);
						 	if (empty($data_category)) {
						 		throw new Exception("Ha ocurrido un error. Intentelo mas tarde.");
						 		die();
						 	}else{
						 		$data_category['option_encrypt'] = !empty($data_category['fatherCategory']) ? Utils::encriptar($data_category['fatherCategory']) : "";
						 		
						 		// if (!empty($data_category['photo']) && !empty($data_category['icon'])) {
								if (!empty($data_category['icon'])) {
		                            // $data_category['url_photo'] = MEDIA_ADMIN.'files/images/uploads/'.$data_category['photo'];
		                            $data_category['url_icon'] = MEDIA_ADMIN.'files/images/uploads/'.$data_category['icon']; 
		                        }
								// ---------------
								if (!empty($data_category['photo'])) {
									$data_category['url_photo'] = MEDIA_ADMIN.'files/images/uploads/'.$data_category['photo'];
								}
								// ---------------
								if (!empty($data_category['banner_large'])) {
									$data_category['url_lgbanner'] = MEDIA_ADMIN.'files/images/uploads/'.$data_category['banner_large'];
								}
								// ---------------
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

				case 'delCategory':
					if (empty(Utils::getParam("data", ""))) {
						die();
					}else{
						$id_category = Utils::desencriptar(Utils::getParam("data", ""));
						$result = Models_Categories::deleteCategory($id_category);
						try {
							if ($result == "ok") {
								$status = true;
								$msg = "Se ha eliminado la categoria con exito.";
							}else if($result == "exist_ctg"){
								throw new Exception("No puede eliminar una cartegoria que contiene subcategorias.");
								die();
							}else if($result  == "exist_prod"){
								throw new Exception("Verifique si la categoria a eliminar no contenga productos.");
								die();
							}else{
								throw new Exception("Ha ocurrido un error. Intentelo mas tarde.");
								die();
							}
						} catch (Exception $e) {
							$status = false;
							$msg = $e->getMessage();
						}

						$data = array("status" => $status,"msg" => $msg);
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