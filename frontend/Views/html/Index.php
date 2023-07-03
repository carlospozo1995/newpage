	
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

	    <?php

		$array1 = array(
		    array(
	            'id' => 'f5758148488669b5dbb09340b774e69b',
	            'code' => '133644000',
	            'name' => 'Cocina A Gas 4 Quemadores Em5100eb0',
	            'price' => '2',
	            'stock' => '5',
	            'url' => 'cocina-a-gas-4-quemadores-em5100eb0',
	            'image' => 'http://localhost/carlos/page/Assets/admin/files/images/upload_products/imgRef_1_c7f844dc4796aca33627688918b5222b.jpg',
	            'amount_product' => '3'
		        ),
		    array(
	            'id' => '87439af5fb123070f781d885084b90f9',
	            'code' => '39220',
	            'name' => 'Minicomponente 1 cuerpo JBLPARTYBOX710AM',
	            'price' => '1',
	            'stock' => '4',
	            'url' => 'minicomponente-1-cuerpo-jblpartybox710am',
	            'image' => 'http://localhost/carlos/page/Assets/admin/files/images/upload_products/imgRef_2_bceddd68f307dcd05b53406dfba397c4.jpg',
	            'amount_product' => '2'
		        ),
			array(
	            'id' => 'c355510a7978ca55ea6471512b6b2dae',
	            'code' => '15252000556',
	            'name' => 'Audifonos C/microfono negro  H200',
	            'price' => '25.01',
	            'stock' => '3',
	            'url' => 'audifonos-c-microfono-negro-h200',
	            'image' => 'http://localhost/carlos/page/Assets/admin/files/images/upload_products/empty_img.png',
	            'amount_product' => '1'
		    )
		);

		$array2 = array(
			array(
				'id' => 'f5758148488669b5dbb09340b774e69b',
				'code' => '133644000',
				'name' => 'Cocina A Gas 4 Quemadores Em5100eb0',
				'price' => '2',
				'stock' => '2',
				'url' => '',
				'image' => 'http://localhost/carlos/page/Assets/admin/files/images/upload_products/imgRef_1_c7f844dc4796aca33627688918b5222b.jpg',
				'amount_product' => '2'
			),
			array(
				'id' => '87439af5fb123070f781d885084b90f9',
				'code' => '39220',
				'name' => 'Minicomponente 1 cuerpo JBLPARTYBOX710AM',
				'price' => '3',
				'stock' => '4',
				'url' => '',
				'image' => 'http://localhost/carlos/page/Assets/admin/files/images/upload_products/imgRef_2_bceddd68f307dcd05b53406dfba397c4.jpg',
				'amount_product' => '2'
			)
		);
// Crear un nuevo array combinando los elementos de ambos arrays
$newArray = array();

							// Indexar los elementos del array2 por ID
							$indexedArray2 = array();
							foreach ($array2 as $item2) {
							    $indexedArray2[$item2['id']] = $item2;
							}

							// Recorrer los elementos del array1
							foreach ($array1 as $item1) {
							    if (isset($indexedArray2[$item1['id']])) {
							        $item2 = $indexedArray2[$item1['id']];

							        // Comparar el stock y precio
							        if ($item1['stock'] != $item2['stock'] || $item1['price'] != $item2['price']) {
							            // Si hay cambios, agregar el elemento del array2 al nuevo array
							            $newArray[] = $item2;
							        } else {
							            // Si no hay cambios, agregar el elemento del array1 al nuevo array
							            $newArray[] = $item1;
							        }
							    } else {
							        // Si el elemento del array1 no existe en el array2, agregarlo al nuevo array
							        $newArray[] = $item1;
							    }
							}

							// Agregar los elementos restantes del array2 al nuevo array
							foreach ($array2 as $item2) {
							    if (!isset($indexedArray2[$item2['id']])) {
							        $newArray[] = $item2;
							    }
							}


// Imprimir el nuevo array
Utils::dep($newArray);




	    ?>




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