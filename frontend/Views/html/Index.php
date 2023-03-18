	
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
$productos = array(
    array("nombre" => "Producto 1", "precio" => 10, "descuento" => 0.1),
    array("nombre" => "Producto 2", "precio" => 20, "descuento" => 0.2),
    array("nombre" => "Producto 3", "precio" => 30, "descuento" => null),
    array("nombre" => "Producto 4", "precio" => 40, "descuento" => 0.3),
    array("nombre" => "Producto 5", "precio" => 50, "descuento" => null),
    array("nombre" => "Producto 6", "precio" => 60, "descuento" => 0.4),
    array("nombre" => "Producto 7", "precio" => 70, "descuento" => null),
    array("nombre" => "Producto 8", "precio" => 80, "descuento" => 0.5),
    array("nombre" => "Producto 9", "precio" => 90, "descuento" => null),
    array("nombre" => "Producto 10", "precio" => 100, "descuento" => 0.6)
);

// Función de comparación
function comparar($producto1, $producto2) {
    // Si ambos productos tienen descuento
    if ($producto1['descuento'] !== null && $producto2['descuento'] !== null) {
        // Ordenar en función del descuento
        return $producto2['descuento'] - $producto1['descuento'];
    }
    // Si solo el primer producto tiene descuento
    else if ($producto1['descuento'] !== null && $producto2['descuento'] === null) {
        return -1; // El primer producto va primero en el orden
    }
    // Si solo el segundo producto tiene descuento
    else if ($producto1['descuento'] === null && $producto2['descuento'] !== null) {
        return 1; // El segundo producto va primero en el orden
    }
    // Si ninguno de los productos tiene descuento, ordenar en función del precio
    else {
        return $producto1['precio'] - $producto2['precio'];
    }
}

// Ordenar el array de productos
usort($productos, 'comparar');

// Mostrar el array de productos ordenado
print_r($productos);
?>
