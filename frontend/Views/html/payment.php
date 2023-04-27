<?php
$subtotal = 0;
// $total_iva = 0; (Variable if the product contains taxes)
$total = 0;

foreach ($_SESSION['dataCart'] as $product) {
    $total_product = $product['amount_product'] > $product['stock'] ? $product['stock'] * $product['price'] : $product['amount_product'] * $product['price'];
    $subtotal += $total_product;
    // $total_iva = calculation and sum of all taxes
    $total = $subtotal; //add subtotal plus tax
    $id_product = Utils::encriptar($product['id']);
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
                            	<li><a href="<?= BASE_URL; ?>">INICIO</a></li>
                                <li class="active" aria-current="page">PROCESAR PAGO</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="cart-section">
    <div class="cart-table-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    
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
                            <?php
                            // if (isset($_SESSION['login'])) {
                            ?>
                            <div class="checkout_btn">
                                <a href="<?= BASE_URL; ?>carrito/procesarpago" class="btn btn-md btn-coral">Finalizar compra</a>
                            </div>		
                            <?php
                            // }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>