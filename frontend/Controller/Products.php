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
										}else{
											$undef_sliderDst = null;
											$undef_sliderMbl = null;
										}
										
										$request = Models_Products::insertProduct($name, $desMain, $desGeneral, $undef_sliderDst, $undef_sliderMbl, $sliderDes, $option_list, $brand, $code, $price, $stock, $status);
								}

								if ($request > 0) {

									$undef_sliderDst != null ? $data_dst = MEDIA_ADMIN.'files/images/uploads/'.$undef_sliderDst : $data_dst = "";
									$undef_sliderMbl != null ? $data_mbl = MEDIA_ADMIN.'files/images/uploads/'.$undef_sliderMbl : $data_mbl = "";

									if($option == 1){
										$status = true;
										$msg = "Datos ingresados correctamente.";
										$data_request = array("id_encrypt" => Utils::encriptar(strval($request)), "sliderDst" => $data_dst, "sliderMbl" => $data_mbl, "module" => $_SESSION['module'], "id_user" => $_SESSION['idUser']);
										Utils::uploadImage(array($sliderDst, $sliderMbl));
									}else{
										// $status = true;
										// $msg = "Datos actualizados correctamente.";
										// $data_request = array("data_sons" => Models_Categories::dataSons(Utils::desencriptar($id)), "sliderDst" => $data_dst, "sliderMbl" => $data_mbl,);
										// Utils::uploadImage(array($icon, $photo,  $sliderDst, $sliderMbl));
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