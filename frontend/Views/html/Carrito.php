<div class="breadcrumb-section" data-aos="fade-up" data-aos-delay="0">
    <div class="pt-4 pb-4 mb-4 bg-mist-white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-nav breadcrumb-nav-color--black">
                        <nav aria-label="breadcrumb">
                            <ul class="navigation-page">
                            	<li><a href="<?= BASE_URL; ?>">INICIO</a></li>
                                <li class="active" aria-current="page">CARRITO</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ...:::: Start Cart Section:::... -->
<div class="cart-section">
    <!-- Start Cart Table -->
    <div class="cart-table-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="table_desc">
                        <div class="table_page table-responsive">
                            <table>
                                <!-- Start Cart Table Head -->
                                <thead>
                                    <tr>
                                        <th class="product_thumb">Imagen</th>
                                        <th class="product_name">Producto</th>
                                        <th class="product-price">Precio</th>
                                        <th class="product_quantity">Cantidad</th>
                                        <th class="product_total">Total</th>
                                    </tr>
                                </thead> <!-- End Cart Table Head -->
                                <tbody>
                                    <!-- Start Cart Single Item-->
                                    <tr>
                                        <td class="product_thumb"><a href="product-details-default.html"><img
                                                    src="assets/images/product/default/home-1/default-2.jpg"
                                                    alt=""></a></td>
                                        <td class="product_name"><a href="product-details-default.html">Handbags
                                                justo</a></td>
                                        <td class="product-price">$90.00</td>
                                        <td class="product_quantity">
                                        	<div class="product-variable-quantity m-auto" style="width: max-content;">
		                                    	<i class="fa fa-minus pl-4 pr-2 btn-minus"></i>
												<input id="amount-product" type="number" min="1" max="10" value="1">
		                                    	<i class="fa fa-plus pr-4 pl-2 btn-plus"></i>
	                                    	</div>
                                        </td>
                                        <td class="product_total">$180.00</td>
                                    </tr> <!-- End Cart Single Item-->
                            </table>
                        </div>
                    </div>
                </div>

	            <div class="col-lg-4 col-md-4">
	                <div class="coupon_code right" data-aos="fade-up" data-aos-delay="400">
	                    <h3 class="text-center">Total del carrito</h3>
	                    <div class="coupon_inner">
	                        <div class="cart_subtotal">
	                            <p>Subtotal</p>
	                            <p class="cart_amount">$215.00</p>
	                        </div>
	                        <div class="cart_subtotal ">
	                            <p>Envio</p>
	                            <p class="cart_amount">$255.00</p>
	                        </div>
	                        <hr>

	                        <div class="cart_subtotal">
	                            <p>Total</p>
	                            <p class="cart_amount">$215.00</p>
	                        </div>
	                        <div class="checkout_btn">
	                            <a href="#" class="btn btn-md btn-coral">Procesar pago</a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
        </div>
    </div> <!-- End Cart Table -->

</div>