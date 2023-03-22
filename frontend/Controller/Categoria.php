<?php

	class Controller_Categoria{
		
		public function buildPage()
		{	
			$data = array();
			$action = Utils::getParam("action", "");
			switch ($action) {
				case 'loadProducts':
					if (isset($_POST)) {
						$category = $_POST['category'];

						$id_end = Models_Store::getCategory($category);
						$sons = Models_Categories::dataSons(end($id_end));
			            $id_sons = "";

			            foreach ($sons as $data) {
			                $id_sons .= Utils::desencriptar($data["id_son"]) . ",";
			            }

			            $id_sons = rtrim($id_sons, ",");
			            $id_sons = !empty($id_sons) ? $id_sons : end($id_end);
			            $products = Models_Store::getProducts("$id_sons", "", false, 0, 10);
			            $total_products = Models_Store::getProducts("$id_sons", "", false);

			            $content = self::printContentProducts($products);
			            $content_grid = $content['grid'];
						$content_single = $content['single'];

						$data = array("content_grid" => $content_grid, "content_single" => $content_single, "sons_url" => Utils::encryptStore($id_sons), "total_products" =>  $total_products);
						echo json_encode($data);
					}
				break;

				case 'orderBy':
					if (isset($_POST)) {
						$dataSon = Utils::descryptStore($_POST['dataSon']);
						$valElement = $_POST['elementVal'];
						$data_sql = "";
						$content_grid = "";
						$content_single = "";

						switch ($valElement) {
							case 'discount':
								$data_sql = " ORDER BY CASE WHEN discount IS NOT NULL THEN 0 ELSE 1 END";
							break;	
							
							case 'recent':
								$data_sql = " ORDER BY datacreate DESC";
							break;	

							case 'price_asc':
								$data_sql = " ORDER BY price ASC";
							break;

							case 'price_desc':
								$data_sql = " ORDER BY price DESC";
							break;
							
						}

						$products = Models_Store::getProducts($dataSon, $data_sql, false, 0, 10);
						$total_products = Models_Store::getProducts($dataSon, $data_sql, false);
						$content = self::printContentProducts($products);
					    $content_grid = $content['grid'];
					    $content_single = $content['single'];

						$data = array("content_grid" => $content_grid, "content_single" => $content_single, "total_products" =>  $total_products);
						echo json_encode($data);
					}
				break;

				case 'checkedBrand':
					if (isset($_POST)) {
						$flag = false;
						$data_sql = "";
						$total_products = "";
						$dataSon = Utils::descryptStore($_POST['dataSon']);

						if (!empty($_POST['checkedId'])) {
							$flag = true;
							$new_array = array_map(function ($value)
							{
								return '"' . strtoupper($value) . '"';
							}, $_POST['checkedId']);
							$dataChecked = implode(", ", $new_array);
							$data_sql = " AND brand IN ($dataChecked)";
							$total_products = Models_Store::getProducts($dataSon, $data_sql, $flag);
						}else{
							$total_products = Models_Store::getProducts($dataSon, $data_sql, $flag);
						}

						$products = Models_Store::getProducts($dataSon, $data_sql, $flag, 0, 10);
						$content = self::printContentProducts($products);
					    $content_grid = $content['grid'];
					    $content_single = $content['single'];

						$data = array("content_grid" => $content_grid, "content_single" => $content_single, "total_products" =>  $total_products);
						echo json_encode($data);
					}
				break;
					
				case 'loadMoreData':
					if (isset($_POST)) {
						$start = $_POST['start'];
						$perload = $_POST['perLoad'];
						$dataSon = Utils::descryptStore($_POST['dataSon']);
						$sortData = $_POST['sortData'];
						$data_sql = "";
						$flag =  false;

						if (!empty($_POST['checkedId'])) {
							$flag = true;
							$new_array = array_map(function ($value)
							{
								return '"' . strtoupper($value) . '"';
							}, $_POST['checkedId']);
							$dataChecked = implode(", ", $new_array);
						}

						switch ($sortData) {
							case 'discount':
								$data_sql = " ORDER BY CASE WHEN discount IS NOT NULL THEN 0 ELSE 1 END";
							break;	
							
							case 'recent':
								$data_sql = " ORDER BY datacreate DESC";
							break;	

							case 'price_asc':
								$data_sql = " ORDER BY price ASC";
							break;

							case 'price_desc':
								$data_sql = " ORDER BY price DESC";
							break;
						}		

						if (!empty($dataChecked)) {
							$data_sql = " AND brand IN ($dataChecked)"; 
							$flag =  true;
						}

						$products = Models_Store::getProducts($dataSon, $data_sql, $flag, $start, $perload);
						$totalProducts = Models_Store::getProducts($dataSon, $data_sql, $flag);
						$remaining = count($totalProducts) - ($start + $perload);

						$content = self::printContentProducts($products);
						$content_grid = $content['grid'];
						$content_single = $content['single'];

						$data = array("content_grid" => $content_grid, "content_single" => $content_single, "remaining" => $remaining);
						echo json_encode($data);
					}
				break;

				default:
					$data["file_js"][] = "categoria-store";
					if (!empty($_GET['urlData'])) {
						View::renderPage('Categoria', $data);
					}
				break;
			}
		}

		static public function printContentProducts($products)
		{
			$content_grid = "";
			$content_single = "";

			if(!empty($products)){
				foreach ($products as $product) {
	            	$content_grid .= '
	            		<div class="col-xl-3 col-sm-6 col-sm-4 col-adaptive">
							<div class="product-default-single-item product-color--golden" data-aos="fade-up" data-aos-delay="0">
								<div class="image-box">
									<a href="product-details-default.html" class="image-link';if(!empty($product['discount'])){$content_grid .= ' content-off" data-discount="'.$product['discount'].'% off"';}else{$content_grid .= '"';};$content_grid.='>';
										$img_product = Models_Products::selectImages($product['id_product']);
	                                    if (!empty($img_product)) {
	                                        $r_indexes = array_rand($img_product, 2);
	                                        foreach ($r_indexes as $index) {
	                                            $r_element = $img_product[$index];
	                                            $content_grid .= '<img src="'.MEDIA_ADMIN.'files/images/upload_products/'.$r_element['image'].'" alt="">';
	                                        }
	                                    }else{
	                                        $content_grid .= '<img src="'.MEDIA_ADMIN.'files/images/upload_products/empty_img.png" alt="">';
	                                    }  
									$content_grid.= '</a>
									<div class="action-link">
	                                    <div class="action-link-left">
	                                        <a href="#" data-bs-toggle="modal"
	                                            data-bs-target="#modalAddcart">Add to Cart</a>
	                                    </div>
	                                    <div class="action-link-right">
	                                        <a href="#" data-bs-toggle="modal"
	                                            data-bs-target="#modalQuickview"><i
	                                                class="icon-magnifier"></i></a>
	                                        <a href="wishlist.html"><i
	                                                class="icon-heart"></i></a>
	                                        <a href="compare.html"><i
	                                                class="icon-shuffle"></i></a>
	                                    </div>
	                                </div>
								</div>
								<div class="content">
	                                <div class="text-center">';
	                                	$content_grid.= '<h6><a class="title-product" href="#">'.$product['name_product'].'</a></h6>';
	                                	$content_grid.= '<p>'.$product['brand'].'</p>';
	if(!empty($product['cantDues'])){$content_grid.= '<div class="content-data-product no-empty"> <div class="price-product no-empty">';}else{$content_grid.= '<div class="content-data-product empty"> <div class="price-product empty">';}
	 if (!empty($product['prevPrice'])) {$content_grid.= '<del>'.SMONEY. Utils::formatMoney($product['prevPrice']).'</del>';}
	                                	$content_grid .= '<span>'.SMONEY. Utils::formatMoney($product['price']).'</span>';
								$content_grid.= '</div>';
	if (!empty($product['cantDues'])) {$content_grid.= '<span class="ml-2 text-left">'.$product['cantDues'].' cuotas '.SMONEY.Utils::formatMoney($product['priceDues']).'</span>';}
						$content_grid.= '</div>
									</div>
	                            </div>
							</div>
						</div>
	            	';

	            	$content_single .='
	            		<div class="col-12">
							<div class="product-list-single product-color--golden">
								<a href="product-details-default.html" class="product-list-img-link';if(!empty($product['discount'])){$content_single .= ' content-off" data-discount="'.$product['discount'].'% off"';}else{$content_single .= '"';};$content_single.='>';
									$img_product = Models_Products::selectImages($product['id_product']);
	                                if (!empty($img_product)) {
	                                    $r_indexes = array_rand($img_product, 2);
	                                    foreach ($r_indexes as $index) {
	                                        $r_element = $img_product[$index];
	                                        $content_single .= '<img class="img-fluid" src="'.MEDIA_ADMIN.'files/images/upload_products/'.$r_element['image'].'" alt="">';
	                                    }
	                                }else{
	                                    $content_single .= '<img class="img-fluid" src="'.MEDIA_ADMIN.'files/images/upload_products/empty_img.png" alt="">';
	                                } 
			 $content_single.= '</a>
			 					<div class="product-list-content">
	                                <h5 class="product-list-link">
	                                    <a href="product-details-default.html">'.$product['name_product'].'</a>
	                                </h5>
	                                <p>'.$product['brand'].'</p>';
					                if(!empty($product['cantDues'])) {$content_single.= '<div class="content-data-product no-empty single-list"> <div class="price-product no-empty">';}else{$content_single.= '<div class="content-data-product empty"> <div class="price-product empty">';}
					                	if(!empty($product['prevPrice'])){ $content_single .= '<del>'.SMONEY." ". Utils::formatMoney($product['prevPrice']).'</del>'; }
					                	$content_single .='<span>'.SMONEY." ". Utils::formatMoney($product['price']).'</span>';
									$content_single .= '</div>';
									if (!empty($product['cantDues'])){$content_single .= '<span class="ml-2">'.$product['cantDues'].' cuotas '.SMONEY." ". Utils::formatMoney($product['priceDues']).'</span>';
	}
									$content_single .= '</div>';
									$content_single .= '<p class="mt-3 text-justify">'.$product['desMain'].'</p>'; 
									if(empty($product['stock'])){$content_single.= '<p class="n-stock">No disponible</p>';}
									$content_single.='
														<div class="product-action-icon-link-list">
			                                                <a href="#" data-bs-toggle="modal"
			                                                    data-bs-target="#modalAddcart"
			                                                    class="btn btn-lg btn-black-default-hover">Add to
			                                                    cart</a>
			                                                <a href="#" data-bs-toggle="modal"
			                                                    data-bs-target="#modalQuickview"
			                                                    class="btn btn-lg btn-black-default-hover"><i
			                                                        class="icon-magnifier"></i></a>
			                                                <a href="wishlist.html"
			                                                    class="btn btn-lg btn-black-default-hover"><i
			                                                        class="icon-heart"></i></a>
			                                                <a href="compare.html"
			                                                    class="btn btn-lg btn-black-default-hover"><i
			                                                        class="icon-shuffle"></i></a>
			                                            </div>
													';         
	        $content_single .= '</div>
							</div>
						</div>
	            	';
				}

			}
			return array("grid" => $content_grid, "single" => $content_single);
		}
		
	}

?>