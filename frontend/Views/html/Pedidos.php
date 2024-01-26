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
                                            <!-- <th>Proceso de entrega</th> -->
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
                                    // echo '<td>';
                                    ?>
                                            <!-- <ul class="timeline">
                                                <li class="pl-5 ml-5">
                                                    <h5><?=date('d/m/Y', strtotime($value['dateCreate']));?></h5>
                                                    <p class="font-weight-bold text-success"><?=$value['process'];?> <i class="nav-icon fas fa-check"></i></p>
                                                </li>
                                            </ul>                                      -->
                                    <?php
                                    if ($_SESSION['idUser'] == 1) {
                                        // echo '<button type="button" class="btn btn-primary ml-2" id="btnNewProduct"><i class="fas fa-circle-chevron-right"></i> Process</button>';
                                        // echo '<p>Comentario: Hemos recibido tu pedido, iniciamos proceso de entrega.</p>';
                                    }
                                    // echo '</td>';
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
