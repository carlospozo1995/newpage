
<div class="breadcrumb-section" data-aos="fade-up" data-aos-delay="0">
    <div class="pt-4 pb-4 mb-4 bg-mist-white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-nav breadcrumb-nav-color--black">
                        <nav aria-label="breadcrumb">
                            <ul class="navigation-page">
                            	<li><a href="<?= BASE_URL; ?>">INICIO</a></li>
                                <li class="active" aria-current="page">PROCESAR PAGO</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="cart-section">
    <div class="cart-table-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row position-relative">
                <div class="content-loading">
                    <span class="loader-store"></span>
                </div>
                <div class="col-lg-8 col-md-8">
                    <?php
                    if (isset($_SESSION['login'])) {
                    ?>
                    <div class="checkout-data_user" data-aos="fade-up" data-aos-delay="400" style="border: 1px solid red; border-radius: 6px;">
                        <div class="title-data_user">
                            <h3>Billing Details</h3>
                            <i class="icon-note" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"></i>
                        </div>
                        <div class="collapse" id="collapseExample">
                            <div>
                                Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                            </div>
                        </div>
                    </div>
                    <!-- <p>
                      <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Link with href
                      </a>
                      <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Button with data-bs-target
                      </button>
                    </p>
                    <div class="collapse" id="collapseExample">
                      <div class="card card-body">
                        Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                      </div>
                    </div> -->
                    <?php
                    }else{
                    ?>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link nav-session active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-login" type="button" role="tab" aria-controls="nav-home" aria-selected="true">INICIAR SESIÓN</button>
                            <button class="nav-link nav-session" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-register" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">REGISTRO</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-login" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="account_form" data-aos="fade-up" data-aos-delay="0">
                                <form id="form-login_store">
                                    <div class="alert-login"></div>
                                    <div class="default-form-box">
                                        <div class="box-session">
                                            <i class="fa fa-envelope-o"></i>
                                            <input type="email" placeholder="Correo electrónico" id="email_login">
                                        </div>
                                    </div>
                                    <div class="default-form-box">
                                        <div class="box-session">
                                            <i class="icon-lock"></i>
                                            <input type="password" placeholder="Contraseña" id="password_login">
                                            <span class="mr-3" role='button'><i class="fa fa-eye-slash show-password"></i></span>
                                        </div>
                                    </div>
                                    <div class="login_submit">
                                        <a class="mb-4 text-right" href="#">Olvidé mi contraseña</a>
                                        <button class="btn btn-md btn-black-default-hover m-auto" type="submit">ENTRAR</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="account_form register" data-aos="fade-up" data-aos-delay="200">
                                <form action="#" method="POST">
                                    <div class="default-form-box">
                                        <div class="box-session">
                                            <i class="fa fa-user-o"></i>
                                            <input type="text" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="default-form-box">
                                        <div class="box-session">
                                            <i class="fa fa-user-o"></i>
                                            <input type="text" placeholder="Apellido">
                                        </div>
                                    </div>
                                    <div class="default-form-box">
                                        <div class="box-session">
                                            <i class="fa fa-envelope-o"></i>
                                            <input type="email" placeholder="Correo electrónico">
                                        </div>
                                    </div>
                                    <div class="default-form-box">
                                        <div class="box-session">
                                            <i class="icon-lock"></i>
                                            <input type="password" placeholder="Contraseña">
                                            <span class="mr-3" role='button'><i class="fa fa-eye-slash show-password"></i></span>
                                        </div>
                                    </div>
                                    <div class="default-form-box">
                                        <div class="box-session">
                                            <i class="icon-lock"></i>
                                            <input type="password" placeholder="Repetir contraseña">
                                            <span class="mr-3" role='button'><i class="fa fa-eye-slash show-password"></i></span>
                                        </div>
                                    </div>
                                    <div class="login_submit">
                                        <button class="btn btn-md btn-black-default-hover m-auto" type="submit">CREAR CUENTA</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>

                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="coupon_code right" data-aos="fade-up" data-aos-delay="400">
                        <h3 class="text-center">Total del carrito</h3>
                        <div class="coupon_inner">
                            <div class="cart_subtotal">
                                <p>Subtotal</p>
                                <p class="cart_amount subtotal-payment"></p>
                            </div>
                            <div class="cart_subtotal">
                                <p>IVA</p>
                                <p class="cart_amount iva-payment"></p>
                            </div>
                            <hr>
                            <div class="cart_subtotal">
                                <p>Total</p>
                                <p class="cart_amount total-payment"></p>
                            </div>
                            <?php
                            if (isset($_SESSION['login'])) {
                            ?>
                            <div class="checkout_btn">
                                <a href="<?= BASE_URL; ?>carrito/procesarpago" class="btn btn-md btn-coral">Finalizar compra</a>
                            </div>		
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>