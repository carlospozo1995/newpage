<?php   
    Utils::loadModalFile("user", ""); 
?>

<div class="content-wrapper">

	<section class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
         		<div class="col-sm-6 d-flex">
            		<h1>PERFIL</h1>
                </div>
          	</div>
        </div>
    </section>
            
    <section class="content">
      	<div class="container-fluid">
        	<div class="row">
          		<div class="col-8 m-auto">
            		<div class="card">
              			<div class="card-body">
							<?php
								$dataUser = Models_Users::verifyUser($_SESSION['idUser']);
							?>
							<div class="row">
								<div class="col-sm-6">
									<span class="font-weight-bold">Nombre</span>
                                    <p class="name_client"><?= $dataUser['name_user']; ?></p>
								</div>
								<div class="col-sm-6">
									<span class="font-weight-bold">Apellido</span>
                                    <p class="surname_client"><?= $dataUser['surname_user']; ?></p>
								</div>
							</div>
							<br>
							<span class="font-weight-bold">Correo</span>
                            <p><?= $dataUser['email']; ?></p>
							<br>
							<div class="row">
								<div class="col-sm-6">
									<span class="font-weight-bold">Identificación</span>
                                    <p class="dni_client"><?= $dataUser['dni']; ?></p>
								</div>
								<div class="col-sm-6">
									<span class="font-weight-bold">Teléfono</span>
                                    <p class="phone_client"><?= $dataUser['phone']; ?></p>
								</div>
							</div>
							
                        </div>

						<?php
						
						if ($_SESSION['idUser'] != 1) {
							echo '<div class="card-footer  bg-transparent m-auto">';
								echo '<button id="'.Utils::encriptar($_SESSION['idUser']).'" class="btn btnText btn-sm btn-primary editUser">Editar <i class="fa fa-pencil-square" aria-hidden="true"></i></button>';
							echo '</div>';
						}
						
						?>
	        		</div>
        		</div>
    		</div>
    	</div>
    </section>
</div>