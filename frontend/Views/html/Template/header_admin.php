<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="">
	<title><?= $title_page ?></title>

	<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= MEDIA_ADMIN; ?>css/plugins/fontawesome/css/all.min.css">
	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="<?= MEDIA_ADMIN; ?>css/plugins/sweetalert2/sweetalert2.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="<?= MEDIA_ADMIN; ?>css/plugins/toastr/toastr.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?= MEDIA_ADMIN; ?>css/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= MEDIA_ADMIN; ?>css/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= MEDIA_ADMIN; ?>css/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?= MEDIA_ADMIN; ?>css/plugins/select2/select2.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= MEDIA_ADMIN; ?>css/adminlte.min.css">
	<!-- My style -->
	<link rel="stylesheet" href="<?= MEDIA_ADMIN; ?>css/style.css">
	<?php
		if(isset($file_css) && is_array($file_css) && !empty($file_css)){
			foreach ($file_css as $keycss => $valuecss) {
				echo '<link rel="stylesheet" href="'.MEDIA_ADMIN.'css/'.$valuecss.'.css">';
			}
		}
	?>
</head>
<body class="hold-transition sidebar-mini">

		<div id="loading" class="loading-gif">
			<div>
				<img src="<?= MEDIA; ?>admin/files/images/loading.gif" alt="">
			</div>
		</div>
		
		<div class="wrapper">

				<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	    
				    <ul class="navbar-nav">
				      	<li class="nav-item">
				        		<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				      	</li>
				      	<li class="nav-item d-none d-sm-inline-block">
				        		<span class="nav-link">Menu</span>
				      	</li>
				    </ul>

				    <ul class="navbar-nav ml-auto">
				      
				      	<li class="nav-item dropdown user-menu">
						        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
							          	<i class="fas fa-user "></i>
							          	<span class="d-none d-md-inline"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?= $_SESSION['data_user']['name_user']." ".$_SESSION['data_user']['surname_user'] ?></font></font></span>
						        </a>

						        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						          
						          	<li class="user-header bg-primary h-100">
								            <p><?= $_SESSION['data_user']['name_rol'] ?></p>
								            <p>
								              	<small><?= Utils::date(); ?></small>
								            </p>
						          	</li>

						          	<li class="user-footer">
											<?php
												$userName = explode("@", $_SESSION['data_user']['email']); 
											?>
								            <a href="<?= BASE_URL.'users/'.$userName[0]; ?>" class="btn btn-default btn-flat">Perfil</a>
								            <button class="btn btn-default btn-flat float-right" id="session_close">Cerrar sesión</button>
						          	</li>
						        </ul>

				      	</li>

				    </ul>

	  		</nav>

			<?php require_once("nav_admin.php"); ?>

