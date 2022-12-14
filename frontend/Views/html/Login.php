<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title_page ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= MEDIA; ?>admin/css/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= MEDIA; ?>admin/css/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= MEDIA; ?>admin/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= MEDIA; ?>admin/css/style.css">
</head>
<body class="hold-transition login-page">

    <div class="login-box">
        <div class="card card-outline card-primary login-content">
            <div class="card-body login">

                <div id="loading" class="loading-login-mc">
                    <div>
                        <img src="<?= MEDIA; ?>admin/files/images/loading.gif" alt="">
                    </div>
                </div>

                <form class="login-form" id="formLogin">
                    <div class="card-header text-center">
                        <a href="" class="h3"><b>INICIAR SESION</b></a>
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" id="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <p class="mb-1">
                                <a href="#" data-toggle="flip">¿Olvidé mi contraseña?</a>
                            </p>
                        </div>  

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa-solid fa-arrow-right-to-bracket"></i> Sign In</button>
                        </div>
                    </div>
                </form>

                <!-- ------------------------------- -->

                <form id="formResetPass" class="forget-form">
                    <div class="card-header text-center">
                        <a href="" class="h4"><b>REINICIAR CONTRASEÑA</b></a>
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" class="form-control" id="resetEmail" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Reiniciar</button>
                        </div>

                        <p class="mt-3 mb-1">
                            <a href="#" data-toggle="flip"><i class="fa-solid fa-arrow-left"></i> Login</a>
                        </p>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- <?php
        // if(isset($file_css) && is_array($file_css) && !empty($file_css)){
            // foreach ($title_page as $keycss => $valuecss) {
            //    echo "<h1>".$valuecss."</h1>";
            // }
        // }
    ?> -->
    <script> const base_url = "<?= BASE_URL; ?>"; </script>
    <script src="<?= MEDIA ?>admin/js/plugins/jquery/jquery.min.js"></script>
    <script src="<?= MEDIA ?>admin/js/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= MEDIA ?>admin/js/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?= MEDIA ?>admin/js/adminlte.min.js"></script>
    <script src="<?= MEDIA ?>admin/js/global.js"></script>
    <script src="<?= MEDIA ?>admin/js/login.js"></script>
</body>
</html>