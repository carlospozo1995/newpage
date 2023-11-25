	
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
		<div class="product-default-slider-section section-fluid section-inner-bg">
			<div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="section-content-gap">
								<div class="secton-content">
									<h3 class="section-title text-center c-blue-page">RECIEN AGREGADOS</h3>
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
							<div class="product-slider-default-1row default-slider-nav-arrow">
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

		$bannersCtgLarge = Models_Banners::getBanners("banners_category", "banner_name, banner_large, redirect", 2);
		if (count($bannersCtgLarge) == 4) {
		echo '<div class="banner-section">';
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

		$bannersCtgSmall = Models_Banners::getBanners("banners_category", "banner_small, redirect", 3);
		if (count($bannersCtgSmall) == 5) {
			$delayCtgSmall = 0;
			echo '<div class="banner-section section-top-gap-100">';
				echo '<div class="banner-wrapper">';
					echo '<div class="container">';
						echo '<div class="row mb-n6 section-fluid">';
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
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}

		?>

		<?php
		$fechaHoraActual = date("Y-m-d H:i:s");

		// Imprimir la fecha y hora actual en el formato deseado
		echo gettype($fechaHoraActual);
			Utils::dep($_SESSION['paymentProcessData']);
			// $url = 'https://pokeapi.co/api/v2/pokemon/300/';
			// $ch = curl_init();

			// curl_setopt($ch, CURLOPT_URL, $url);
			// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			// curl_setopt($ch, CURLOPT_HTTPGET, true);

			// $response = curl_exec($ch);

			// $pokemon = json_decode($response);

			// echo $pokemon->name;

			// -------
			// -------

			// $url2 = 'http://localhost/carlos/page/confirmarcompra?id=21566109&clientTransactionId=555e07e25a1dbfe5ca5bc9f59c6e86c9';
			// $queryString2 = parse_url($url2, PHP_URL_QUERY);
			// Utils::dep($queryString2);
			// // parse_str($queryString, $params);
			// // Utils::dep($params);

			// $url = 'https://www.w3schools.com/php/func_string_parse_str.asp';
			// // var_dump(parse_url($url));
			// $queryString = parse_url($url, PHP_URL_PATH);
			// Utils::dep(parse_url($queryString));
			

			// $nombre = "Televisor 65' Android 11 Uhd";
			// $palabras = explode(' ', $nombre);
			// $nuevoNombre = (count($palabras) > 1) ? $palabras[0] . ' ' . substr($palabras[1], 0, strlen($palabras[1]) / 2) . '...' : $nombre;
			// echo $nuevoNombre;
		?>

	</div>