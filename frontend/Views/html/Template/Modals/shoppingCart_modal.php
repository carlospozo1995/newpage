<?php

    $total = 0;
    if(isset($_SESSION['dataCart']) AND count($_SESSION['dataCart']) > 0){
?>   
    <ul class="offcanvas-cart">
    <?php
        foreach ($_SESSION['dataCart'] as $product) {
            $total += $product['amount_product'] > $product['stock'] ? $product['stock'] * $product['price'] : $product['amount_product'] * $product['price'];
            $id_product = Utils::encriptar($product['id']);
    ?>
            <li class="offcanvas-cart-item-single">
                <div class="offcanvas-cart-item-block">
                    <a href="<?= BASE_URL."producto/".$product['url']; ?>" class="offcanvas-cart-item-image-link">
                        <img src="<?= $product['image']; ?>" alt=""
                            class="offcanvas-cart-image">
                    </a>
                    <div class="offcanvas-cart-item-content">
                        <a href="<?= BASE_URL."producto/".$product['url']; ?>" class="offcanvas-cart-item-link"><?= $product['name']; ?></a>
                        <div class="offcanvas-cart-item-details">
                            <span class="offcanvas-cart-item-details-quantity"><?= $product['amount_product'] > $product['stock'] ? $product['stock'] : $product['amount_product']; ?> x </span>
                            <span class="offcanvas-cart-item-details-price">$<?= Utils::formatMoney($product['price']); ?></span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-cart-item-delete text-right" idpr="<?=  Utils::encriptar($product['id']); ?>" option="1" onclick="delItemCart(this)">
                    <span class="offcanvas-cart-item-delete"><i class="fa fa-trash-o"></i></span>
                </div>
            </li>
    <?php
        }
    ?>
    </ul>
    <div class="offcanvas-cart-total-price">
        <span class="offcanvas-cart-total-price-text">Total:</span>
        <span class="offcanvas-cart-total-price-value">$<?= Utils::formatMoney($total); ?></span>
    </div>
    <ul class="offcanvas-cart-action-button">
        <li><a href="<?= BASE_URL; ?>carrito" class="btn btn-block btn-deep-blue">Ver Carrito</a></li>
        <li><a href="<?= BASE_URL; ?>carrito/comprar" class=" btn btn-block btn-deep-blue mt-5">Procesar Pago</a></li>
    </ul>
<?php        
    }else{
        echo '<h1 class="text-center c-p-deep-blue">Vacio</h1>';
    }
?>