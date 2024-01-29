    
<?php   
    Utils::loadModalFile("pedido", ""); 
?>

<div class="content-wrapper">
    
    <section class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
         		<div class="col-sm-6 d-flex">
            		<h1><?= strtoupper($section_name); ?></h1>
                </div>
          	</div>
        </div>
    </section>
        
    <section class="content">
      	<div class="container-fluid">
        	<div class="row">
          		<div class="col-12">
            		<div class="card">
              			<div class="card-body">
                           <?php
                            $dataOrders = Models_Pedidos::getOrders($_SESSION['idUser']);

                            if (!empty($dataOrders)) {
                            ?>
                                <table id="tablePedidos" class="table_order table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                        <th>ID</th>
                                        <th># Pedido</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Tipo de pago</th>
                                            <th>Dirección</th>
                                            <th>Estado de compra</th>
                                            <th>Proceso de entrega</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            <?php
                            
                            $id_row = 1;
                            foreach ($dataOrders as $key => $value) {

                                $btnWatch = '';
                                $btnDelete = '';
                                $id_order =  Utils::encriptar($value["id_order"]);

                                if (!empty($_SESSION['module']['ver'])) {
                                    $btnWatch = '<a href="'.BASE_URL.'orden/'.$id_order.'" class="btn btn-secondary btn-sm"><i class="fa-solid fa-eye"></i></a>';
                                }

                                if (!empty($_SESSION['module']['eliminar']) && $_SESSION['idUser'] == 1) {
                                    $btnDelete = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteData(this, \''.$id_order.'\')" tilte="Eliminar"><i class="fa-solid fa-trash"></i></button>';
                                }

                                echo'<tr id="'.$id_order.'">';
                                    echo '<td>'.$id_row.'</td>';
                                    echo '<td>'.$value['num_order'].'</td>';
                                    echo '<td>'.date('d/m/Y', strtotime($value['dateCreate'])).'</td>';
                                    echo '<td>'.SMONEY." ".Utils::formatMoney($value['total']).'</td>';
                                    echo '<td>';
                                    echo $value['payment_type_id'] == 1 ? "Tarjeta" : "Transferencia";
                                    echo '</td>';
                                    echo '<td>'.$value['shipping_address'].'</td>';
                                    echo '<td>'.$value['status'].'</td>';
                                    echo '<td>';
                                        $output = '';

                                        if (!empty($value['reviewed_date'])) {
                                            $output .= '<li class="pl-5 ml-5">';
                                            $output .= '<h5>' . date('d/m/Y', strtotime($value['reviewed_date'])) . '</h5>';
                                            $output .= '<p class="font-weight-bold text-success">Revisado <i class="nav-icon fas fa-check"></i></p>';
                                            $output .= '<p>'. ($value['reviewed_comment'] != null ? $value['reviewed_comment'] : "Hemos recibido su pedido, iniciamos proceso de entrega.") .'</p>';
                                            $output .= '</li>';

                                            if (!empty($value['shipping_date'])) {
                                                $output .= '<li class="pl-5 ml-5">';
                                                $output .= '<h5>' . date('d/m/Y', strtotime($value['shipping_date'])) . '</h5>';
                                                $output .= '<p class="font-weight-bold text-success">Enviado <i class="nav-icon fas fa-check"></i></p>';
                                                $output .= '<p>'. ($value['shipping_comment'] != null ? $value['shipping_comment'] : "Su pedido ha sido despachado y está en ruta hacia tu destino.") .'</p>';
                                                $output .= '</li>';

                                                if (!empty($value['delivery_date'])) {
                                                    $output .= '<li class="pl-5 ml-5">';
                                                    $output .= '<h5>' . date('d/m/Y', strtotime($value['delivery_date'])) . '</h5>';
                                                    $output .= '<p class="font-weight-bold text-success">Entregado <i class="nav-icon fas fa-check"></i></p>';
                                                    $output .= '<p>'. ($value['delivery_comment'] != null ? $value['delivery_comment'] : "¡Felicidades! Su pedido ha sido entregado satisfactoriamente.") .'</p>';
                                                    $output .= '</li>';
                                                }
                                            }
                                            echo '<ul class="timeline">'.$output.'</ul>';
                                        }
                                    ?>
                                            
                                    <?php

                                    if ($_SESSION['idUser'] == 1 && $value['status'] != "Canceled") {
                                        $btn_progress = '<button type="button" class="btn btn-primary btn-sm btn_next-process" id="'.$id_order.'">Next process</button>';
                                        if (!empty($value['reviewed_date'])) {
                                            echo empty($value['shipping_date']) && empty($value['delivery_date']) ? $btn_progress : (!empty($value['shipping_date']) && empty($value['delivery_date']) ? $btn_progress : (!empty($value['shipping_date']) && !empty($value['delivery_date']) ? "" : $btn_progress));
                                        } else {
                                            echo $btn_progress;
                                        }
                                    }
                                    
                                    echo '</td>';
                                    echo '<td><div class="text-center">'.$btnWatch.' '.$btnDelete.'</div></td>';
                                echo'</tr>';

                                $id_row++;
                            }
                            ?>
                                    </tbody>
                                </table>
                            <?php
                            }else{
                                echo "vacio";
                            }
                            
                            ?>

                        </div>
	        		</div>
        		</div>
    		</div>
    	</div>
    </section>
</div>
