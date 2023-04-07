<?php
	$prod_path = $_GET['prod_path'];
	$data_product = Models_Store::getProduct($prod_path);

	if (!empty($data_product)) {

		// STORAGE OF PRODUCT IMAGES
		$img_product = Models_Products::selectImages($data_product['id_product']);
		$show_zoom = "";
		$show_vertical = "";

		if (!empty($img_product)) {
		    $cant_show = array_slice($img_product, 0, 4);
		    foreach ($cant_show as $image) {
		        $show_zoom .= '
				    <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
				        <img src="'.MEDIA_ADMIN.'files/images/upload_products/'.$image["image"].'" alt="">
				    </div>
				';

		        $show_vertical .= '
		        	<div class="product-image-thumb-single swiper-slide">
		                <img class="img-fluid" src="'.MEDIA_ADMIN.'files/images/upload_products/'.$image["image"].'" alt="">
		            </div>
		        ';
		    }   
		}
?>		
		<div class="breadcrumb-section" data-aos="fade-up" data-aos-delay="0">
            <div class="pt-4 pb-4 mb-4 bg-mist-white">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb-nav breadcrumb-nav-color--black">
                                <nav aria-label="breadcrumb">
                                    <ul class="navigation-page">
                                        <li><a href="<?= BASE_URL ?>">HOME</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start Product Details Section -->
	    <div class="product-details-section">
	        <div class="container">
	            <div class="row">
	                <div class="col-xl-5 col-lg-6">
	                    <div class="product-details-gallery-area product-details-gallery-area-vartical product-details-gallery-area-vartical-left" data-aos="fade-up" data-aos-delay="0">
	                    	<div class="product-large-image product-large-image-vartical swiper-container ml-5">
	                            <div class="swiper-wrapper">
	                            	<?php
	                            		if (!empty($show_zoom)) {
	                            			echo $show_zoom;
	                            		}else{
	                            			echo '
	                            				<div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
	                            					<img src="'.MEDIA_ADMIN.'files/images/upload_products/empty_img.png" alt="">
												</div>
	                            			';
	                            		}
	                            	?>
								</div>
	                        </div>

	                        <div class="product-image-thumb product-image-thumb-vartical swiper-container pos-relative">
                            	<div class="swiper-wrapper">
                            		<?php echo $show_vertical; ?>
                            	</div>
                            </div>
						</div>
					</div>

					<div class="col-xl-7 col-lg-6">
						<div class="product-details-content-area" data-aos="fade-up" data-aos-delay="200">
							<div class="product-details-text">
								<span>COD: <?= $data_product['code']; ?></span>
								<p class="product-brand-name">Marca: <span><?= strtoupper($data_product['brand']); ?></span></p>
								<h4 class="title"><?= strtoupper(Utils::replaceVowel($data_product['name_product'])); ?></h4>
								<p class="h5 mt-3 lh-sm c-gray"><?= $data_product['desMain']; ?></p>
								
								<div class="product-content-validation">
								<?php
									echo !empty($data_product['stock']) ? '<span>¡ QUEDAN '.$data_product['stock'].' DISPONIBLE !</span>' : '';

									echo !empty($data_product['cantDues']) ? '
										<div class="content-value-product no-empty">
											<div class="product-price-data no-empty">	
									' : '
										<div class="content-value-product empty">
											<div class="product-price-data empty">	
									';		
											echo (!empty($data_product['prevPrice'])) ? '<del>'.SMONEY. Utils::formatMoney($data_product['prevPrice']).'</del>' : '';
                                        	echo '<span>'.SMONEY.Utils::formatMoney($data_product['price']).'</span>';
										echo '</div>';

											echo (!empty($data_product['cantDues'])) ? '<span class="ml-2 text-left text-secondary">'.$data_product['cantDues'].' cuotas '.SMONEY. Utils::formatMoney($data_product['priceDues']).'</span>' : '';
									echo '</div>';
								?>
								</div>
							</div>

							<div class="product-details-variable">
								<div class="d-flex align-items-center justify-content-center">
	                                <div class="variable-single-item ">
	                                    <span>Cantidad</span>
	                                    <div class="product-variable-quantity">
	                                    	<i class="fa fa-minus pl-4 pr-2 btn-minus"></i>
											<input type="number" min="1" max="<?= $data_product['stock']; ?>" value="1">
	                                    	<i class="fa fa-plus pr-4 pl-2 btn-plus"></i>
	                                    </div>
	                                </div>

	                                <div class="product-btn-store">
	                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart"><i class="fa fa-plus"></i> Agregar al carrito</a>
	                                </div>
                            	</div>

                            	<div class="product-content-buy">
                            		<div class="product-btn-store">
	                                    <a href="#" class="btn-buy-whatsapp"><i class="fa fa-whatsapp"></i> Comprar por whatsapp</a>
	                                </div>
	                                <div class="product-btn-store">
	                                    <a href="#"><i class="fa fa-shopping-cart"></i> Comprar ahora</a>
	                                </div>
                            	</div>
							</div>

						</div>
			  		</div>
			  	</div>
			</div>
	    </div>
		
<?php

	Utils::dep(Models_Store::getNameCategories(2));
	}else{
?>
		<div class="error-section">
	        <div class="container">
	            <div class="row">
	                <div class="error--form">
	                    <div style="margin-top: 50px; margin-bottom: 50px;" data-aos="fade-up" data-aos-delay="0">
	                        <img style="width: 100%" src="<?= MEDIA_STORE; ?>images/not-product.png">
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

<?php	
	}
?>
