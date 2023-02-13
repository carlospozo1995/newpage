<?php

	class Controller_Products{

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
				case 'setProduct':
					if(isset($_POST)){
						try {
							if (empty($_POST['name_product']) || empty($_POST['desMainProd']) || empty($_POST['listCategories']) || empty($_POST['brand']) || empty($_POST['code']) || empty($_POST['price']) || empty($_POST['stock']) || empty($_POST['listStatus'])){
								throw new Exception("Por favor asegúrese de llenar los campos requeridos.");
								die();
							}else{

								$test_number = "/^\d+$/";
								$test_price = "/^\d{1,}[.,]\d{2}$/";

								if (!preg_match($test_number, $_POST['code']) || !preg_match($test_price, $_POST['price']) || !preg_match($test_number, $_POST['stock'])) {
									die();
								}

								$id = $_POST['id_product'];
								$name = $_POST['name_product'];
								$desMain = $_POST['desMainProd'];
								$desGeneral = empty($_POST['desGeneralProd']) ? null : $_POST['desGeneralProd'];
								$option_list = Utils::desencriptar($_POST['listCategories']);
								$brand = $_POST['brand'];
								$code = $_POST['code'];
								$price = $_POST['price'];
								$stock = $_POST['stock'];
								$status = $_POST['listStatus'];

								$sliderMbl = $_FILES['sliderMbl'];
								$sliderDst = $_FILES['sliderDst'];		
												
								$sliderDes = empty($_POST['sliderDes']) ? null : $_POST['sliderDes'];

								$nameNotSpace = str_replace(' ', '-', $name);
								if (empty($id)) {
									$option = 1;

									if ((empty($sliderDst['name']) && !empty($sliderMbl['name'])) || (!empty($sliderDst['name']) && empty($sliderMbl['name']))) {
										throw new Exception("Si desea agregar sliders, debe agregar ambos.");
										die();
									}

									if (!empty($sliderDst['name']) && !empty($sliderMbl['name'])) {
										$undef_sliderDst = "sliderDst_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										$undef_sliderMbl = "sliderMbl_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										$sliderDst["name_upload"] = "sliderDst_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										$sliderMbl["name_upload"] = "sliderMbl_".$nameNotSpace.'_'.md5(date("d-m-Y H:m:s")).".jpg";
										$sliderDst["file_product"] = "";
										$sliderMbl["file_product"] = "";
									}else{
										$undef_sliderDst = null;
										$undef_sliderMbl = null;
									}
									
									$request = Models_Products::insertProduct($name, $desMain, $desGeneral, $undef_sliderDst, $undef_sliderMbl, $sliderDes, $option_list, $brand, $code, $price, $stock, $status);
								}else{
									$option = 2;
									// UPDATE SLIDERS (MOBILE - DESKTOP)
									if(!empty($_POST['sliderMbl_actual']) && !empty($_POST['sliderDst_actual'])){
										$data_sliders = Models_Categories::selectImages("products", "sliderDst", "sliderMbl", $_POST['sliderDst_actual'] , $_POST['sliderMbl_actual']);
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
										$sliderMbl["file_product"] = "";									
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
										$sliderDst["file_product"] = "";
									}

									if(($undef_sliderMbl == null && !empty($undef_sliderDst)) || ($undef_sliderDst == null && !empty($undef_sliderMbl))){
										throw new Exception("Si desea agregar sliders, debe agregar ambos.");
										die();
									}
									
									$request = Models_Products::updateProduct(Utils::desencriptar($id), $name, $desMain, $desGeneral, $undef_sliderDst, $undef_sliderMbl, $sliderDes, $option_list, $brand, $code, $price, $stock, $status);	
								}

								if ($request > 0) {

									$undef_sliderDst != null ? $data_dst = MEDIA_ADMIN.'files/images/upload_products/'.$undef_sliderDst : $data_dst = "";
									$undef_sliderMbl != null ? $data_mbl = MEDIA_ADMIN.'files/images/upload_products/'.$undef_sliderMbl : $data_mbl = "";

									if($option == 1){
										$status = true;
										$msg = "Datos ingresados correctamente.";
										$data_request = array("id_encrypt" => Utils::encriptar(strval($request)), "sliderDst" => $data_dst, "sliderMbl" => $data_mbl, "module" => $_SESSION['module'], "id_user" => $_SESSION['idUser']);
										Utils::uploadImage(array($sliderDst, $sliderMbl));
									}else{
										$status = true;
										$msg = "Datos actualizados correctamente.";
										$data_request = array("sliderDst" => $data_dst, "sliderMbl" => $data_mbl,);
										Utils::uploadImage(array($sliderDst, $sliderMbl));
									}
								}else if($request == "exist"){	
									throw new Exception("El código del producto ingresado ya existe. Inténtelo de nuevo.");
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

                case 'getProduct':

					if (empty(Utils::getParam("data", ""))) {
						die();
					}else{
						$id_product = Utils::desencriptar(Utils::getParam("data", ""));

						try {
						 	$data_product = Models_Products::selectProduct($id_product);
						 	if (empty($data_product)) {
						 		throw new Exception("Ha ocurrido un error. Intentelo mas tarde.");
						 		die();
						 	}else{
						 		$data_product['option_encrypt'] = Utils::encriptar($data_product['category_id']);

		                        if (!empty($data_product['sliderDst']) && !empty($data_product['sliderMbl'])) {
		                            $data_product['url_sliderDst'] = MEDIA_ADMIN.'files/images/upload_products/'.$data_product['sliderDst'];
		                            $data_product['url_sliderMbl'] = MEDIA_ADMIN.'files/images/upload_products/'.$data_product['sliderMbl'];
		                        }

		                        $img_product = Models_Products::selectImages($id_product);
		                        if (!empty($img_product)) {
		                        	foreach ($img_product as $key => $value) {
		                        		$img_product[$key]['url_image'] = MEDIA_ADMIN.'files/images/upload_products/'.$value['image'];
		                        	}
		                        }

		                        $data_product["images_product"] = $img_product;

		                        $status = true;
		                        $msg = "";
						 		$data_request = array("data_product" => $data_product);
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

				case 'setImage':
					if (isset($_POST)) {
						try {
							if(empty($_POST['id'])){
								throw new Exception("Error de cargar.");
								die();
							}else{
								$id_product = Utils::desencriptar($_POST['id']);
								$file_product = $_FILES['file'];

								$imgName = "imgRef_".$id_product.'_'.md5(date("d-m-Y H:m:s")).".jpg";
								$file_product["name_upload"] = "imgRef_".$id_product.'_'.md5(date("d-m-Y H:m:s")).".jpg";
								$file_product["file_product"] = "";

								$arrData[] = array("product_id" => $id_product, "image" => $imgName);
								$request = Models_Products::insertImage($arrData); 

								if($request > 0){
									$status = true;
			                        $msg = "Imagen cargada.";
							 		$data_request = array("data_img" => $imgName);
							 		Utils::uploadImage(array($file_product));
								}else{
									throw new Exception("Error de cargar.");
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

				case 'delFile':
					if (isset($_POST)) {
						try {
							if (empty($_POST['id']) || empty($_POST['file_name'])) {
	                    		throw new Exception("Ha ocurrido un error. Inténtelo mas tarde.");
	                    		die();
			                }else{
			                    $id_product = Utils::desencriptar($_POST['id']);
			                    $imgName = $_POST['file_name'];

			                    $request = Models_Products::deleteImage($id_product, $imgName);
			                    
			                    if ($request > 0) {
			                        Utils::deleteFile($imgName);
			                        $status = true;
				                   	$msg = "Imagen eliminada.";
			                    }else{
			                        throw new Exception("Ha ocurrido un error. Inténtelo mas tarde.");
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

				case 'delProduct':
					if (empty(Utils::getParam("data", ""))) {
						die();
					}else{
						$id_product = Utils::desencriptar(Utils::getParam("data", ""));
						try {
							$delProduct = Models_Products::deleteProduct($id_product);

							if ($delProduct == "ok") {
								$status = true;
								$msg = "Se ha eliminado el producto con exito.";
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
					Utils::permissionsData(MPRODUCTOS);

					if (empty($_SESSION['module']['ver'])) {
						header('Location: '.BASE_URL.'Dashboard');	
					}

					// $variable["file_css"][] = "c_roles";
		            $variable["file_js"][] = "f_products";
					View::renderPage('Products', $variable);
				break;
			}
		}

	}