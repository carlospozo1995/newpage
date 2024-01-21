<?php

	require URL_LOCAL . 'vendor/autoload.php';	

	class Controller_Resultado{
		
		public function buildPage()
		{	
			Utils::sessionStartStore();
			
			$data = array();
			$action = Utils::getParam("action", "");

			$client = \Algolia\AlgoliaSearch\SearchClient::create(
				$_ENV['ALGOLIA_APP_ID'],
				$_ENV['ALGOLIA_ADMIN_API_KEY']
			);

			$indexChange = 'index_products';

			switch ($action) {
				case 'orderProducts':
					if (isset($_POST)) {
						$search_value = $_POST['search'];
						$filter_brand = !empty($_POST['selectBrands']) ? 'brand:' . implode(' OR brand:', array_map(function($brand) {
							return '"' . $brand . '"';
						}, $_POST['selectBrands'])) : '';
						
						$order = $_POST['selectOrder'];
						$price_min = isset($_POST['price_min']) ? $_POST['price_min'] : "";
						$price_max = isset($_POST['price_max']) ? $_POST['price_max'] : "";

						switch ($order) {
							case 'discount':
								$indexChange = 'replica_products_discount_desc';
							break;

							case 'recent':
								$indexChange = 'replica_products_datacreate_desc';
							break;

							case 'price_asc':
								$indexChange = 'replica_products_price_asc';
							break;

							case 'price_desc':
								$indexChange = 'replica_products_price_desc';
							break;
						}
						
						$index = $client->initIndex($indexChange);

						$results = $index->search($search_value, [
							'page' => 0,
							'hitsPerPage' => 10,
							'filters' => $filter_brand,
							'numericFilters' => !empty($price_min) && !empty($price_max) ? 'price: '.$price_min. ' TO '.$price_max : '',		
							'facets' => ["brand", "price"],
						]);

						$products = $results['hits'];

						$products_img = self::productImages($products);
        				$content = self::printContentProducts($products, $products_img);

						$data = array("content" => $content, "total_p" => $results['nbHits'], "price" => isset($results['facets_stats']['price']) ? $results['facets_stats']['price'] : "");
						echo json_encode($data);
					}
				break;

				case 'loadMoreProducts':
                    if (isset($_POST)) {
						$search_value = $_POST['search'];
						$page = $_POST['page'];

						$order = $_POST['selectOrder'];
						$filter_brand = !empty($_POST['selectBrands']) ? 'brand:' . implode(' OR brand:', array_map(function($brand) {
							return '"' . $brand . '"';
						}, $_POST['selectBrands'])) : '';
						$price_min = $_POST['price_min'];
						$price_max = $_POST['price_max'];

						switch ($order) {
							case 'discount':
								$indexChange = 'replica_products_discount_desc';
							break;

							case 'recent':
								$indexChange = 'replica_products_datacreate_desc';
							break;

							case 'price_asc':
								$indexChange = 'replica_products_price_asc';
							break;

							case 'price_desc':
								$indexChange = 'replica_products_price_desc';
							break;
						}

						$index = $client->initIndex($indexChange);
						$results = $index->search($search_value, [
							'page' => $page,
							'hitsPerPage' => 10,
							'filters' => $filter_brand,
							'numericFilters' => 'price: '.$price_min. ' TO '.$price_max,		
							'facets' => ["brand", "price"],
						]);

						$products = $results['hits'];

						$products_img = self::productImages($products);
        				$content = self::printContentProducts($products, $products_img);

						$data = array("content" => $content, "nbPage" => $results['nbPages']);
						echo json_encode($data);
					}
                break;

				case 'rangePriceProducts':
					if (isset($_POST)) {
						$search_value = $_POST['search'];
						$order = $_POST['selectOrder'];
						$filter_brand = !empty($_POST['selectBrands']) ? 'brand:' . implode(' OR brand:', array_map(function($brand) {
							return '"' . $brand . '"';
						}, $_POST['selectBrands'])) : '';
						$price_min = $_POST['price_min'];
						$price_max = $_POST['price_max'];

						switch ($order) {
							case 'discount':
								$indexChange = 'replica_products_discount_desc';
							break;

							case 'recent':
								$indexChange = 'replica_products_datacreate_desc';
							break;

							case 'price_asc':
								$indexChange = 'replica_products_price_asc';
							break;

							case 'price_desc':
								$indexChange = 'replica_products_price_desc';
							break;
						}
						
						$index = $client->initIndex($indexChange);

						$results = $index->search($search_value, [
							'page' => 0,
							'hitsPerPage' => 10,
							'filters' => $filter_brand,
							'numericFilters' => 'price: '.$price_min. ' TO '.$price_max,		
							'facets' => ["brand", "price"],
						]);

						$products = $results['hits'];

						$products_img = self::productImages($products);
        				$content = self::printContentProducts($products, $products_img);

						$data = array("content" => $content, "total_p" => $results['nbHits']);
						echo json_encode($data);
					}
				break;

				default:
					$search_value = $_GET['search'];
					
					$index = $client->initIndex($indexChange);
					$results = $index->search($search_value, [
						'page' => 0,
						'hitsPerPage' => 10,
						'facets' => ["brand", "price"]
					]);

					$variable["file_js"][] = "resultado";
					$variable["search"] = $search_value;
					$variable["results"] = $results;
					
					View::renderPage('Resultado', $variable);	

				break;
			}
		}

		static public function productImages($products)
		{
			$products_img = array();
            foreach ($products as $product) {
                $img_product = Models_Products::selectImages($product['objectID']);
                if (!empty($img_product)) {
                    $r_indexes = array_rand($img_product, 2);
                    foreach ($r_indexes as $index) {
                        $r_element = $img_product[$index];
						$image_path = URL_LOCAL."Assets/admin/files/images/upload_products/".$r_element['image'];

                        if (file_exists($image_path)) {
                            $products_img[$product['objectID']][] = '<img class="img-fluid" src="'.MEDIA_ADMIN.'files/images/upload_products/'.$r_element['image'].'" alt="">';
                        } else {
                            $products_img[$product['objectID']][] = '<img class="img-fluid" src="'.MEDIA_ADMIN.'files/images/upload_products/empty_img.png" alt="">';
                        }
                    }
                }else{
                    $products_img[$product['objectID']][] = '<img class="img-fluid" src="'.MEDIA_ADMIN.'files/images/upload_products/empty_img.png" alt="">';
                }
            }
            return $products_img;
		}

		static public function printContentProducts($products, $products_img)
		{
			$content_grid = "";
			$content_single = "";

			foreach ($products as $product) {
			    $content_grid .= '
			        <div class="col-xl-3 col-sm-6 col-sm-4 col-adaptive">
			            <div class="product-default-single-item" data-aos="fade-up" data-aos-delay="0">
			                <div class="image-box">
			                ';

			    $content_grid .= '<a href="'.BASE_URL.'producto/'.$product['url'].'" class="image-link' . (!empty($product['discount']) ? ' content-off" data-discount="'.$product['discount'].'% off"' : '"') . '>';
			    // PRINT IMAGES OF PRODUCTS
			    $content_grid .= implode('', $products_img[$product['objectID']]);
			    $content_grid .= '</a>';

			    $content_grid .= '
			                    <div class="action-link">
			                        <div class="action-link-right mx-auto">
			                            <a href="" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="icon-eye" title="Vista rápida"></i></a>
			                            <a href=""><i class="icon-heart" title="Añadir a favoritos"></i></a>';
			    if (!empty($product['stock']) && $product['stock'] > 0) {
    				$content_grid .= '<a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart" class="addToCart" id="'.Utils::encriptar($product['objectID']).'"><i class="icon-basket" title="Añadir al carrito"></i></a>';
				}
			    $content_grid .= '
			                        </div>
			                    </div>
			                </div>

			                <div class="content">
			                    <div class="text-center">
			                        <h6><a class="title-product" href="'.BASE_URL.'producto/'.$product['url'].'">'.$product['name_product'].'</a></h6>
			                        <p>'.$product['brand'].'</p>
			                ';

			    if (!empty($product['cantDues'])) {
			        $content_grid .= '<div class="content-data-product no-empty">'; 
			        $content_grid .= '<div class="price-product no-empty">';
			    } else {
			        $content_grid .= '<div class="content-data-product empty">'; 
			        $content_grid .= '<div class="price-product empty">';
			    }

			    $content_grid .= (!empty($product['prevPrice'])) ? '<del>'.SMONEY. Utils::formatMoney($product['prevPrice']).'</del>' : '';
			    $content_grid .= '<span>'.SMONEY.Utils::formatMoney($product['price']).'</span>';
			    $content_grid .= '</div>';

			    $content_grid .= (!empty($product['cantDues'])) ? '<span class="ml-2 text-left">'.$product['cantDues'].' cuotas '.SMONEY. Utils::formatMoney($product['priceDues']).'</span>' : '';
			    $content_grid .= '</div>';
			    $content_grid .= '</div></div></div></div>';

			    $content_single .= '
			        <div class="col-12">
			            <div class="product-list-single">
			            	<a href="'.BASE_URL.'producto/'.$product['url'].'" class="product-list-img-link' . (!empty($product['discount']) ? ' content-off" data-discount="'.$product['discount'].'% off"' : '"') . '>';
			                    // PRINT IMAGES OF PRODUCTS
			                    $content_single .= implode('', $products_img[$product['objectID']]);
			                $content_single .= '</a>';

			                $content_single .= '<div class="product-list-content">
			                	<h5 class="product-list-link">
			                        <a href="'.BASE_URL.'producto/'.$product['url'].'">'. $product['name_product'] .'</a>
			                    </h5>
			                    <p>'. $product['brand'] .'</p>';

			                    if (!empty($product['cantDues'])) {
				                    $content_single .= '<div class="content-data-product no-empty single-list">'; 
				                    $content_single .= '<div class="price-product no-empty">';
				                } else {
				                    $content_single .= '<div class="content-data-product empty">'; 
				                    $content_single .= '<div class="price-product empty">';
				                }
			                
				                $content_single .= (!empty($product['prevPrice'])) ? '<del>'.SMONEY. Utils::formatMoney($product['prevPrice']).'</del>' : '';
				                $content_single .= '<span>'.SMONEY.Utils::formatMoney($product['price']).'</span>';
				                $content_single .= '</div>';

				                $content_single .= (!empty($product['cantDues'])) ? '<span class="ml-2 text-left">'.$product['cantDues'].' cuotas '.SMONEY. Utils::formatMoney($product['priceDues']).'</span>' : '';
				                $content_single .= '</div>';
				                $content_single .= '<p class="mt-3 text-justify">'. $product['desMain'] .'</p>';
				                $content_single .= (empty($product['stock']) || $product['stock'] <= 0) ? '<p class="n-stock">No disponible</p>' : '';

				                $content_single .= '<div class="product-action-icon-link-list">
				                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview" class="btn btn-lg btn-black-default-hover" title="Vista rápida">
                                    	<i class="icon-eye" ></i>
                                    </a>
                                    <a href="wishlist.html" class="btn btn-lg btn-black-default-hover" title="Añadir a favoritos">
                                        <i class="icon-heart"></i>
                                    </a>';
                                if (!empty($product['stock']) && $product['stock'] > 0) {
				    				$content_single .= '<a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart" class="btn btn-lg btn-black-default-hover addToCart" id="'.Utils::encriptar($product['objectID']).'" title="Añadir al carrito">
                                    		<i class="icon-basket"></i>
                                        </a>';
								}
                                $content_single .= '
				                </div>
				            </div>
			        	</div>    
			        </div>';
			}
			return array("grid" => $content_grid, "single" => $content_single);
		}
		

		static public function settingsAlgolia($replica, $order) {
			$replica->setSettings([
				'ranking' => [
					$order,
					'typo',
					'geo',
					'words',
					'filters',
					'proximity',
					'attribute',
					'exact',
					'custom'
				]
			]);
		}
	}

?>


