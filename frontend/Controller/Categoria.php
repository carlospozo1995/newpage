<?php

	class Controller_Categoria{
		
		public function buildPage()
		{	

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
			            $products = Models_Store::getProducts("$id_sons");
			            foreach ($products as $product) {
?>
							 <div class="col-xl-3 col-sm-6 col-sm-4 col-12">
                                <!-- Start Product Default Single Item -->
                                <div class="product-default-single-item product-color--golden"
                                    data-aos="fade-up" data-aos-delay="0">
                                    <div class="image-box">
                                        <a href="product-details-default.html" class="image-link">
                                            <?php
                                            $img_product = Models_Products::selectImages($product['id_product']);
                                            if (!empty($img_product)) {
                                                $r_indexes = array_rand($img_product, 2);
                                                foreach ($r_indexes as $index) {
                                                    $r_element = $img_product[$index];
                                                    echo '<img src="'.MEDIA_ADMIN.'files/images/upload_products/'.$r_element['image'].'" alt="">';
                                                }
                                            }else{
                                                echo '<img src="'.MEDIA_ADMIN.'files/images/upload_products/empty_img.png" alt="">';
                                            }  
                                            ?>
                                        </a>
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
                                        <div class="text-center">
                                            <h6><a class="title-product" href="#"><?= $product['name_product']; ?></a></h6>
                                            <p><?= $product['brand']; ?></p>
                                            
                                        <?php if (!empty($product['cantDues'])){
                                            echo '<div class="content-data-product no-empty">'; echo '<div class="price-product no-empty">';
                                        }else{ echo '<div class="content-data-product empty">'; echo '<div class="price-product empty">'; }?>
                                                <?php if(!empty($product['prevPrice'])){ echo '<del>'.SMONEY ." ". Utils::formatMoney($product['prevPrice']).'</del>'; }?>
                                                    <span class=""><?= SMONEY ." ". Utils::formatMoney($product['price']) ;?></span>
                                                </div>
                                                <?php if (!empty($product['cantDues'])){ ?>
                                                    <span class="ml-2"><?= $product['cantDues']; ?> cuotas <?= SMONEY ." ". Utils::formatMoney($product['priceDues']);?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Default Single Item -->
                            </div>
<?php
						}
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
		
	}

?>