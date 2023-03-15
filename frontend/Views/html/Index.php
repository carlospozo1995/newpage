	
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
							<img src="<?= $slider_category[$i]['sliderMbl'] ?>">
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
	                                        		echo '<a href="product-details-default.html" class="btn btn-lg btn-outline-aqua">view </a>';
	                                        	}else{
	                                        		echo '<h1 class="title title-time-one">'.$slider_category[$i]['sliderDesOne'].'</h1>';
	                                        		echo '<a href="product-details-default.html" class="btn btn-lg btn-outline-aqua a-time-two">view </a>';
	                                        	}
	                                        }else{
	                                        	echo '<a href="product-details-default.html" class="btn btn-lg btn-outline-aqua a-time-one">view </a>';
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
							<img src="<?= $slider_product[$i]['sliderMbl'] ?>">
	                    </div>

	                    <div class="hero-slider-wrapper">
	                        <div class="container">
	                            <div class="row">
	                                <div class="col-auto">
	                                    <div class="hero-slider-content">
	                                        <?php   
	                                        if (!empty($slider_product[$i]['sliderDes'])){
	                                            echo '<h1 class="title title-time-one">'.$slider_product[$i]['sliderDes'].'</h1>';
	                                            echo ' <a href="product-details-default.html" class="btn btn-lg btn-outline-aqua a-time-two">shop
	                                            now </a>';
	                                        }else{
	                                            echo '<a href="product-details-default.html" class="btn btn-lg btn-outline-aqua a-time-one">shop
	                                            now </a>';
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
	            <div class="swiper-pagination active-color-aqua"></div>

	            <!-- If we need navigation buttons -->
	            <div class="swiper-button-prev d-none d-lg-block"></div>
	            <div class="swiper-button-next d-none d-lg-block"></div>
	        </div>
	    </div>
	    <!-- End Hero Slider Section-->

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

	
	<?php

	echo '<div id="cont-general">';
		$products = Models_Store::getProductsLimit(0, 3);
		$totalProducts = Models_Store::countProducts();

	foreach ($products as $product) {
	    echo '<div style="border:1px solid red;width: max-content">';
	    echo '<p>'.$product['name_product'].'</p>';
	    echo '<p>'.$product['price'].'</p>';
	    echo '</div>';    
	}

	echo '</div>';

	if (count($totalProducts) < 3) {
	    echo '<button style="border: 2px solid blue; padding: 10px; background: black; color: wheat; width: max-content;" id="load-morep">ver mas</button>';
	}
	?>
	
