<?php

	class Controller_Index{
		public function buildPage()
		{	
			session_start();
			$action = Utils::getParam("action", "");
			$data = array();
			$status = true;
			$msg = "";
			switch ($action) {
				case 'logout':
					Utils::sessionEndStore();
				break;
				case 'registerClient':
					if($_POST){
						$name = $_POST['name_client'];
						$surname = $_POST['surname_client'];
						$phone = $_POST['phone_client'];
						$email = $_POST['email_client'];
						$password = $_POST['password_client'];
					
						try {
							if(empty($name) || empty($surname) || empty($phone) || empty($email) || empty($password)){
								throw new Exception("Por favor rellene todos los campos.");
								die();
							}else{
								$test_email = "/^(([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9])+\.)+([a-zA-Z0-9]{2,4}))*$/";
								$test_password = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/";
								$test_phone = "/^09\d{8}$/";
								$test_text = "/^([a-zA-ZÑñÁáÉéÍíÓóÚú\s])*$/";

								if (!preg_match($test_text, $name) || !preg_match($test_text, $surname) || !preg_match($test_phone, $phone) || !preg_match($test_email, $email) || !preg_match($test_password, $password)) {
									throw new Exception("Ha ocurrido un error al ingresar los datos. Intentelo más tarde.");
									die();
								}else{
									$request = Models_Store::insertClient($name, $surname, $phone, $email, sha1($password));
									if($request > 0 && is_numeric($request)){
										$_SESSION['idUser'] = $request;
										$_SESSION['login'] = true;
										$_SESSION['timeout'] = true;
										$_SESSION['inicio'] = time();
										Models_Usuario::dataSessionlogin($request);
										session_regenerate_id(true);
										
										$status = true;
										$msg = "";
									}else{
										throw new Exception("El correo ingresado ya existe. Inténtelo de nuevo.");
										die();
									}
								}
							}
						} catch (Exception $e) {
							$status = false;
							$msg = $e->getMessage();
						}

						$data = array("status" => $status,"msg" => $msg);
						echo json_encode($data);
					}
				break;
				
				case 'searchData':
					if (isset($_POST)) {
						$search_value = $_POST['search'];
						$html_products = "";
						$amount_products = "";
						$suggestions = array();

						if (!empty($search_value) && strlen($search_value) > 3) {
							$search_data = Models_Store::searchData($search_value);

							if (!empty($search_data['products'])) {
								$amount_products = $search_data['amount'][0]['amount'];
								$product_images = array();
								foreach ($search_data['products'] as $product) {
									$img_product = Models_Products::selectImages($product['id_product']);
									if (!empty($img_product)) {
										$r_indexes = array_rand($img_product, 2);
										foreach ($r_indexes as $index) {
											$r_element = $img_product[$index];
											$product_images[$product['id_product']][] = '<img src="'.MEDIA_ADMIN.'files/images/upload_products/'.$r_element['image'].'" alt="">';
										}
									}else{
										$product_images[$product['id_product']][] = '<img src="'.MEDIA_ADMIN.'files/images/upload_products/empty_img.png" alt="">';
									}
								}

								$html_products = '	<div class="search-product-slider-default-1row default-slider-nav-arrow">
														<div class="swiper-container product-default-slider-4grid-1row">
															<div class="swiper-wrapper my-2">';

															foreach ($search_data['products'] as $product) {
																$html_products.= '<div class="product-default-single-item product-color--pink swiper-slide border-product">';
																	$html_products.= '<div class="image-box">';
																		$html_products.= '<a href="'.BASE_URL."producto/".$product["url"].'" class="image-link' . (!empty($product['discount']) ? ' content-off" data-discount="'.$product['discount'].'% off"' : '"') . '>';
																			$html_products.= implode('', $product_images[$product['id_product']]);
																		$html_products.= '</a>';
																		$html_products.= '<div class="action-link">';
																			$html_products.= '<div class="action-link-right mx-auto">';
																			if (!empty($product['stock']) && $product['stock'] > 0) {
																				$html_products.= '<a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart" class="addToCart" id="'.Utils::encriptar($product['id_product']).'"><i class="icon-basket" title="Añadir al carrito"></i></a>';
																			}
																			$html_products.= '</div>';
																		$html_products.= '</div>';
																	$html_products.= '</div>';
																	
																	$html_products.= '<div class="content">';
																		$html_products.= '<div class="text-center">';
																			$html_products.= '<h6><a class="title-product" href="'.BASE_URL."producto/".$product["url"].'">'.$product['name_product'].'</a></h6>';
																			$html_products.= '<p>'.$product['brand'].'</p>';
						
																			if (!empty($product['cantDues'])) {
																			$html_products.= '<div class="content-data-product no-empty">'; 
																				$html_products.= '<div class="price-product no-empty">';
																			}else{
																			$html_products.= '<div class="content-data-product empty">'; 
																				$html_products.= '<div class="price-product empty">';
																			}
																					$html_products.= (!empty($product['prevPrice'])) ? '<del>'.SMONEY. Utils::formatMoney($product['prevPrice']).'</del>' : '';
																					$html_products.= '<span>'.SMONEY.Utils::formatMoney($product['price']).'</span>';
																				$html_products.= '</div>';
						
																				$html_products.= (!empty($product['cantDues'])) ? '<span class="ml-2 text-left">'.$product['cantDues'].' cuotas '.SMONEY. Utils::formatMoney($product['priceDues']).'</span>' : '';
																			$html_products.= '</div>';
						
																		$html_products.= '</div>';
																	$html_products.= '</div>';
																$html_products.= '</div>';
															}

															if ($amount_products > 5) {
																$html_products .= '	<div class="product-default-single-item swiper-slide my-auto fs-16">
																						<div class="content p-0">
																							<a class="text-center" href="#">Ver todos los '.$amount_products.' productos</a>
																						</div>
																				   	</div>
																';
															}


								$html_products .= '			</div>
														</div>

														<div class="swiper-button-prev"></div>
														<div class="swiper-button-next"></div>
													</div>';


								$suggestions = array_reduce($search_data['products'], function ($carry, $item) {
									$brand = $item['brand'];
									$nameCtg = $item['name_category'];

									if (!isset($carry[$brand])) {
										$carry[$brand] = array(
											"brand" => $item["brand"],
											"url" => $item["url"],
											"name_category" => $item["name_category"]
										);
									}
									
									return $carry;
								}, []);
							}
							$data = array("htmlContent" => $html_products, "amountProducts" => $amount_products, "suggestions" => array_values($suggestions));
							echo json_encode($data);
						}
					}	
				break;

				case 'testEmail':
					if ($_POST) {
						// $producto = array(
						// 	"name" => "producto 1",
						// 	"price" => 15.00,
						// 	"data" => array(
						// 		array(
						// 			"image" => 'imagen.jpg'
						// 		),
						// 		array(
						// 			"testeo" => "testo"
						// 		)
						// 	),
						// 	"quantity" => 9
						// ); 

						$dataEmailTest = array( "name" => 'ron y moly',
												"email" => 'carlosandrespozo95@gmail.com',
												"asunto" => 'Testeo de mensaje '.NAME_EMPRESA,
											); 
						
						$sendEmail = Utils::sendEmail($dataEmailTest, 'email_buyConfirm');
						if ($sendEmail) {
							$status = true;
						}else{
							$status = false;
						}
						$data = array("status" => $status);
						echo json_encode($data);
					}
				break;

				default:
					$data["file_css"][] = "index-store";
					$data["file_js"][] = "index-store"; 
					View::renderPage('Index', $data);
				break;
			}
		}
	}

?>