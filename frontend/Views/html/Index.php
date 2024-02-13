	<?php
		$bannersProdLarge = Models_Banners::getBanners("banners_product", "product_id, category_id, banner_large, redirect", 2);
	?>

	<div class="container-section">
	    <div class="hero-slider-section sliders-container-mbl">
	        <div class="hero-slider-active swiper-container">
	            <div class="swiper-wrapper">
				<?php
					$sliderMblCtg = Models_Banners::getBanners("banners_category", "sliderMbl, sliderDesOne, sliderDesTwo, redirect", 1);
					$sliderMblProd = Models_Banners::getBanners("banners_product", "sliderMbl, sliderDes, redirect", 1);

					if (empty($sliderMblCtg) && empty($sliderMblProd)) {
						echo '<div class="hero-single-slider-item swiper-slide">';
							echo '<div class="hero-slider-bg">';
								echo '<img src="'.MEDIA_ADMIN.'files/images/slider-test-mbl.png">';
							echo '</div>';
						echo '</div>';
					}else{
						foreach ($sliderMblCtg as $key => $value) {
							echo '<div class="hero-single-slider-item swiper-slide">';
								echo '<div class="hero-slider-bg">';
									echo '<a href="'.BASE_URL.'categoria/'.$value['redirect'].'">';
										echo '<img src="'.MEDIA_ADMIN.'files/images/uploads/'.$value['sliderMbl'].'">';
									echo '</a>';
								echo '</div>';

								echo '<div class="hero-slider-wrapper">';
									echo '<div class="container">';
										echo '<div class="row">';
											echo '<div class="col-auto">';
												echo '<div class="hero-slider-content">';
												if (!empty($value['sliderDesOne'])) {
													if (!empty($value['sliderDesTwo'])) {
														echo '<h4 class="subtitle">'.$value['sliderDesTwo'].'</h4>';
														echo '<h1 class="title">'.$value['sliderDesOne'].'</h1>';
													}else{
														echo '<h1 class="title title-time-one">'.$value['sliderDesOne'].'</h1>';
													}
												}
												echo '</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}

						foreach ($sliderMblProd as $key => $value) {
							echo '<div class="hero-single-slider-item swiper-slide">';
								echo '<div class="hero-slider-bg">';
									echo '<a href="'.BASE_URL.'producto/'.$value['redirect'].'">';
										echo '<img src="'.MEDIA_ADMIN.'files/images/upload_products/'.$value['sliderMbl'].'">';
									echo '</a>';
								echo '</div>';

								echo '<div class="hero-slider-wrapper">';
									echo '<div class="container">';
										echo '<div class="row">';
											echo '<div class="col-auto">';
												echo '<div class="hero-slider-content">';
													if (!empty($value['sliderDes'])){
														echo '<h1 style="margin-top:-125px" class="title title-time-one">'.$value['sliderDes'].'</h1>';
													}
												echo '</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}
					}
				?>
	            </div>

	            <div class="swiper-pagination active-color-store"></div>

	            <div class="swiper-button-prev d-none d-lg-block"></div>
	            <div class="swiper-button-next d-none d-lg-block"></div>
	        </div>
	    </div>

		<!-- Start Service Section -->
		<div class="service-promo-section section-top-gap-100">
			<div class="service-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-sm-6 col-12">
							<div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="0">
								<div class="image">
									<img src="<?=MEDIA_ADMIN;?>files/images/shipment.png" alt="">
								</div>
								<div class="content">
									<h6 class="title">RÁPIDO Y SEGURO</h6>
									<p>Garantizamos entregas veloces y seguras a todo el cantón para que recibas tus pedidos sin complicaciones!</p>
								</div>
							</div>
						</div>
						
						<div class="col-lg-3 col-sm-6 col-12">
							<div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="200">
								<div class="image">
									<img src="<?=MEDIA_ADMIN;?>files/images/method-buy.png" alt="">
								</div>
								<div class="content">
									<h6 class="title">PAGO PRÁCTICO</h6>
									<p>Explora nuestras múltiples formas de pago, adaptadas a tus necesidades y preferencias!</p>
								</div>
							</div>
						</div>
						
						<div class="col-lg-3 col-sm-6 col-12">
							<div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="400">
								<div class="image">
									<img src="<?=MEDIA_ADMIN;?>files/images/information.png" alt="">
								</div>
								<div class="content">
									<h6 class="title">ATENCIÓN PERZONALIZADA</h6>
									<p>Nuestro equipo está listo para brindarte asistencia personalizada en cada paso. ¡Siempre aquí para ayudarte!</p>
								</div>
							</div>
						</div>
						
						<div class="col-lg-3 col-sm-6 col-12">
							<div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="600">
								<div class="image">
									<img src="<?=MEDIA_ADMIN;?>files/images/daimond.png" alt="">
								</div>
								<div class="content">
									<h6 class="title">FAN DESTACADO</h6>
									<p>Sé nuestro Fan Destacado al seguirnos en nuetras redes sociales. Recibe regalos y premios sorpresas como agradecimiento!</p>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<?php
		$recentProducts = Models_Store::getSpecificData("products", "id_product, name_product, brand, price, stock, prevPrice, discount, cantDues, priceDues, url", "status", "ORDER BY id_product DESC LIMIT 8");

		if (!empty($recentProducts)) {
			$product_images = array();
			foreach ($recentProducts as $product) {
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
		?>
		<div class="product-default-slider-section section-fluid section-top-gap-100">
			<div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="section-content-gap">
								<div class="secton-content">
									<h3 class="section-title text-center c-blue-page">NUEVOS PRODUCTOS</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="product-wrapper" data-aos="fade-up" data-aos-delay="0">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="new-products-slider-default-1row default-slider-nav-arrow">
								<div class="swiper-container product-default-slider-5grid-1row">
									<div class="swiper-wrapper my-2">
									<?php
									foreach ($recentProducts as $product) {
										echo '<div class="product-default-single-item product-color--pink swiper-slide border-product">';
											echo '<div class="image-box">';
												echo '<a href="'.BASE_URL."producto/".$product["url"].'" class="image-link' . (!empty($product['discount']) ? ' content-off" data-discount="'.$product['discount'].'% off"' : '"') . '>';
													echo implode('', $product_images[$product['id_product']]);
												echo '</a>';
												echo '<div class="action-link">';
													echo '<div class="action-link-right mx-auto">';
														echo '<a href="" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="icon-eye" title="Vista rápida"></i></a>';
														echo '<a href=""><i class="icon-heart" title="Añadir a favoritos"></i></a>';
													if (!empty($product['stock']) && $product['stock'] > 0) {
														echo '<a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart" class="addToCart" id="'.Utils::encriptar($product['id_product']).'"><i class="icon-basket" title="Añadir al carrito"></i></a>';
													}
													echo '</div>';
												echo '</div>';
											echo '</div>';
											
											echo '<div class="content">';
												echo '<div class="text-center">';
													echo '<h6><a class="title-product" href="'.BASE_URL."producto/".$product["url"].'">'.$product['name_product'].'</a></h6>';
													echo '<p>'.$product['brand'].'</p>';

													if (!empty($product['cantDues'])) {
													echo '<div class="content-data-product no-empty">'; 
														echo '<div class="price-product no-empty">';
													}else{
													echo '<div class="content-data-product empty">'; 
														echo '<div class="price-product empty">';
													}
															echo (!empty($product['prevPrice'])) ? '<del>'.SMONEY. Utils::formatMoney($product['prevPrice']).'</del>' : '';
															echo '<span>'.SMONEY.Utils::formatMoney($product['price']).'</span>';
														echo '</div>';

														echo (!empty($product['cantDues'])) ? '<span class="ml-2 text-left">'.$product['cantDues'].' cuotas '.SMONEY. Utils::formatMoney($product['priceDues']).'</span>' : '';
													echo '</div>';

												echo '</div>';
											echo '</div>';
										echo '</div>';
									}
									?>
									</div>
								</div>

								<div class="swiper-button-prev"></div>
								<div class="swiper-button-next"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		}
		?>

		<?php
		$bannersCtgLarge = Models_Banners::getBanners("banners_category", "banner_name, banner_large, redirect", 2);
		if (count($bannersCtgLarge) == 4) {
		echo '<div class="banner-section section-top-gap-100">';
			echo '<div class="banner-wrapper clearfix">';
				foreach ($bannersCtgLarge as $key => $value) {
		?>
					<div class="banner-single-item banner-style-4 banner-animation banner-color--deep-blue float-left img-responsive"
						data-aos="fade-up" data-aos-delay="0">
						<div class="image">
							<img class="img-fluid" src="<?= MEDIA_ADMIN; ?>files/images/uploads/<?=$value['banner_large'];?>" alt="">
						</div>
						<a href="<?=BASE_URL .'categoria/'. $value['redirect'];?>" class="content">
							<div class="inner">
								<h4 class="title"><?=$value['banner_name'];?></h4>
							</div>
							<span class="round-btn"><i class="ion-ios-arrow-thin-right"></i></span>
						</a>
					</div>
		<?php
				}
			echo '</div>';
		echo '</div>';
		}

		?>

		<?php
		$bannersCtgSmall = Models_Banners::getBanners("banners_category", "banner_small, redirect", 3);
		if (count($bannersCtgSmall) == 5) {
			$delayCtgSmall = 0;
			echo '<div class="banner-section section-top-gap-100">';
				echo '<div class="banner-wrapper">';
					echo '<div class="container">';

						echo '<div class="row" data-aos="fade-up" data-aos-delay="0">';
							echo '<div class="col-12">';
								echo '<div class="section-content-gap">';
									echo '<div class="secton-content">';
										echo '<h3 class="section-title text-center c-blue-page">CATEGORÍAS POPULARES</h3>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';

						echo '<div class="row mb-n6 section-fluid d-none d-lg-flex">';							
						foreach ($bannersCtgSmall as $key => $value) {
							echo '<div class="col-md-2-5 col-12 mb-6">';
								echo '<div class="banner-single-item banner-style-5 img-responsive" data-aos="fade-up" data-aos-delay="'.$delayCtgSmall.'">';
									echo '<a href="'.BASE_URL.'categoria/'.$value['redirect'].'" class="image banner-animation">';
										echo '<img style="border-radius: 12px" src="'.MEDIA_ADMIN.'files/images/uploads/'.$value['banner_small'].'" alt="">';
									echo '</a>';
								echo '</div>';
							echo '</div>';
							$delayCtgSmall += 200;
						}
						echo '</div>';

						echo '<div class="row d-lg-none" data-aos="fade-up" data-aos-delay="0">';
							echo '<div class="col-12">';
								echo '<div class="blog-default-slider default-slider-nav-arrow">';
									echo '<div class="swiper-container blog-slider">';
										echo '<div class="swiper-wrapper">';
										foreach ($bannersCtgSmall as $key => $value) {
											echo '<div class="blog-default-single-item swiper-slide">';
												echo '<div class="image-box d-flex justify-content-center">';
													echo '<a href="'.BASE_URL.'categoria/'.$value['redirect'].'">';
														echo '<img class="img-fluid" src="'.MEDIA_ADMIN.'files/images/uploads/'.$value['banner_small'].'" alt="">';
													echo '</a>';
												echo '</div>';
											echo '</div>';
										}
										echo '</div>';
									echo '</div>';
									
									echo '<div class="swiper-button-prev"></div>';
									echo '<div class="swiper-button-next"></div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';

					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		?>
		
		<!-- Start Banner Section -->
		<div class="banner-section section-top-gap-100">
			<div class="banner-wrapper clearfix">
				<!-- Start Banner Single Item -->
				<a href="product-details-default.html">
					<div class="banner-single-item banner-style-8 banner-animation banner-color--green float-left"
						data-aos="fade-up" data-aos-delay="0">
						<div class="image">
							<img class="img-fluid" src="<?=MEDIA_ADMIN;?>files/images/upload_products/banner-style-8-img-1.jpg" alt="">
						</div>
					</div>
				</a>
				<!-- End Banner Single Item -->
				<!-- Start Banner Single Item -->
				<a href="product-details-default.html">
					<div class="banner-single-item banner-style-8 banner-animation banner-color--green float-left"
						data-aos="fade-up" data-aos-delay="200">
						<div class="image">
							<img class="img-fluid" src="<?=MEDIA_ADMIN;?>files/images/upload_products/banner-style-8-img-2.jpg" alt="">
						</div>
					</div>
				</a>
				<!-- End Banner Single Item -->
			</div>
		</div>
		<!-- End Banner Section -->

		<?php
		if (!empty($bannersProdLarge)) {
		?>
		<div class="banner-section section-top-gap-100">
			<div class="container">
				<div class="row flex-lg-row align-items-center">
					
					<div class="col-lg-3 px-1">
						<div class="banner-wrapper d-flex justify-content-center">
							<a href="<?=BASE_URL .'producto/'. $bannersProdLarge[0]['redirect'];?>">
								<div class="banner-single-item banner-animation banner-color--green float-left"
									data-aos="fade-up" data-aos-delay="0">
									<div class="image">
										<img class="w-100" style="border-radius: 15px;" src="<?=MEDIA_ADMIN;?>files/images/upload_products/<?=$bannersProdLarge[0]['banner_large']?>" alt="">
									</div>
								</div>
							</a>
						</div>
					</div>

					<div class="col-lg-9">
						<div class="section-title-wrapper pt-5" data-aos="fade-up" data-aos-delay="0">
							<div class="container">
								<div class="row">
									<div class="col-12">
										<div>
											<div class="secton-content">
												<h3 class="section-title c-blue-page pb-5 text-center d-lg-none">PRODUCTOS RECOMENDADOS</h3>
												<h3 class="section-title c-blue-page pb-5 d-none d-lg-block">PRODUCTOS RELACIONADOS</h3>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="product-wrapper" data-aos="fade-up" data-aos-delay="0">
							<div class="container">
								<div class="row">
									<div class="col-12">
										<div class="relatedOne-product-slider-default-1row default-slider-nav-arrow">
											<div class="swiper-container product-default-slider-4grid-1row">
												<div class="swiper-wrapper my-2">
												<?php
												$relatedproductsOne = Models_Banners::getRelatedProducts($bannersProdLarge[0]['category_id'], $bannersProdLarge[0]['product_id']);
												if (!empty($relatedproductsOne)) {
													$imgProd_relatedOne = array();
													foreach ($relatedproductsOne as $product) {
														$img_product = Models_Products::selectImages($product['id_product']);
														if (!empty($img_product)) {
															$r_indexes = array_rand($img_product, 2);
															foreach ($r_indexes as $index) {
																$r_element = $img_product[$index];
																$imgProd_relatedOne[$product['id_product']][] = '<img src="'.MEDIA_ADMIN.'files/images/upload_products/'.$r_element['image'].'" alt="">';
															}
														}else{
															$imgProd_relatedOne[$product['id_product']][] = '<img src="'.MEDIA_ADMIN.'files/images/upload_products/empty_img.png" alt="">';
														}
													}
												}
												
												foreach ($relatedproductsOne as $product) {
													echo '<div class="product-default-single-item product-color--pink swiper-slide border-product">';
														echo '<div class="image-box">';
															echo '<a href="'.BASE_URL."producto/".$product["url"].'" class="image-link' . (!empty($product['discount']) ? ' content-off" data-discount="'.$product['discount'].'% off"' : '"') . '>';
																echo implode('', $imgProd_relatedOne[$product['id_product']]);
															echo '</a>';
															echo '<div class="action-link">';
																echo '<div class="action-link-right mx-auto">';
																	echo '<a href="" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="icon-eye" title="Vista rápida"></i></a>';
																	echo '<a href=""><i class="icon-heart" title="Añadir a favoritos"></i></a>';
																if (!empty($product['stock']) && $product['stock'] > 0) {
																	echo '<a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart" class="addToCart" id="'.Utils::encriptar($product['id_product']).'"><i class="icon-basket" title="Añadir al carrito"></i></a>';
																}
																echo '</div>';
															echo '</div>';
														echo '</div>';
														
														echo '<div class="content">';
															echo '<div class="text-center">';
																echo '<h6><a class="title-product" href="'.BASE_URL."producto/".$product["url"].'">'.$product['name_product'].'</a></h6>';
																echo '<p>'.$product['brand'].'</p>';
			
																if (!empty($product['cantDues'])) {
																echo '<div class="content-data-product no-empty">'; 
																	echo '<div class="price-product no-empty">';
																}else{
																echo '<div class="content-data-product empty">'; 
																	echo '<div class="price-product empty">';
																}
																		echo (!empty($product['prevPrice'])) ? '<del>'.SMONEY. Utils::formatMoney($product['prevPrice']).'</del>' : '';
																		echo '<span>'.SMONEY.Utils::formatMoney($product['price']).'</span>';
																	echo '</div>';
			
																	echo (!empty($product['cantDues'])) ? '<span class="ml-2 text-left">'.$product['cantDues'].' cuotas '.SMONEY. Utils::formatMoney($product['priceDues']).'</span>' : '';
																echo '</div>';
			
															echo '</div>';
														echo '</div>';
													echo '</div>';
												}
												?>
												</div>
											</div>

											<div class="swiper-button-prev"></div>
											<div class="swiper-button-next"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		}
		?>

		<?php
		if (!empty($bannersProdLarge) && count($bannersProdLarge) == 2) {
		?>
		<!-- <div class="banner-section section-top-gap-100">
			<div class="container">
				<div class="row flex-lg-row align-items-center">

					<div class="col-lg-9">
						<div class="section-title-wrapper pt-5" data-aos="fade-up" data-aos-delay="0">
							<div class="container">
								<div class="row">
									<div class="col-12">
										<div>
											<div class="secton-content">
												<h3 class="section-title c-blue-page pb-5 text-center d-lg-none">PRODUCTOS RECOMENDADOS</h3>
												<h3 class="section-title c-blue-page pb-5 d-none d-lg-block">PRODUCTOS RELACIONADOS</h3>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="product-wrapper" data-aos="fade-up" data-aos-delay="0">
							<div class="container">
								<div class="row">
									<div class="col-12">
										<div class="relatedTwo-product-slider-default-1row default-slider-nav-arrow" >
											<div class="swiper-container product-default-slider-4grid-1row">
												<div class="swiper-wrapper my-2">
												<?php
												$relatedproductsTwo = Models_Banners::getRelatedProducts($bannersProdLarge[1]['category_id'], $bannersProdLarge[1]['product_id']);
												if (!empty($relatedproductsTwo)) {
													$imgProd_relatedTwo = array();
													foreach ($relatedproductsTwo as $product) {
														$img_product = Models_Products::selectImages($product['id_product']);
														if (!empty($img_product)) {
															$r_indexes = array_rand($img_product, 2);
															foreach ($r_indexes as $index) {
																$r_element = $img_product[$index];
																$imgProd_relatedTwo[$product['id_product']][] = '<img src="'.MEDIA_ADMIN.'files/images/upload_products/'.$r_element['image'].'" alt="">';
															}
														}else{
															$imgProd_relatedTwo[$product['id_product']][] = '<img src="'.MEDIA_ADMIN.'files/images/upload_products/empty_img.png" alt="">';
														}
													}
												}
												
												foreach ($relatedproductsTwo as $product) {
													echo '<div class="product-default-single-item product-color--pink swiper-slide border-product">';
														echo '<div class="image-box">';
															echo '<a href="'.BASE_URL."producto/".$product["url"].'" class="image-link' . (!empty($product['discount']) ? ' content-off" data-discount="'.$product['discount'].'% off"' : '"') . '>';
																echo implode('', $imgProd_relatedTwo[$product['id_product']]);
															echo '</a>';
															echo '<div class="action-link">';
																echo '<div class="action-link-right mx-auto">';
																	echo '<a href="" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="icon-eye" title="Vista rápida"></i></a>';
																	echo '<a href=""><i class="icon-heart" title="Añadir a favoritos"></i></a>';
																if (!empty($product['stock']) && $product['stock'] > 0) {
																	echo '<a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart" class="addToCart" id="'.Utils::encriptar($product['id_product']).'"><i class="icon-basket" title="Añadir al carrito"></i></a>';
																}
																echo '</div>';
															echo '</div>';
														echo '</div>';
														
														echo '<div class="content">';
															echo '<div class="text-center">';
																echo '<h6><a class="title-product" href="'.BASE_URL."producto/".$product["url"].'">'.$product['name_product'].'</a></h6>';
																echo '<p>'.$product['brand'].'</p>';
			
																if (!empty($product['cantDues'])) {
																echo '<div class="content-data-product no-empty">'; 
																	echo '<div class="price-product no-empty">';
																}else{
																echo '<div class="content-data-product empty">'; 
																	echo '<div class="price-product empty">';
																}
																		echo (!empty($product['prevPrice'])) ? '<del>'.SMONEY. Utils::formatMoney($product['prevPrice']).'</del>' : '';
																		echo '<span>'.SMONEY.Utils::formatMoney($product['price']).'</span>';
																	echo '</div>';
			
																	echo (!empty($product['cantDues'])) ? '<span class="ml-2 text-left">'.$product['cantDues'].' cuotas '.SMONEY. Utils::formatMoney($product['priceDues']).'</span>' : '';
																echo '</div>';
			
															echo '</div>';
														echo '</div>';
													echo '</div>';
												}
												?>
												</div>
											</div>

											<div class="swiper-button-prev"></div>
											<div class="swiper-button-next"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-3 px-1">
						<div class="banner-wrapper d-flex justify-content-center">
							<a href="<?=BASE_URL .'producto/'. $bannersProdLarge[1]['redirect'];?>">
								<div class="banner-single-item banner-animation banner-color--green float-left"
									data-aos="fade-up" data-aos-delay="0">
									<div class="image">
										<img class="w-100" style="border-radius: 15px;" src="<?=MEDIA_ADMIN;?>files/images/upload_products/<?=$bannersProdLarge[1]['banner_large']?>" alt="">
									</div>
								</div>
							</a>
						</div>
					</div>	
				</div>
			</div>
		</div> -->
		<?php
		}
		?>

		<!-- <div class="banner-section section-inner-bg">
			<div class="col-12" data-aos="fade-up" data-aos-delay="0">
				<div>
					<div class="secton-content">
						<h3 class="section-title text-center c-blue-page">TEST</h3>
					</div>
				</div>
			</div>
		</div> -->

		<div class="banner-section section-top-gap-100">
			
		</div>
		
	</div>