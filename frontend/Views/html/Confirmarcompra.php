	
<?php
	$transationData = $template_vars;
	$show_order = Models_Store::showOrderClient($transationData['clientTransactionId']);
?>

<div data-aos="fade-up" data-aos-delay="0" class="mb-lg-10">
	<section class="mt-10 container px-8" data-aos="fade-up" data-aos-delay="0">
		<div class="text-center d-block">
			<img class="width-100-rp" src="<?= MEDIA_STORE; ?>images/thanks-buy.png" alt="">
			<p class="mt-5 mb-8 fs-16">En hasta 5 minutos, recibirá un correo electrónico en <span class="font-weight-bold"><?= $_SESSION['data_user']['email']; ?></span> con todos los detalles de su compra.
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
		<?php
		Utils::dep($show_order);
		// foreach ($show_order['ordered_products'] as $key => $value) {
		// 	echo $value['price'];
		// 	echo '<br>';
		// 	echo $value['name_product'];
		// 	echo '<br>';
		// }

		
		?>
	</section>
</div>




