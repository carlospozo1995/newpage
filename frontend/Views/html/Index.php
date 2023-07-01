	
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

	    	// $array1 = array(
			//     array(
			//         'id' => 1,
			//         'nombre' => 'Producto 1',
			//         'price' => 10.99,
			//         'local' => 1
			//     ),
			//     array(
			//         'id' => 2,
			//         'nombre' => 'Producto 2',
			//         'price' => 20.49,
			//         'local' => 2
			//     ),
			//     array(
			//         'id' => 3,
			//         'nombre' => 'Producto 3',
			//         'price' => 15.75,
			//         'local' => 3
			//     )
			// );

			// $array2 = array(
			//     array(
			//         'id' => 2,
			//         'nombre' => 'Producto 2',
			//         'price' => 20.00
			//     ),
			//     array(
			//         'id' => 3,
			//         'nombre' => 'Producto 3',
			//         'price' => 15.75
			//     )
			// );

			// // Obtener un array asociativo con los valores de 'id' como clave
			// $array1_ids = array_column($array1, 'id');
			// $array2_ids = array_column($array2, 'id');

			// // Recorrer el primer array y verificar si hay cambios en el segundo array
			// foreach ($array1 as $key => $product) {
			//     $id = $product['id'];

			//     if (in_array($id, $array2_ids)) {
			//         // Obtener el índice del producto en el segundo array
			//         $index = array_search($id, $array2_ids);

			//         // Actualizar los campos del producto si hay cambios
			//         foreach ($product as $field => $value) {
			//             if (isset($array2[$index][$field])) {
			//                 $array1[$key][$field] = $array2[$index][$field];
			//             }
			//         }
			//     }
			// }

			// // Combinar los productos sin cambios del primer array con los productos actualizados del segundo array
			// $new_array = array_replace(array_combine($array1_ids, $array1), array_combine($array2_ids, $array2));

			// // Mostrar el nuevo array resultante
			// Utils::dep(array_values($new_array));

	    $array1 = array(
		    array(
		        'id' => '1',
		        'nombre' => 'Producto 1',
		        'price' => 10.99
		    ),
		    array(
		        'id' => 2,
		        'nombre' => 'Producto 2',
		        'price' => 20.49
		    ),
		    array(
		        'id' => 3,
		        'nombre' => 'Producto 3',
		        'price' => 15.75
		    )
		);

		$array2 = array(
		    array(
		        'id' => 2,
		        'nombre' => 'Producto 2',
		        'price' => 20.00
		    ),
		    array(
		        'id' => 3,
		        'nombre' => 'Producto 3',
		        'price' => 15.75
		    )
		);

		// Obtener un array asociativo con los valores de 'id' como clave
		$array1_ids = array_column($array1, 'id');
		$array2_ids = array_column($array2, 'id');

		// Recorrer el primer array y verificar si hay cambios en el segundo array
		foreach ($array1 as $key => $product) {
		    $id = $product['id'];

		    if (in_array($id, $array2_ids)) {
		        // Obtener el índice del producto en el segundo array
		        $index = array_search($id, $array2_ids);

		        // Actualizar el precio y/o nombre del producto si hay cambios
		        if (isset($array2[$index]['price'])) {
		            $array1[$key]['price'] = $array2[$index]['price'];
		        }
		        if (isset($array2[$index]['nombre'])) {
		            $array1[$key]['nombre'] = $array2[$index]['nombre'];
		        }
		    }
		}

		// Combinar los productos sin cambios del primer array con los productos actualizados del segundo array
		$new_array = array_merge($array1, array_diff_key($array2, array_flip($array1_ids)));
		$new_array = array_unique($new_array, SORT_REGULAR);
		// Mostrar el nuevo array resultante
		Utils::dep($new_array);

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