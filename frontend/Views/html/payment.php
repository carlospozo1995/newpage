
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
                    <div class="checkout-data_buy mb-4" data-aos="fade-up" data-aos-delay="400" >
                        <div class="title-data_buy">
                            <h3>1. DATOS<i class="icon-note btn-collapse-data" role="button"></i></h3>
                        </div>
                        
                        <div class="px-5 py-5" id="dataCollapse">
                            <form class="form-client_data">
                                <div class="mb-3">
                                    <span class="font-weight-bold">Cédula o RUC</span>
                                    <input type="text" class="form-control" value="<?= $_SESSION['data_user']['dni']; ?>">
                                </div>
                                <div class="mb-3">
                                    <span class="font-weight-bold">Nombre</span>
                                    <input type="text" class="form-control" value="<?= $_SESSION['data_user']['name_user']; ?>">
                                </div>
                                <div class="mb-3">
                                    <span class="font-weight-bold">Apellido</span>
                                    <input type="text" class="form-control" value="<?= $_SESSION['data_user']['surname_user']; ?>">
                                </div>
                                <div class="mb-3">
                                    <span class="font-weight-bold">Correo</span>
                                    <input type="text" class="form-control" value="<?= $_SESSION['data_user']['email']; ?>">
                                </div>
                                <div class="mb-5">
                                    <span class="font-weight-bold">Teléfono / Movil</span>
                                    <input type="text" class="form-control" value="<?= $_SESSION['data_user']['phone']; ?>">
                                </div>

                                <div class="text-center">
                                    <button class="btn btn-md btn-black-default-hover m-auto" type="submit">IR AL ENVIO</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="checkout-data_buy mb-4" data-aos="fade-up" data-aos-delay="400">
                        <div class="title-data_buy">
                            <h3>2. ENVIO<i class="icon-note btn-collapse-shipping" role="button"></i></h3>
                        </div>

                        <div class="px-5 py-5" id="shippingCollapse">
                            <form class="form-shipping_information">
                                <div class="default-form-box">
                                    <label class="font-weight-bold" for="localidad">Localidad</label>
                                    <select class="country_option mb-3 nice-select wide" name="country" id="location">
                                        <option value="1">Balao</option>
                                        <option value="2">Santa Rita</option>
                                        <option value="3">San Carlos</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <span class="font-weight-bold">Dirección</span>
                                    <input type="text" class="form-control" id="address">
                                </div> 
                                <div class="mb-3">
                                    <span class="font-weight-bold">Información adicional(ej: cerca de...)</span>
                                    <input type="text" class="form-control" placeholder="Opcional">
                                </div> 
                                <div class="mb-5">
                                    <span class="font-weight-bold">Destinatario</span>
                                    <input type="text" class="form-control" placeholder="Persona a recibir" id="addressee">
                                </div>

                                <div class="text-center">
                                    <button class="btn btn-md btn-black-default-hover m-auto" type="submit">IR AL PAGO</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
                                <form class="register-client">
                                    <div class="alert-register"></div>
                                    <div class="default-form-box">
                                        <div class="box-session">
                                            <i class="fa fa-user-o"></i>
                                            <input type="text" class="client-name valid valid_text" placeholder="Nombre" required>
                                        </div>
                                        <span class="d-none text-danger">Este campo solo debe contener letras y espacios.</span>
                                    </div>
                                    <div class="default-form-box">
                                        <div class="box-session">
                                            <i class="fa fa-user-o"></i>
                                            <input type="text" class="client-surname valid valid_text" placeholder="Apellido" required>
                                        </div>
                                        <span class="d-none text-danger">Este campo solo debe contener letras y espacios.</span>
                                    </div>
                                    <div class="default-form-box">
                                        <div class="box-session">
                                            <i class="icon-phone"></i>
                                            <input type="text" class="client-phone valid valid_phone" placeholder="Teléfono / celular" required>
                                        </div>
                                        <span class="d-none text-danger">Este campo solo debe contener números de 7 o 10 dígitos.</span>
                                    </div>
                                    <div class="default-form-box">
                                        <div class="box-session">
                                            <i class="fa fa-envelope-o"></i>
                                            <input type="email" class="client-email valid valid_email" placeholder="Correo electrónico" required>
                                        </div>
                                        <span class="d-none text-danger">Este campo debe tener un correo existente.</span>
                                    </div>
                                    <div class="default-form-box">
                                        <div class="box-session">
                                            <i class="icon-lock"></i>
                                            <input type="password" class="client-password valid valid_password" placeholder="Contraseña" required>
                                            <span class="mr-3" role='button'><i class="fa fa-eye-slash show-password"></i></span>
                                        </div>
                                        <span class="d-none text-danger">La contraseña por lo mínimo debe tener 8 caracteres entre numeros, letras minusculas y mayusculas.</span>
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
                    <?php
                    if(isset($_SESSION['login'])){
                    ?>
                    <div class="mb-4 purchase-summary" data-aos="fade-up" data-aos-delay="400">
                        <h3 class="text-center">RESUMEN DE COMPRA</h3>
                    </div>
                    <?php
                    }
                    ?>

                    <div class="coupon_code right mb-5" data-aos="fade-up" data-aos-delay="400">
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
                            <?php
                            if(isset($_SESSION['login'])){
                            ?>
                            <div class="cart_subtotal">
                                <p>ENVIO</p>
                                <p class="cart_amount shipment-payment"></p>
                            </div>
                            <?php
                            }
                            ?>
                            <hr>
                            <div class="cart_subtotal">
                                <p>Total</p>
                                <p class="cart_amount total-payment"></p>
                            </div>
                            <?php
                            // if (isset($_SESSION['login'])) {
                            ?>
                            <!-- <div class="checkout_btn">
                                <a href="<?= BASE_URL; ?>carrito/procesarpago" class="btn btn-md btn-coral">Finalizar compra</a>
                            </div>		 -->
                            <?php
                            // }
                            ?>
                        </div>
                    </div>

                    <?php
                        if (isset($_SESSION['login'])) {
                    ?>
                    <div class="process-payment collapse" data-aos="fade-up" data-aos-delay="400">
                        <p style="background: blue; color: white;">pago paymendez</p>
                        <span>proceso de pago</span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis veniam sed eaque rerum recusandae itaque dolor ex, tenetur ipsum ullam eos quaerat magnam nostrum minima nam cupiditate sit? Nostrum, perspiciatis.</p>
                    </div>
                    <?php
                          }
                    ?>

                </div>
            </div>
        </div>
    </div>

</div>