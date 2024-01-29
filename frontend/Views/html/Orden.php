<?php
    $order = $template_vars;
?>

<div class="content-wrapper">
    
    <section class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
         		<div class="col-sm-6 d-flex">
            		<h1><?= $section_name; ?></h1>
                </div>
          	</div>
        </div>
    </section>

    <section class="content">
      	<div class="container-fluid">
        	<div class="row">
          		<div class="col-md-12">
            		<div class="card">
              			<div class="card-body">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <h3>#<?=$order['num_order'];?></h2>
                                </div>
                                <div class="col-6">
                                    <h4 class="text-right">Fecha: <?=date('d/m/Y', strtotime($order['dateCreate']));?></h2>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <address>
                                        <strong><h5><?=$order['name_user']." ".$order['surname_user'];?></h5></strong>
                                        <span><strong>Envio:</strong> <?=$order['shipping_address'];?></span>
                                        <br>
                                        <span><strong>Tel:</strong> <?=$order['phone'];?></span>
                                        <br>
                                        <span><strong>Email:</strong> <?=$order['email'];?></span>
                                    </address>
                                </div>
                                <div class="col-4">
                                    <address>
                                        <span><strong>Pago:</strong> <?= $order['payment_type_id'] ==1 ? "Tarjeta" : "Transferencia"; ?></span>
                                        <br>
                                        <span><strong>Estado-pago:</strong> <?=$order['status'];?></span>
                                        <br>
                                        <?php
                                        if (!empty($order['reviewed_date'])) {
                                            $status = empty($order['shipping_date']) && empty($order['delivery_date']) ? "Revisado" : (!empty($order['shipping_date']) && empty($order['delivery_date']) ? "Enviado" : (!empty($order['shipping_date']) && !empty($order['delivery_date']) ? "Entregado" : '<span class="spinner-border spinner-border-sm"></span>'));
                                        } else {
                                            $status = '<span class="spinner-border spinner-border-sm"></span>';
                                        }
                                        ?>
                                        <span><strong>Estado-envio: </strong> <?=$status;?></span>
                                        <br>
                                        <span><strong>Total:</strong> <?=SMONEY." ".Utils::formatMoney($order['total']);?></span>
                                    </address>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <table id="tablePedidos" class="table_order table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Importe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $subtotal = 0;
                                    $iva = 0;
                                    foreach ($order['ordered_products'] as $key => $value) {
                                        $subtotal += $value['price'] * $value['quantityOrdered'];
                                        $iva = $subtotal * 0.12;
                                        echo '<tr>';
                                            echo '<td>'.$value['name_product'].'</td>';
                                            echo '<td>'.SMONEY." ".Utils::formatMoney($value['price']).'</td>';
                                            echo '<td>'.$value['quantityOrdered'].'</td>';
                                            echo '<td>'.SMONEY." ".Utils::formatMoney($value['price'] * $value['quantityOrdered']).'</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-right">Sub-Total:</th>
                                            <td class="text-right"><?= SMONEY." ".Utils::formatMoney($subtotal); ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Envio:</th>
                                            <td class="text-right"><?= SMONEY." ".Utils::formatMoney($order['shipping_cost']); ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Iva:</th>
                                            <td class="text-right"><?=SMONEY." ".Utils::formatMoney($iva);?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Total:</th>
                                            <td class="text-right"><?=SMONEY." ".Utils::formatMoney($subtotal + $iva);?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
                            </div>
                        </div>
	        		</div>
        		</div>
    		</div>
    	</div>
    </section>
    
</div>