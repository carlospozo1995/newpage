    

<?php   
    Utils::loadModalFile("users", ""); 
?>

<div class="content-wrapper">
    
    <section class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
         		<div class="col-sm-6 d-flex">
            		<h1><?= $section_name; ?></h1>
                    <?php if (!empty($_SESSION['module']['crear'])) { ?>
                        <button type="button" class="btn btn-primary ml-2" id="btnNewUser"><i class="fas fa-plus-circle"></i> Nuevo</button>
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
				                    	<th>Apellidos</th>
				                    	<th>Email</th>
				                    	<th>Telélefono</th>
                                        <th>Rol</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
				                  	</tr>
			                  	</thead>
		                  		<tbody>
                                <?php
                                    $dataUsers = Models_Users::getUsers();
                                    $id_row = 1;

                                    foreach ($dataUsers as $key => $value) {    
                                        $btnWatch = '';
                                        $btnUpdate = '';
                                        $btnDelete = '';
                                        $id_user =  Utils::encriptar($value["id_user"]);
  
                                        if (!empty($_SESSION['module']['ver'])) {
                                            $btnWatch = '<button type="button" class="btn btn-secondary btn-sm" onclick="watch(\''.$id_user.'\')" tilte="Ver"><i class="fa-solid fa-eye"></i></button>';
                                        }
  
                                        if ($value['id_user'] != $_SESSION['idUser'] && !empty($_SESSION['module']['actualizar'])) {
                                            $btnUpdate = '<button type="button" class="btn btn-primary btn-sm" onclick="edit(this, \''.$id_user.'\')" tilte="Editar"><i class="fa-solid fa-pencil"></i></button>';
                                        }
  
                                        if ($value['id_user'] != $_SESSION['idUser'] && !empty($_SESSION['module']['eliminar'])) {
                                            $btnDelete = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteData(this, \''.$id_user.'\')" tilte="Eliminar"><i class="fa-solid fa-trash"></i></button>';
                                        }
  
                                        if ($value['status'] == 1) {
                                            $value['status'] = '<div class="text-center"><span class="bg-success p-1 rounded"><i class="fa-solid fa-user"></i> Activo</span></div>';
                                        }else{
                                            $value['status'] = '<div class="text-center"><span class="bg-danger p-1 rounded"><i class="fa-solid fa-user-slash"></i> Inactivo</span></div>';
                                        }
  
                                        echo'<tr>';
                                            echo '<td>'.$id_row.'</td>';
                                            echo '<td>'.$value['name_user'].'</td>';
                                            echo '<td>'.$value['surname_user'].'</td>';
                                            echo '<td>'.$value['email'].'</td>';
                                            echo '<td>'.$value['phone'].'</td>';
                                            echo '<td>'.$value['name_rol'].'</td>';
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