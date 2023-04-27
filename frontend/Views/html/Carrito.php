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

<?php
$subtotal = 0;
// $total_iva = 0; (Variable if the product contains taxes)
$total = 0;
if(isset($_SESSION['dataCart']) and count($_SESSION['dataCart']) > 0){
?>

<div class="cart-section">
    <div class="cart-table-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="table_desc">
                        <div class="table_page table-responsive">
                            <table id="table-cart">
                                <thead>
                                    <tr>
                                        <th class="product_remove">Eliminar</th>
                                        <th class="product_thumb">Imagen</th>
                                        <th class="product_name">Producto</th>
                                        <th class="product-price">Precio</th>
                                        <th class="product_quantity">Cantidad</th>
                                        <th class="product_total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($_SESSION['dataCart'] as $product) {
                                        $total_product = $product['amount_product'] > $product['stock'] ? $product['stock'] * $product['price'] : $product['amount_product'] * $product['price'];
                                        $subtotal += $total_product;
                                        // $total_iva = calculation and sum of all taxes
                                        $total = $subtotal; //add subtotal plus tax
                                        $id_product = Utils::encriptar($product['id']);
                                    ?>
                                    <tr id="<?= Utils::encriptar($product['id']); ?>">
                                        <td class="product_remove">
                                            <span class="search-click" idpr="<?= Utils::encriptar($product['id']); ?>" option="2" onclick="delItemCart(this)"><i class="fa fa-trash-o"></i></span>
                                        </td>
                                        <td class="product_thumb"><a href="<?= BASE_URL.'producto/'.$product['url']; ?>"><img
                                                    src="<?= $product['image']; ?>"
                                                    alt=""></a></td>
                                        <td class="product_name"><a href="<?= BASE_URL.'producto/'.$product['url']; ?>"><?= $product['name']; ?></a></td>
                                        <td class="product-price">$<?= Utils::formatMoney($product['price']); ?></td>
                                        <td class="product_quantity">
                                            <div class="product-variable-quantity m-auto" style="width: max-content;">
                                                <i class="fa fa-minus pl-4 pr-2 btn-minus" idpr="<?= $id_product; ?>"></i>
                                                <input id="amount-product" type="number" min="1" max="<?= $product['stock']; ?>" value="<?= $product['amount_product'] > $product['stock'] ? $product['stock'] : $product['amount_product']; ?>" idpr="<?= $id_product; ?>">
                                                <i class="fa fa-plus pr-4 pl-2 btn-plus" idpr="<?= $id_product; ?>"></i>
                                            </div>
                                        </td>
                                        <td class="product_total">$<?= Utils::formatMoney($total_product); ?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
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
                                <p class="cart_amount subtotal-cart">$<?= Utils::formatMoney($subtotal); ?></p>
                            </div>
                            <hr>
                            <div class="cart_subtotal">
                                <p>Total</p>
                                <p class="cart_amount total-cart">$<?= Utils::formatMoney($total); ?></p>
                            </div>
                            <div class="checkout_btn">
                                <a href="<?= BASE_URL; ?>carrito/procesarpago" class="btn btn-md btn-coral">Procesar pago</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
}else{
?>
<div class="empty-cart-section section-fluid">
    <div class="emptycart-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-10 offset-md-1 col-xl-6 offset-xl-3">
                    <div class="emptycart-content text-center">
                        <div class="image">
                            <img class="img-fluid" src="<?= MEDIA_STORE ?>images/empty-cart.png" alt="">
                        </div>
                        <h4 class="title">Su carrito esta vacio</h4>
                        <h6 class="sub-title">Lo sentimos... ¡No se encontró ningún artículo dentro de su carrito!</h6>
                        <a href="<?= BASE_URL; ?>" class="btn btn-lg btn-coral">Continuar comprando</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>
