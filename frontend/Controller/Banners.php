<?php

	class Controller_Banners{

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
				case "insertBannerCtg":
					try {
						if (isset($_POST)) {
							$idCtg = Utils::desencriptar($_POST['id']);
							$typeBanner = $_POST['type'];
							$amount = array(
								1 => 3,
								2 => 4,
								3 => 5
							);

							if (empty($idCtg) || empty($typeBanner)) {
								throw new Exception("Ha ocurrido un error. Inténtelo de nuevo.");
								die();
							}else{
								$verifyData = Models_Banners::getData("categories", "id_category", "name_category, photo, banner_large, sliderDst, sliderMbl, sliderDesOne, sliderDesTwo, fatherCategory, url", $idCtg);
								
								if (empty($verifyData)) {
									throw new Exception("Ha ocurrido un error. Inténtelo de nuevo.");
									die();
								}else{
									$insertBanner = Models_Banners::insertBannerCtg($idCtg, $verifyData, $typeBanner, $amount[$typeBanner]);
									
									if ($insertBanner > 0) {
										$request = array("id" => Utils::encriptar(strval($insertBanner)), "name" => $verifyData['name_category'], "bSmall" => MEDIA_ADMIN.'files/images/uploads/'.$verifyData['photo'], "bLarge" => MEDIA_ADMIN.'files/images/uploads/'.$verifyData['banner_large'], "sliderDst" => MEDIA_ADMIN.'files/images/uploads/'.$verifyData['sliderDst'], "sliderMbl" => MEDIA_ADMIN.'files/images/uploads/'.$verifyData['sliderMbl'], "module" => $_SESSION['module'] , "id_user" => $_SESSION['idUser']);
										$msg = "Datos ingresados correctamente.";
									}else if ($insertBanner == "exists") {
										throw new Exception("Al parecer el elemento insertado ya existe. Intentelo de nuevo.");
										die();	
									}else{
										throw new Exception("Solo se pueden agregar ".$amount[$typeBanner]." elementos.");
										die();	
									}	
								}
							}
						}else{
							throw new Exception("Ha ocurrido un error. Inténtelo de nuevo.");
							die();
						}
					} catch (Exception $e) {
						$status = false;
						$msg = $e->getMessage();
					}

					$data = array("status" => $status, "msg" => $msg, "request" => $request);
					echo json_encode($data);
				break;

				case "insertBannerProd":
					try {
						if (isset($_POST)) {
							$idProd = Utils::desencriptar($_POST['id']);
							$typeBanner = $_POST['type'];
							$amount = array(
								1 => 3,
								2 => 2,
								// 3 => 5
							);

							if (empty($idProd) || empty($typeBanner)) {
								throw new Exception("Ha ocurrido un error. Inténtelo de nuevo.");
								die();
							}else{
								$verifyData = Models_Banners::getData("products", "id_product", "category_id, name_product, sliderDst, sliderMbl, sliderDes, banner_large, banner_width, url", $idProd);
								
								if (empty($verifyData)) {
									throw new Exception("Ha ocurrido un error. Inténtelo de nuevo.");
									die();
								}else{
									$insertBanner = Models_Banners::insertBannerProd($idProd, $verifyData, $typeBanner, $amount[$typeBanner]);
									
									if ($insertBanner > 0) {
										$request = array("id" => Utils::encriptar(strval($insertBanner)), "name" => $verifyData['name_product'], "sliderDst" => MEDIA_ADMIN.'files/images/upload_products/'.$verifyData['sliderDst'], "sliderMbl" => MEDIA_ADMIN.'files/images/upload_products/'.$verifyData['sliderMbl'], "bLarge" => MEDIA_ADMIN.'files/images/upload_products/'.$verifyData['banner_large'], "module" => $_SESSION['module'] , "id_user" => $_SESSION['idUser']);
										$msg = "Datos ingresados correctamente.";
									}else if ($insertBanner == "exists") {
										throw new Exception("Al parecer el elemento insertado ya existe. Intentelo de nuevo.");
										die();	
									}else{
										throw new Exception("Solo se pueden agregar ".$amount[$typeBanner]." elementos.");
										die();	
									}	
								}
							}
						}else{
							throw new Exception("Ha ocurrido un error. Inténtelo de nuevo.");
							die();
						}
					} catch (Exception $e) {
						$status = false;
						$msg = $e->getMessage();
					}

					$data = array("status" => $status, "msg" => $msg, "request" => $request);
					echo json_encode($data);
				break;
				
				case "delBannerCtg":
					if (isset($_POST)) {
						try {
							$idBanner = Utils::desencriptar($_POST['id']);
							$typeBanner = $_POST['typeBanner'];

							$dataBanner = Models_Banners::getData("banners_category", "id_banner", "*", $idBanner);

							if (!empty($dataBanner)) {
								$delBanner = Models_Banners::deleteBanner("banners_category", $idBanner, $typeBanner);
								if ($delBanner == 1) {
									$msg = "El elemento fue eliminado exitosamente.";
								}else{
									throw new Exception("Ha ocurrido un error. Inténtelo de nuevo.");
									die();
								}
							}else{
								throw new Exception("Ha ocurrido un error. Inténtelo de nuevo.");
								die();
							}
							
						} catch (Exception $e) {
							$status = false;
							$msg = $e->getMessage();
						}

						$data = array("status" => $status, "msg" => $msg);
						echo json_encode($data);
					}
				break;
				
				case "delBannerProd":
					if (isset($_POST)) {
						try {
							$idBanner = Utils::desencriptar($_POST['id']);
							$typeBanner = $_POST['typeBanner'];

							$dataBanner = Models_Banners::getData("banners_product", "id_banner", "*", $idBanner);

							if (!empty($dataBanner)) {
								$delBanner = Models_Banners::deleteBanner("banners_product", $idBanner, $typeBanner);
								if ($delBanner == 1) {
									$msg = "El elemento fue eliminado exitosamente.";
								}else{
									throw new Exception("Ha ocurrido un error. Inténtelo de nuevo.");
									die();
								}
							}else{
								throw new Exception("Ha ocurrido un error. Inténtelo de nuevo.");
								die();
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
					Utils::permissionsData(MBANNERS);

					if (empty($_SESSION['module']['ver'])) {
						header('Location: '.BASE_URL.'Dashboard');	
					}

		            $variable["file_js"][] = "f_banners";
                    View::renderPage('Banners', $variable);
				break;

			}
		}

	}