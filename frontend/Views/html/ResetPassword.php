<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="description" content="">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta name="author" content="">
	<title><?= $title_page ?></title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= MEDIA; ?>admin/css/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= MEDIA; ?>admin/css/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= MEDIA; ?>admin/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= MEDIA; ?>admin/css/style.css">
</head>
<body class="hold-transition login-page">

	<div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-body">

                <div id="loading" class="loading-login-mc">
                    <div>
                        <img src="<?= MEDIA; ?>admin/files/images/loading.gif" alt="">
                    </div>
                </div>

                <form id="formResetPass">
                    <div class="card-header text-center">
                        <span class="h3"><b><?= $name_empresa; ?></b></span>
                    </div>

                    <div class="text-center m-2"><i onclick="showPass(this)" class="fa-regular fa-eye-slash" role="button"></i></div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control contPass" id="password" placeholder="Nueva contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control contPass" id="passwordConfirm" placeholder="Confirmar contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Confirmar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

	<script> const base_url = "<?= BASE_URL; ?>"; </script>
    <script src="<?= MEDIA ?>admin/js/plugins/jquery/jquery.min.js"></script>
    <script src="<?= MEDIA ?>admin/js/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= MEDIA ?>admin/js/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?= MEDIA ?>admin/js/adminlte.min.js"></script>
    <script src="<?= MEDIA ?>admin/js/global.js"></script>
    <script src="<?= MEDIA ?>admin/js/login.js"></script>
</body>
</html>