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
						$id_category = Models_Store::getIdCategory($category);
						$sons_category =  Models_Categories::dataSons(end($id_category));
						$id_sons = "";

						foreach ($sons_category as $data) {
				            $id_sons .= Utils::desencriptar($data["id_son"]).",";
				        }
				        $id_sons = rtrim($id_sons, ",");
				        $id_sons = !empty($id_sons) ? $id_sons : end($id_category);

				        $products = Models_Store::getProducts($id_sons, 0, 10);
        				$total_products = Models_Store::getProducts($id_sons);

        				$content = "";
        				if(!empty($products)){
        					$product_images = self::productImages($products);
        					$content = self::printContentProducts($products, $product_images);
        				}else{
        					$content = '<div class="error-section">
							                <div class="container">
							                    <div class="row">
							                        <div class="error-form">
							                            <div style="margin-top: 50px; margin-bottom: 50px" data-aos="fade-up" data-aos-delay="0">
							                                <img style="width: 100%" src="'.MEDIA_STORE.'images/not-product.png">
							                            </div>
							                        </div>
							                    </div>
							                </div>
							            </div>';
        				}
        				$data = array("content" => $content, "sons" => Utils::encryptStore($id_sons), "total_products" =>  $total_products);
						echo json_encode($data);
					}
				break;

				case 'loadMoreProducts':
					if (isset($_POST)) {
						$sons = Utils::descryptStore($_POST['sons']);;
						$start = $_POST['start'];
						$perload = $_POST['perLoad'];
						
						$products = Models_Store::getProducts($sons, $start, $perload);
						$total_products = Models_Store::getProducts($sons);
						$remaining = count($total_products) - ($start + $perload);

						$product_images = self::productImages($products);
        				$content = self::printContentProducts($products, $product_images);

        				$data = array("content" => $content, "remaining" => $remaining);
						echo json_encode($data);
					}	
				break;

				default:
					$data["file_js"][] = "categoria-store";
					if (!empty($_GET['cat_path'])) {
						View::renderPage('Categoria', $data);
					}
				break;
			}
		}

		static public function productImages($products)
		{
			$product_images = array();
            foreach ($products as $product) {
                $img_product = Models_Products::selectImages($product['id_product']);
                if (!empty($img_product)) {
                    $r_indexes = array_rand($img_product, 2);
                    foreach ($r_indexes as $index) {
                        $r_element = $img_product[$index];
                        $product_images[$product['id_product']][] = '<img class="img-fluid" src="'.MEDIA_ADMIN.'files/images/upload_products/'.$r_element['image'].'" alt="">';
                    }
                }else{
                    $product_images[$product['id_product']][] = '<img class="img-fluid" src="'.MEDIA_ADMIN.'files/images/upload_products/empty_img.png" alt="">';
                }
            }
            return $product_images;
		}

		static public function printContentProducts($products, $product_images)
		{
			$content_grid = "";
			$content_single = "";

			foreach ($products as $product) {
			    $content_grid .= '
			        <div class="col-xl-3 col-sm-6 col-sm-4 col-adaptive">
			            <div class="product-default-single-item" data-aos="fade-up" data-aos-delay="0">
			                <div class="image-box">
			                ';

			    $content_grid .= '<a href="" class="image-link' . (!empty($product['discount']) ? ' content-off" data-discount="'.$product['discount'].'% off"' : '"') . '>';
			    // PRINT IMAGES OF PRODUCTS
			    $content_grid .= implode('', $product_images[$product['id_product']]);
			    $content_grid .= '</a>';

			    $content_grid .= '
			                    <div class="action-link">
			                        <div class="action-link-left">
			                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart">Add to Cart</a>
			                        </div>
			                        <div class="action-link-right">
			                            <a href="" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="icon-magnifier"></i></a>
			                            <a href=""><i class="icon-heart"></i></a>
			                            <a href=""><i class="icon-shuffle"></i></a>
			                        </div>
			                    </div>
			                </div>

			                <div class="content">
			                    <div class="text-center">
			                        <h6><a class="title-product" href="#">'.$product['name_product'].'</a></h6>
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
			                <a href="" class="product-list-img-link' . (!empty($product['discount']) ? ' content-off" data-discount="'.$product['discount'].'% off"' : '"') . '>';
			                    // PRINT IMAGES OF PRODUCTS
			                    $content_single .= implode('', $product_images[$product['id_product']]);
			                $content_single .= '</a>';

			                $content_single .= '<div class="product-list-content">
			                    <h5 class="product-list-link">
			                        <a href="product-details-default.html">'. $product['name_product'] .'</a>
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

			                $content_single .= (empty($product['stock'])) ? '<p class="n-stock">No disponible</p>' : '';

			                $content_single .= '<div class="product-action-icon-link-list">
			                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart" class="btn btn-lg btn-black-default-hover">Add to cart</a>
			                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview" class="btn btn-lg btn-black-default-hover"><i class="icon-magnifier"></i></a>
			                    <a href="wishlist.html" class="btn btn-lg btn-black-default-hover"><i class="icon-heart"></i></a>
			                    <a href="compare.html" class="btn btn-lg btn-black-default-hover"><i class="icon-shuffle"></i></a>
			                </div>
			            </div>
			        </div>';
			}
			return array("grid" => $content_grid, "single" => $content_single);
		}
		
	}

?>