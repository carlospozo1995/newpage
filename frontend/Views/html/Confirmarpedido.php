<?php

    $transationData = $template_vars;
    $show_order = Models_Store::showOrderClient($transationData['orderClient']);
	
    $subtotal = 0;
    $iva = 0;
    foreach ($show_order['ordered_products'] as $value) {
        $subtotal += floatval($value['price']) * intval($value['quantityOrdered']);
    }
    $iva = $subtotal * 0.12;
?>

<div data-aos="fade-up" data-aos-delay="0" class="mb-lg-10">
	<section class="mt-10 container px-8" data-aos="fade-up" data-aos-delay="0">
		<div class="text-center d-block">
			<img class="width-100-rp" src="<?= MEDIA_STORE; ?>images/thanks-buy.png" alt="">
			<p class="mt-5 mb-8 fs-16">En hasta 5 minutos, recibirá un correo electrónico en <span class="font-weight-bold"><?= $_SESSION['data_user']['email']; ?></span> con todos los detalles de su compra.</p>
		</div>
		<button class="btn btn-deep-blue font-weight-bold d-flex mx-auto">IMPRIMIR</button>
	</section>

	<section class="my-10 pt-5" data-aos="fade-up" data-aos-delay="0">
		<div class="bg-mist-white">
			<ul class="c-charcoal text-center container px-8">
				<li class="py-5 fs-18 border-bottom border-charcoal">Dentro de poco, uno de nuestros empleados se pondrá en contacto con usted para verificar su compra y proceder a su entrega.</li>
				<li class="py-5 fs-18">El período de entrega comienza a contar desde el momento en que se confirma el pago.</li>
			</ul>
		</div>
	</section>
    <section class="pt-5 container px-8" data-aos="fade-up" data-aos-delay="0">
		<div class="row">
			<div class="col-lg-6">
				<h2 class="font-weight-bold">Orden #<?= $show_order['num_order']; ?></h1>
				<p>Hecho el <?= $show_order['dateCreate']; ?></p>
				<p class="c-charcoal mt-2 mb-0"><?= $show_order['name_user'] . " " . $show_order['surname_user'];?></p>
				<p class="mb-0"><?= $show_order['email']; ?></p>
				<p class="mb-0"><?= $show_order['dni']; ?></p>
				<p><?= $show_order['phone']; ?></p>

				<p class="c-charcoal mb-0 font-weight-bold">Pagaré</p>
				<p class="mb-0 font-weight-bold">Depósito Bancario</p>
				<p class="font-weight-bold">$<?=$show_order['total'];?></p>

			</div>
			<div class="col-lg-6 text-center mt-6 mt-lg-0">
				<a class="btn btn-deep-blue font-weight-bold" href="">PEDIDOS</a>
			</div>
		</div>

		<hr>

		<div class="row mt-5">
			<div class="col-lg-5">
				<h2 class="font-weight-bold">Entrega</h2>
				<p class="mt-2 mb-0"><?=strtoupper($show_order['shipping_address']);?></p>
			</div>
			<div class="col-lg-7">
				<ul class="offcanvas-cart">
					<div class="row">
					<?php
						foreach ($show_order['ordered_products'] as $key => $value) {
					?>
						<div class="col-lg-6 mb-5">
							<li class="offcanvas-cart-item-single">
								<div class="offcanvas-cart-item-block">
									<a href="<?=BASE_URL.'producto/'.$value['url_product'];?>" class="offcanvas-cart-item-image-link">
										<img src="<?=$value['images'];?>" alt="" class="offcanvas-cart-image">
									</a>
									<div class="offcanvas-cart-item-content">
										<a href="<?=BASE_URL.'producto/'.$value['url_product'];?>" class="offcanvas-cart-item-link"><?=$value['name_product'];?></a>
										<div class="offcanvas-cart-item-details">
											<p class="mt-2 mb-0">$ <?=$value['price'];?></p>
											<p class="mb-0"><?=$value['quantityOrdered'];?> unidad</p>
										</div>
									</div>
								</div>
							</li>
						</div>
					<?php	
						}
					?>
					</div>
				</ul>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-lg-5">
			</div>

			<div class="col-lg-7">
				<div class="d-flex justify-content-between">
					<div>
						<p class="fs-16">Subtotal</p>
						<p class="fs-16">Costo envío</p>
						<p class="fs-16">Iva</p>
						<h2 class="font-weight-bold">TOTAL</h2>
					</div>
					<div>
						<p class="fs-16">$<?=Utils::formatMoney($subtotal);?></p>
						<p class="fs-16">$<?=Utils::formatMoney(floatval($show_order['shipping_cost']));?></p>
						<p class="fs-16">$<?=Utils::formatMoney($iva);?></p>
						<h2 class="font-weight-bold">$<?=Utils::formatMoney(floatval($show_order['total']));?></h2>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>