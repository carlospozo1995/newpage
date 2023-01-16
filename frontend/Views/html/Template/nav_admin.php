
		<aside class="main-sidebar sidebar-dark-primary elevation-4 aside-mc">

		    <a href="<?= BASE_URL ?>dashboard" class="brand-link">
		      	<img src="<?= MEDIA ?>admin/files/images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 logocg-mc" style="opacity: .8">
		      	<span class="title-s-mc"><?= $name_empresa ?></span>
		    </a>

		    <div class="sidebar">
		      	<div class="user-panel mt-3 pb-3 mb-3 d-flex" style="align-items:center;">
			        <div class="image">
			          	<img src="<?= MEDIA ?>admin/files/images/user.png" class="img-circle elevation-2" alt="User Image">
			        </div>
			        <div class="info">
				        <span><?= $_SESSION['data_user']['name_user']." ".$_SESSION['data_user']['surname_user'] ?></span>
         				<p style="margin-bottom: 0px;"><?= $_SESSION['data_user']['name_rol'] ?></p>
			        </div>
			    </div>

			    <nav class="mt-2">

			        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			          	
			          	<li class="nav-item">
			            	<a href="" class="nav-link">
			              		<i class="nav-icon fas fa-home"></i>
			              		<p>Home</p>
			            	</a>
			          	</li>
			          	
			          	<?php if(!empty($_SESSION['permissions'][MUSUARIOS]['ver'])){ ?>
			          	<li class="nav-item">
				            <a href="#" class="nav-link">
				              	<i class="nav-icon fas fa-users"></i>
				              	<p>
				                	Usuarios
				                <i class="right fas fa-angle-left"></i>
				              	</p>
				            </a>

				            <ul class="nav nav-treeview">
				              	
				              	<li class="nav-item">
					                <a href="<?= BASE_URL ?>users" class="nav-link">
					                  	<i class="far fa-circle nav-icon"></i>
					                  	<p>Usuarios</p>
					                </a>
				              	</li>

				              	<li class="nav-item">
					                <a href="<?= BASE_URL ?>roles" class="nav-link">
					                  	<i class="far fa-circle nav-icon"></i>
					                  	<p>Roles</p>
					                </a>
				              	</li> 
				              	
				            </ul>
			          	</li>
			          	<?php } ?>
			          	
			            <!-- <li class="nav-item">
			              	<a href="" class="nav-link">
			                	<i class="nav-icon fas fa-user"></i>
			                	<p>Clientes</p>
			              	</a>
			            </li> -->
			          	
						<?php if(!empty($_SESSION['permissions'][MCATEGORIAS]['ver']) || !empty($_SESSION['permissions'][MPRODUCTOS]['ver'])){ ?>
			          	<li class="nav-item">
				            <a href="#" class="nav-link">
				              	<i class="nav-icon fas fa-store"></i>
				              	<p>
				                	Tienda
				                	<i class="fas fa-angle-left right"></i>
				              	</p>
				            </a>

				            <ul class="nav nav-treeview">
								<?php if (!empty($_SESSION['permissions'][MCATEGORIAS]['ver'])) { ?>
				              	<li class="nav-item">
					                <a href="<?= BASE_URL ?>categories" class="nav-link">
					                  	<i class="far fa-circle nav-icon"></i>
					                  	<p>Categorias</p>
					                </a>
				              	</li>
								<?php } ?>
				              	
								<?php if (!empty($_SESSION['permissions'][MPRODUCTOS]['ver'])) { ?>
				              	<li class="nav-item">
					                <a href="<?= BASE_URL ?>products" class="nav-link">
					                  	<i class="far fa-circle nav-icon"></i>
					                  	<p>Productos</p>
					                </a>
				              	</li>
				              	<?php } ?>
				            </ul>
			          	</li>
						<?php } ?>

			        </ul>
			    </nav>
		    </div>
		</aside>