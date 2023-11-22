	
	<div class="container-section">
		<!-- Start Hero Slider Section-->
	    <div class="hero-slider-section sliders-container-mbl">
	        <div class="hero-slider-active swiper-container">
	            <div class="swiper-wrapper">
	            	<?php
						$slider_category = Models_Sliders::sliderCategory(CATEGORIES_SLIDERS);
						for ($i=0; $i < count($slider_category) ; $i++) { 
					?>	
	                <div class="hero-single-slider-item swiper-slide">
	                    <div class="hero-slider-bg">
							<a href="#">
								<img src="<?= $slider_category[$i]['sliderMbl'] ?>">
							</a>
	                    </div>

	                    <div class="hero-slider-wrapper">
	                        <div class="container">
	                            <div class="row">
	                                <div class="col-auto">
	                                    <div class="hero-slider-content">
	                                        <?php 
                                            if (!empty($slider_category[$i]['sliderDesOne'])) {
                                                if (!empty($slider_category[$i]['sliderDesTwo'])) {
                                                    echo '<h4 class="subtitle">'.$slider_category[$i]['sliderDesTwo'].'</h4>';
                                                    echo '<h1 class="title">'.$slider_category[$i]['sliderDesOne'].'</h1>';
                                                    
                                                }else{
                                                    echo '<h1 class="title title-time-one">'.$slider_category[$i]['sliderDesOne'].'</h1>';
                                                }
                                            }
                                            ?>
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
						$slider_product = Models_Sliders::sliderProduct(PRODUCTS_SLIDERS);
						for ($i=0; $i < count($slider_product) ; $i++) { 
					?>	
	                <div class="hero-single-slider-item swiper-slide">
	                    <div class="hero-slider-bg">
	                    	<a href="#">
								<img src="<?= $slider_product[$i]['sliderMbl'] ?>">
	            			</a>
	                    </div>

	                    <div class="hero-slider-wrapper">
	                        <div class="container">
	                            <div class="row">
	                                <div class="col-auto">
	                                    <div class="hero-slider-content">
	                                        <?php   
                                            if (!empty($slider_product[$i]['sliderDes'])){
                                                echo '<h1 class="title title-time-one">'.$slider_product[$i]['sliderDes'].'</h1>';
                                            }
                                            ?>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <?php
						}
					?>
	            </div>

	            <!-- If we need pagination -->
	            <div class="swiper-pagination active-color-store"></div>

	            <!-- If we need navigation buttons -->
	            <div class="swiper-button-prev d-none d-lg-block"></div>
	            <div class="swiper-button-next d-none d-lg-block"></div>
	        </div>
	    </div>
	    <!-- End Hero Slider Section-->
		<br>
		
		<?php
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
		?>


		<!-- <img style="border-radius:0px 15px 0px 15px" src="<?= MEDIA_ADMIN; ?>files/images/uploads/photo_Celulares_53423db66ce81161c49beed88c844f0c.jpg" alt="">
		<img style="border-radius:0px 15px 0px 15px" src="<?= MEDIA_ADMIN; ?>files/images/uploads/photo_Cocinas_da76fc98a1d254f89c11b9a4218a702e.jpg" alt="">
		<img style="border-radius:0px 15px 0px 15px" src="<?= MEDIA_ADMIN; ?>files/images/uploads/photo_Motos_e058e37dbea0753c838a83e3e2d3674a.jpg" alt="">
		<img style="border-radius:0px 15px 0px 15px" src="<?= MEDIA_ADMIN; ?>files/images/uploads/photo_Muebles-de-sala_6f86c82e91b118269b9ba4fec4ce4444.jpg" alt="">
		<img style="border-radius:0px 15px 0px 15px" src="<?= MEDIA_ADMIN; ?>files/images/uploads/photo_Audio-y-video_2e9df534ce27d9d5f86e527a81dbf6e2.jpg" alt=""> -->
		<?php
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

		<button id="sendMail">EnvioMsm</button>
		
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		<br><br><br><br><br><br><br><br><br>
		
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		<br><br><br><br><br><br><br><br><br>

		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		<br><br><br><br><br><br><br><br><br>

		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		<br><br><br><br><br><br><br><br><br>

		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		<br><br><br><br><br><br><br><br><br>

		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		<br><br><br><br><br><br><br><br><br>

		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		<br><br><br><br><br><br><br><br><br>

		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		<br><br><br><br><br><br><br><br><br>

		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		<br><br><br><br><br><br><br><br><br>

		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		<br><br><br><br><br><br><br><br><br>

	</div>