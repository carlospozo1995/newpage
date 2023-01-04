<?php 	
	if ($_SESSION['idUser'] == 1) {
		Utils::loadModalFile("roles", ""); 
	}
?>
<div class="content-wrapper">

    <div id="contentModalPermissions"></div>
    
    <section class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
         		<div class="col-sm-6 d-flex">
            		<h1><?= $section_name; ?></h1>
            		<?php 
            		if ($_SESSION['idUser'] == 1) {
            		?>
            			<button type="button" class="btn btn-primary ml-2" id="btnNewRol"><i class="fas fa-plus-circle"></i> Nuevo</button>
            		<?php 
            		} 
            		?>
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
		                	<table id="tableRoles" class="table_order table table-bordered table-striped">
			                  	<thead>
				                  	<tr>
				                    	<th>ID</th>
				                    	<th>Nombre</th>
				                    	<th>Descripción</th>
				                    	<th>Estado</th>
				                    	<th>Acciones</th>
				                  	</tr>
			                  	</thead>
		                  		<tbody>
			                  	<?php

			                  	$dataRoles = Models_Roles::getRoles();
			                  	$id_row = 1;
			                  	foreach ($dataRoles as $key => $value) {
			                  		$btnPermissions = '';
					                $btnUpdate = '';
					                $btnDelete = '';
					                $id_rol =  Utils::encriptar($value["id_rol"]);

					                if ($_SESSION['idUser'] == 1) {
					                	$btnPermissions = '<button type="button" class="btn btn-secondary btn-sm" onclick="permissions(\''.$id_rol.'\')" tilte="Permisos"><i class="fa-solid fa-key"></i></button>';
					                }

					                if ($_SESSION['idUser'] == 1) {
			                        	$btnUpdate = '<button type="button" class="btn btn-primary btn-sm" onclick="edit(this, \''.$id_rol.'\')" tilte="Editar"><i class="fa-solid fa-pencil"></i></button>';
			                      	}

			                      	if ($_SESSION['idUser'] == 1){
			                        	$btnDelete = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteData(this, \''.$id_rol.'\')" tilte="Eliminar"><i class="fa-solid fa-trash"></i></button>';
			                      	}

			                      	if ($value['status'] == 1) {
			                        	$value['status'] = '<div class="text-center"><span class="bg-success p-1 rounded"><i class="fa-solid fa-user"></i> Activo</span></div>';
			                      	}else{
			                        	$value['status'] = '<div class="text-center"><span class="bg-danger p-1 rounded"><i class="fa-solid fa-user-slash"></i> Inactivo</span></div>';
			                      	}

			                      	echo'<tr>';
			                      		echo '<td>'.$id_row.'</td>';
				                        echo '<td>'.$value['name_rol'].'</td>';
				                        echo '<td>'.$value['description_rol'].'</td>';
				                        echo '<td>'.$value['status'].'</td>';
				                        echo '<td><div class="text-center">'.$btnPermissions.' '.$btnUpdate.' '.$btnDelete.'</div></td>';
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