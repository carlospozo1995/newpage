<?php

	require URL_LOCAL . 'vendor/autoload.php';

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
						$value = $_POST['data_value'];
						if (strlen($value) > 1) {
							$client = \Algolia\AlgoliaSearch\SearchClient::create(
								$_ENV['ALGOLIA_APP_ID'],
								$_ENV['ALGOLIA_ADMIN_API_KEY']
							);

							$index = $client->initIndex('index_products');
							$results = $index->search($value,[
								'length' => 5,
								'offset' => 0
							]);

							$products = $results['hits'];
							$amount = $results['nbHits'];
							$html = "";
							$suggestions = "";

							if (!empty($products)) {

								$products_img = array();

								foreach ($products as $product) {
									$images = Models_Products::selectImages($product['objectID']);
									if (!empty($images)) {
										$r_indexes = array_rand($images, 2);
										foreach ($r_indexes as $index) {
											$r_element = $images[$index];
											$image_path = URL_LOCAL."Assets/admin/files/images/upload_products/".$r_element['image'];

											if (file_exists($image_path)) {
												$products_img[$product['objectID']][] = '<img class="img-fluid" src="'.MEDIA_ADMIN.'files/images/upload_products/'.$r_element['image'].'" alt="">';
											} else {
												$products_img[$product['objectID']][] = '<img class="img-fluid" src="'.MEDIA_ADMIN.'files/images/upload_products/empty_img.png" alt="">';
											}
										}
									}else{
										$products_img[$product['objectID']][] = '<img src="'.MEDIA_ADMIN.'files/images/upload_products/empty_img.png" alt="">';
									}
								}

								$html = '<div class="search-product-slider-default-1row default-slider-nav-arrow">
											<div class="swiper-container product-default-slider-4grid-1row">
												<div class="swiper-wrapper my-2">';

												foreach ($products as $product) {
													$html.= '<div class="product-default-single-item product-color--pink swiper-slide border-product">';
														$html.= '<div class="image-box">';
															$html.= '<a href="'.BASE_URL."producto/".$product["url"].'" class="image-link' . (!empty($product['discount']) ? ' content-off" data-discount="'.$product['discount'].'% off"' : '"') . '>';
																$html.= implode('', $products_img[$product['objectID']]);
															$html.= '</a>';
															$html.= '<div class="action-link">';
																$html.= '<div class="action-link-right mx-auto">';
																if (!empty($product['stock']) && $product['stock'] > 0) {
																	$html.= '<a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart" class="addToCart" id="'.Utils::encriptar($product['objectID'	]).'"><i class="icon-basket" title="Añadir al carrito"></i></a>';
																}
																$html.= '</div>';
															$html.= '</div>';
														$html.= '</div>';
														
														$html.= '<div class="content">';
															$html.= '<div class="text-center">';
																$html.= '<h6><a class="title-product" href="'.BASE_URL."producto/".$product["url"].'">'.$product['name_product'].'</a></h6>';
																$html.= '<p>'.$product['brand'].'</p>';
			
																if (!empty($product['cantDues'])) {
																$html.= '<div class="content-data-product no-empty">'; 
																	$html.= '<div class="price-product no-empty">';
																}else{
																$html.= '<div class="content-data-product empty">'; 
																	$html.= '<div class="price-product empty">';
																}
																		$html.= (!empty($product['prevPrice'])) ? '<del>'.SMONEY. Utils::formatMoney($product['prevPrice']).'</del>' : '';
																		$html.= '<span>'.SMONEY.Utils::formatMoney($product['price']).'</span>';
																	$html.= '</div>';
			
																	$html.= (!empty($product['cantDues'])) ? '<span class="ml-2 text-left">'.$product['cantDues'].' cuotas '.SMONEY. Utils::formatMoney($product['priceDues']).'</span>' : '';
																$html.= '</div>';
			
															$html.= '</div>';
														$html.= '</div>';
													$html.= '</div>';
												}
	
												if ($amount > 5) {
													$html .= '	<div class="product-default-single-item swiper-slide my-auto fs-16">
																			<div class="content p-0">
																				<a class="text-center" href="'.BASE_URL.'resultado/'.$value.'">Ver todos los '.$amount.' productos</a>
																			</div>
																		   </div>
													';
												}

								$html .= '		</div>
											</div>

											<div class="swiper-button-prev"></div>
											<div class="swiper-button-next"></div>
										</div>';

								$suggestions = array_reduce($products, function ($carry, $item) {
									$brand = $item['brand'];
									$nameCategory = $item['name_category'];
								
									$existingKey = array_search([$brand, $nameCategory], array_column($carry, 'key'));
								
									if ($existingKey === false) {
										$carry[] = [
											'brand' => $brand,
											'name_category' => $nameCategory,
											'key' => [$brand, $nameCategory],
										];
									}
								
									return $carry;
								}, []);
								
							}

							$data = array("html" => $html, "amount" => $amount, "suggestions" => $suggestions);
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