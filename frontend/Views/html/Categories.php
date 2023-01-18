    
<?php   
    Utils::loadModalFile("categories", ""); 
?>

<div class="content-wrapper">
    
    <section class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
         		<div class="col-sm-6 d-flex">
            		<h1><?= $section_name; ?></h1>
                    <?php if (!empty($_SESSION['module']['crear'])) { ?>
                        <button type="button" class="btn btn-primary ml-2" id="btnNewCategory"><i class="fas fa-plus-circle"></i> Nuevo</button>
                    <?php } ?>
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
                            <table id="tableUsers" class="table_order table table-bordered table-striped">
			                  	<thead>
				                  	<tr>
				                    	<th>ID</th>
				                    	<th>Nombre</th>
				                    	<th>Pertenece a</th>
				                    	<th>Slider desktop</th>
				                    	<th>Slider mobile</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
				                  	</tr>
			                  	</thead>
		                  		<tbody>
                                <?php
                                    $dataCategories = Models_Categories::getCategories();
                                    $id_row = 1;

                                    foreach ($dataCategories as $key => $value) {    
                                        $btnWatch = '';
                                        $btnUpdate = '';
                                        $btnDelete = '';
                                        $id_category =  Utils::encriptar($value["id_category"]);
  
                                        if (!empty($_SESSION['module']['ver'])) {
                                            $btnWatch = '<button type="button" class="btn btn-secondary btn-sm" onclick="watch(\''.$id_category.'\')" tilte="Ver"><i class="fa-solid fa-eye"></i></button>';
                                        }
  
                                        if (!empty($_SESSION['module']['actualizar'])) {
                                            $btnUpdate = '<button type="button" class="btn btn-primary btn-sm" onclick="edit(this, \''.$id_category.'\')" tilte="Editar"><i class="fa-solid fa-pencil"></i></button>';
                                        }
  
                                        if (!empty($_SESSION['module']['eliminar']) && $_SESSION['idUser'] == 1) {
                                            $btnDelete = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteData(this, \''.$id_category.'\')" tilte="Eliminar"><i class="fa-solid fa-trash"></i></button>';
                                        }
  
                                        if ($value['status'] == 1) {
                                            $value['status'] = '<div class="text-center"><span class="bg-success p-1 rounded"><i class="fa-solid fa-user"></i> Activo</span></div>';
                                        }else{
                                            $value['status'] = '<div class="text-center"><span class="bg-danger p-1 rounded"><i class="fa-solid fa-user-slash"></i> Inactivo</span></div>';
                                        }
  
                                        echo'<tr>';
                                            echo '<td>'.$id_row.'</td>';
                                            echo '<td>'.$value['name_category'].'</td>';
                                            echo '<td>'.$value['nameFather'].'</td>';
                                            echo '<td class="text-center">';
                                            if (!empty($value['sliderDst'])) {
                                                echo '<img style="width:70px" src="'.MEDIA_ADMIN.'files/images/uploads/'.$value['sliderDst'].'">';
                                            }
                                            echo '</td>';
                                            echo '<td class="text-center">';
                                            if (!empty($value['sliderMbl'])) {
                                                echo '<img style="width:50px" src="'.MEDIA_ADMIN.'files/images/uploads/'.$value['sliderMbl'].'">';
                                            }
                                            echo '</td>';
                                            echo '<td>'.$value['status'].'</td>';
                                            echo '<td><div class="text-center">'.$btnWatch.' '.$btnUpdate.' '.$btnDelete.'</div></td>';
                                        echo'</tr>';
  
                                        $id_row++;
                                    } 
                                ?>                   
                                </tbody>
                            </table>
                        </div>
	        		</div>
        		</div>
    		</div>
    	</div>
    </section>
</div>