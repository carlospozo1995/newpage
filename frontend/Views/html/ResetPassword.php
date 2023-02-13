
	<div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-body">

                <div id="loading" class="loading-gif">
                    <div>
                        <img src="<?= MEDIA; ?>admin/files/images/loading.gif" alt="">
                    </div>
                </div>

                <form id="formResetPass">
                    <div class="card-header text-center">
                        <span class="h3"><b><?= NAME_EMPRESA; ?></b></span>
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

