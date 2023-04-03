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
						<div class="product-details-content-area product-details--golden" data-aos="fade-up" data-aos-delay="200">
							<div class="product-details-text">
								<h4 class="title font-weight-bold"><?= strtoupper(Utils::replaceVowel($data_product['name_product'])); ?></h4>
								<div><?= $data_product['desGeneral']; ?></div>
							</div>
						</div>
			  		</div>
			  	</div>
			</div>
	    </div>
		
<?php
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