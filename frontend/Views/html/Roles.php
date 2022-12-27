<?php Utils::loadModalFile("roles", $data = array("test"=>"testmodal")); ?>


<div class="content-wrapper">
    <!-- CONTAINER MODAL PERMISOS -->
    <div id="contentModalPermisos"></div>
    <!-- ------------------------ -->
    
    <section class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
         		<div class="col-sm-6 d-flex">
            		<h1><?= $section_name; ?></h1>
            		<?php 
            		// if(!empty($_SESSION['permisosMod']['crear'])){ 
            		?>
            			<button type="button" class="btn btn-primary ml-2" id="btnNewRol"><i class="fas fa-plus-circle"></i> Nuevo</button>
            		<?php 
            		// } 
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
			                  	foreach ($dataRoles as $key => $value) {
			                  		$btnPermisos = '';
					                $btnUpdate = '';
					                $btnDelete = '';

					                $id_rol =  Utils::encriptar($value["id_rol"]);

					                if ($_SESSION['idUser'] == 1) {
					                	$btnPermisos = '<button type="button" class="btn btn-secondary btn-sm" onclick="permissions(\''.$id_rol.'\')" tilte="Permisos"><i class="fa-solid fa-key"></i></button>';
					                }

					                if ($_SESSION['idUser'] == 1) {
			                        	$btnUpdate = '<button type="button" class="btn btn-primary btn-sm" tilte="Editar"><i class="fa-solid fa-pencil"></i></button>';
			                      	}
			                      	if ($_SESSION['idUser'] == 1){
			                        	$btnDelete = '<button type="button" class="btn btn-danger btn-sm" tilte="Eliminar"><i class="fa-solid fa-trash"></i></button>';
			                      	}

			                      	if ($value['status'] == 1) {
			                        	$value['status'] = '<div class="text-center"><span class="bg-success p-1 rounded"><i class="fa-solid fa-user"></i> Activo</span></div>';
			                      	}else{
			                        	$value['status'] = '<div class="text-center"><span class="bg-danger p-1 rounded"><i class="fa-solid fa-user-slash"></i> Inactivo</span></div>';
			                      	}

			                      	echo'<tr>';
				                        echo '<td>'.$value['id_rol'].'</td>';
				                        echo '<td>'.$value['name_rol'].'</td>';
				                        echo '<td>'.$value['description_rol'].'</td>';
				                        echo '<td>'.$value['status'].'</td>';
				                        echo '<td><div class="text-center">'.$btnPermisos.' '.$btnUpdate.' '.$btnDelete.'</div></td>';
				                    echo'</tr>';
			                  	}


				                // if($_SESSION['permisosMod']['ver']){
				                //     require_once 'Models/RolesModel.php';
				                //     $objLogin = new RolesModel();
				                //     $request = $objLogin->selectAllRoles();
				                //     foreach ($request as $key => $value) {
					            //         $btnPermisos = '';
					            //         $btnUpdate = '';
					            //         $btnDelete = '';

				                //       	if ($_SESSION['idUser'] == 1) {
				                //         	$btnPermisos = '<button type="button" class="btn btn-secondary btn-sm" onclick="permisos('.$value['idrol'].')" tilte="Permisos"><i class="fas fa-key"></i></button>';
				                //       	}
				                //       	if (!empty($_SESSION['permisosMod']['actualizar']) && $_SESSION['idUser'] == 1) {
				                //         	$btnUpdate = '<button type="button" class="btn btn-primary btn-sm" onclick="editRol(this, '.$value['idrol'].')" tilte="Editar"><i class="fas fa-pencil-alt"></i></button>';
				                //       	}
				                //       	if (!empty($_SESSION['permisosMod']['eliminar']) && $_SESSION['idUser'] == 1){
				                //         	$btnDelete = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteRol(this, '.$value['idrol'].')" tilte="Eliminar"><i class="fas fa-trash"></i></button>';
				                //       	}

				                //       	if ($value['status'] == 1) {
				                //         	$value['status'] = '<div class="text-center"><span class="bg-success p-1 rounded"><i class="fas fa-user"></i> Activo</span></div>';
				                //       	}else{
				                //         	$value['status'] = '<div class="text-center"><span class="bg-danger p-1 rounded"><i class="fas fa-user-slash"></i> Inactivo</span></div>';
				                //       	}

					            //         echo'<tr>';
					            //             echo '<td>'.$value['idrol'].'</td>';
					            //             echo '<td>'.$value['nombrerol'].'</td>';
					            //             echo '<td>'.$value['descripcion'].'</td>';
					            //             echo '<td>'.$value['status'].'</td>';
					            //             echo '<td><div class="text-center">'.$btnPermisos.' '.$btnUpdate.' '.$btnDelete.'</div></td>';
					            //         echo'</tr>';
				                //     }
				                // } 

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