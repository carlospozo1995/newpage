
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

<div class="cart-section position-relative">
    <?php
    if (isset($_SESSION['login'])) {
    ?>
    <div class="content-loading">
        <span class="loader-store"></span>
    </div>
    <?php
    }
    ?>
    <div class="cart-table-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row position-relative">
                <?php
                if (isset($_SESSION['login'])) {
                ?>
                <p class="font-weight-bold">CAMPOS REQUERIDOS (<span class="text-danger">*</span>)</p>
                <div class="col-lg-7 col-md-7">
                    <div id="content-data_buy" data-aos="fade-up" data-aos-delay="400">
                        <div class="checkout-data_buy mb-4">
                            <div class="title-data_buy">
                                <h3>1. DATOS <i class="icon-note btn-collapse-data" role="button" data-bs-toggle="collapse" data-bs-target="#dataCollapse" aria-expanded="false"></i></h3>
                            </div>
                            
                            <div class="px-5 py-5 collapse" id="dataCollapse">
                                <form class="form-client_data">
                                    <div class="alert-client-data"></div>
                                    <div class="default-form-box">
                                        <span class="font-weight-bold">Cédula o RUC <span class="text-danger">*</span></span>
                                        <div class="box-session">
                                            <input type="text" id="dni-client" class="valid valid_empty" value="<?= $_SESSION['data_user']['dni']; ?>" required>
                                        </div>
                                        <span class="d-none text-danger">Por favor llenar este campo.</span>
                                    </div>
                                    <div class="default-form-box">
                                        <span class="font-weight-bold">Nombre <span class="text-danger">*</span></span>
                                        <div class="box-session">
                                            <input type="text" class="valid valid_text" id="name-client" value="<?= $_SESSION['data_user']['name_user']; ?>" required>
                                        </div>
                                        <span class="d-none text-danger">Este campo solo debe contener letras y espacios.</span>
                                    </div>
                                    <div class="default-form-box">
                                        <span class="font-weight-bold">Apellido <span class="text-danger">*</span></span>
                                        <div class="box-session">
                                            <input type="text" class="valid valid_text" id="surname-client" value="<?= $_SESSION['data_user']['surname_user']; ?>" required>
                                        </div>
                                        <span class="d-none text-danger">Este campo solo debe contener letras y espacios.</span>
                                    </div>
                                    <div class="default-form-box">
                                        <span class="font-weight-bold">Correo <span class="text-danger">*</span></span>
                                        <div class="box-session">
                                            <input type="text" class="valid valid_email" id="email-client" value="<?= $_SESSION['data_user']['email']; ?>" required>
                                        </div>
                                        <span class="d-none text-danger">Este campo debe tener un correo existente.</span>
                                    </div>
                                    <div class="default-form-box">
                                        <span class="font-weight-bold">Teléfono / celular <span class="text-danger">*</span></span>
                                        <div class="box-session">
                                            <input type="text" class="valid valid_phone" id="phone-client" value="<?= $_SESSION['data_user']['phone']; ?>" required>
                                        </div>
                                        <span class="d-none text-danger">Este campo solo debe contener números de 7 o 10 dígitos.</span>
                                    </div>

                                    <div class="text-center">
                                        <button class="btn btn-md btn-black-default-hover m-auto" type="submit">IR AL ENVIO</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                                    
                        <div class="checkout-data_buy mb-4">
                            <div class="title-data_buy">
                                <h3>2. ENVIO<i class="icon-note btn-collapse-shipping" role="button"></i></h3>
                            </div>

                            <div class="px-5 py-5" id="shippingCollapse" >
                                <form class="form-shipping_information">
                                    <div class="alert-shipping_information"></div>
                                    <div class="default-form-box">
                                        <label class="font-weight-bold" for="localidad">Localidad <span class="text-danger">*</span></label>
                                        <select class="country_option mb-3 nice-select wide" name="country" id="location">
                                            <option value="1">Balao</option>
                                            <option value="2">Santa Rita</option>
                                            <option value="3">San Carlos</option>
                                        </select>
                                    </div>
                                    <div class="default-form-box">
                                        <span class="font-weight-bold">Dirección <span class="text-danger">*</span></span>
                                        <div class="box-session">
                                            <input type="text" class="valid valid_empty" id="address" required>
                                        </div>
                                        <span class="d-none text-danger">Por favor llenar este campo.</span>
                                    </div> 
                                    <div class="default-form-box">
                                        <span class="font-weight-bold">Información adicional (Opcional)</span>
                                        <div class="box-session">
                                            <input type="text" placeholder="Cerca de..." id="additional-information">
                                        </div>
                                    </div> 
                                    <div class="default-form-box">
                                        <span class="font-weight-bold">Destinatario <span class="text-danger">*</span></span>
                                        <div class="box-session">
                                            <input type="text" class="valid valid_empty" placeholder="Persona a recibir" id="addressee" required>
                                        </div>
                                        <span class="d-none text-danger">Por favor llenar este campo.</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="font-weight-bold">Mensaje (Opcional)</span>
                                        <textarea class="form-control textarea" name="" id="customer-message" placeholder="Escribe tu mensaje aquí"></textarea>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-md btn-black-default-hover m-auto" type="submit">IR AL PAGO</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="checkout-data_buy">
                            <div class="title-data_buy">
                                <h3>3. MÉTODO DE PAGO</h3>
                            </div>

                            <div class="process-payment collapse px-5 py-5">
                                <div class="payment-selection">
                                    <div class="buy_bank-transfer">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="bank-transfer" name="flexRadioDefault" value="bank-transfer" checked>
                                            <label class="ml-2 form-check-label text-dark font-weight-bold fs-15" for="bank-transfer">Transferencia bancaria directa</label>
                                        </div>
                                        <div class="collapse_method-buy-transfer">
                                            <p class="text-dark">Realiza tu pago directamente en nuestra cuenta bancaria.</p>
                                            <p class="text-dark">Por favor, incluya el número de pedido en los detalles de la transferencia o también al concluir el depósito enviar una foto del comprobante y el número de pedido al correo <a href="mailto:ejemplo@gmail.com" class="text-primary font-weight-bold">ejemplo@gmail.com</a> o a nuestro whatsapp <span class="text-primary font-weight-bold">0987654321</span>. 
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="buy-test-example">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="credit-card" name="flexRadioDefault" value="credit-card">
                                            <label class="ml-2 form-check-label text-dark font-weight-bold fs-15" for="credit-card"><img src="<?= MEDIA_STORE; ?>images/img-payphone.png" alt=""></label>
                                        </div>
                                        <div class="collapse_method-buy-card" style="display: none;">
                                            <p class="text-dark">Payphone es la solución completa para pagos en línea. Segura, fácil y rápida.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accept-terms mt-4 mb-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="ml-2 form-check-label text-dark font-weight-bold fs-15" for="flexCheckDefault">
                                        Acepto los <a href="" class="text-primary">Términos y Condiciones</a> <span class="text-danger fs-12">* Obligatorio</span>
                                        </label>
                                    </div>
                                </div>

                                <div id="finalize-purchase">
                                    <button class="btn btn-block btn-deep-blue m-auto max-content" disabled>REALIZAR PEDIDO</button>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php
                }else{
                ?>
                <div class="content-loading">
                    <span class="loader-store"></span>
                </div>
                <div class="col-lg-7 col-md-7">
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

                <div class="col-lg-5 col-md-5">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>