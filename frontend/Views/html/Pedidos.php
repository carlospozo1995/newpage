    
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
                                $btnCancelled = '';
                                $id_order =  Utils::encriptar($value["id_order"]);

                                if (!empty($_SESSION['module']['ver'])) {
                                    $btnWatch = '<a href="'.BASE_URL.'orden/'.$id_order.'" class="btn btn-secondary btn-sm" title="Ver Pedido"><i class="fa-solid fa-eye"></i></a>';
                                }

                                if (!empty($_SESSION['module']['eliminar']) && $_SESSION['idUser'] == 1) {
                                    $btnDelete = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteData(this, \''.$id_order.'\')" tilte="Eliminar"><i class="fa-solid fa-trash"></i></button>';
                                }

                                if ($value['status'] == "Progress") {
                                    $btnCancelled = '<button type="button" class="btn btn-danger btn-sm btn_order-cancelled" id="'.$id_order.'" title="Cancelar Pedido"><i class="fa-solid fa-ban"></i></button>';
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
                                    echo '<td class="text-center">'.$value['status'].'</td>';
                                    echo '<td>';

                                    if ($value['status'] != "Canceled") {
                                        echo '<ul class="timeline list-inline">';

                                            $stages = [
                                                ['date' => $value['reviewed_date'], 'comment' => $value['reviewed_comment'], 'text' => 'Revisado'],
                                                ['date' => $value['shipping_date'], 'comment' => $value['shipping_comment'], 'text' => 'Enviado'],
                                                ['date' => $value['delivery_date'], 'comment' => $value['delivery_comment'], 'text' => 'Entregado'],
                                            ];

                                            foreach ($stages as $stage) {
                                                echo '<li class="pl-5 ml-2">';
                                                if (!empty($stage['date'])) {
                                                    echo '
                                                        <h5>' . date('d/m/Y', strtotime($stage['date'])) . '</h5>
                                                        <p class="font-weight-bold text-success">' . $stage['text'] . ' <i class="nav-icon fas fa-check"></i></p>
                                                        <p>' . $stage['comment'] . '</p>
                                                    ';
                                                } else {
                                                    echo '<p class="text-primary">' . $stage['text'] . ' <span class="spinner-border spinner-border-sm"></span></p>';
                                                }
                                                echo '</li>';
                                            }

                                        echo '</ul>';
                                    }else{
                                        echo '<span class="text-danger d-flex"><i class="fa-solid fa-xmark text-center w-100"></i></span>';
                                    }

                                    if ($_SESSION['idUser'] == 1 && $value['status'] != "Canceled") {

                                        $btn_progress = '<button type="button" class="btn btn-primary btn-sm btn_next-process" id="'.$id_order.'">Next process</button>';
                                        if (!empty($value['reviewed_date'])) {
                                            echo empty($value['shipping_date']) && empty($value['delivery_date']) ? $btn_progress : (!empty($value['shipping_date']) && empty($value['delivery_date']) ? $btn_progress : (!empty($value['shipping_date']) && !empty($value['delivery_date']) ? "" : $btn_progress));
                                        } else {
                                            echo $btn_progress;
                                        }
                                    }
                                    
                                    echo '</td>';
                                    echo '<td><div class="text-center">'.$btnWatch.' '.$btnCancelled.'</div></td>';
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
