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
                                        <span>Envio: <?=$order['shipping_address'];?></span>
                                        <br>
                                        <span>Tel: <?=$order['phone'];?></span>
                                        <br>
                                        <span>Email: <?=$order['email'];?></span>
                                    </address>
                                </div>
                                <div class="col-4">
                                    <address>
                                        <span>Pago: <?= $order['payment_type_id'] ==1 ? "Tarjeta" : "Transferencia"; ?></span>
                                        <br>
                                        <span>Estado-pago: <?=$order['status'];?></span>
                                        <br>
                                        <span>Estado-envio: <?=$order['process'];?></span>
                                        <br>
                                        <span>Total: <?=SMONEY." ".Utils::formatMoney($order['total']);?></span>
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
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach ($order['ordered_products'] as $key => $value) {
                                            echo '<tr>';
                                                echo '<td>'.$value['name_product'].'</td>';
                                                echo '<td>'.SMONEY." ".Utils::formatMoney($value['price']).'</td>';
                                                echo '<td>'.$value['quantityOrdered'].'</td>';
                                                echo '<td>l</td>';
                                            echo '</tr>';
                                        }
                                    ?>
                                    </tbody>
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