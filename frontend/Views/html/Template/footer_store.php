    </div>
    <!-- END SECTION PAGE -->
    
    <!-- Start Footer Section -->
    <footer class="footer-section footer-bg">
        <div class="footer-wrapper">
            <!-- Start Footer Top -->
            <div class="footer-top">
                <div class="container">
                    <div class="row mb-n6">
                        <div class="col-lg-3 col-sm-6 mb-6">
                            <!-- Start Footer Single Item -->
                            <div class="footer-widget-single-item footer-widget-color--aqua" data-aos="fade-up"
                                data-aos-delay="0">
                                <h5 class="title">INFORMATION</h5>
                                <ul class="footer-nav">
                                    <li><a href="#">Delivery Information</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="contact-us.html">Contact</a></li>
                                    <li><a href="#">Returns</a></li>
                                </ul>
                            </div>
                            <!-- End Footer Single Item -->
                        </div>
                        <div class="col-lg-3 col-sm-6 mb-6">
                            <!-- Start Footer Single Item -->
                            <div class="footer-widget-single-item footer-widget-color--aqua" data-aos="fade-up"
                                data-aos-delay="200">
                                <h5 class="title">MY ACCOUNT</h5>
                                <ul class="footer-nav">
                                    <li><a href="my-account.html">My account</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                    <li><a href="faq.html">Frequently Questions</a></li>
                                    <li><a href="#">Order History</a></li>
                                </ul>
                            </div>
                            <!-- End Footer Single Item -->
                        </div>
                        <div class="col-lg-3 col-sm-6 mb-6">
                            <!-- Start Footer Single Item -->
                            <div class="footer-widget-single-item footer-widget-color--aqua" data-aos="fade-up"
                                data-aos-delay="400">
                                <h5 class="title">CATEGORIES</h5>
                                <ul class="footer-nav">
                                    <li><a href="#">Decorative</a></li>
                                    <li><a href="#">Kitchen utensils</a></li>
                                    <li><a href="#">Chair & Bar stools</a></li>
                                    <li><a href="#">Sofas and Armchairs</a></li>
                                    <li><a href="#">Interior lighting</a></li>
                                </ul>
                            </div>
                            <!-- End Footer Single Item -->
                        </div>
                        <div class="col-lg-3 col-sm-6 mb-6">
                            <!-- Start Footer Single Item -->
                            <div class="footer-widget-single-item footer-widget-color--aqua" data-aos="fade-up"
                                data-aos-delay="600">
                                <h5 class="title">ABOUT US</h5>
                                <div class="footer-about">
                                    <p>We are a team of designers and developers that create high quality Magento,
                                        Prestashop, Opencart.</p>

                                    <address>
                                        <span>Address: Your address goes here.</span>
                                        <span>Email: demo@example.com</span>
                                    </address>
                                </div>
                            </div>
                            <!-- End Footer Single Item -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Footer Top -->

            <!-- Start Footer Center -->
            <div class="footer-center">
                <div class="container">
                    <div class="row mb-n6">
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-6">
                            <div class="footer-social" data-aos="fade-up" data-aos-delay="0">
                                <h4 class="title">FOLLOW US</h4>
                                <ul class="footer-social-link">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6 col-md-6 mb-6">
                            <div class="footer-newsletter" data-aos="fade-up" data-aos-delay="200">
                                <h4 class="title">DON'T MISS OUT ON THE LATEST</h4>
                                <div class="form-newsletter">
                                    <form action="#" method="post">
                                        <div class="form-fild-newsletter-single-item input-color--aqua">
                                            <input type="email" placeholder="Your email address..." required>
                                            <button type="submit">SUBSCRIBE!</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Footer Center -->

            <!-- Start Footer Bottom -->
            <div class="footer-bottom">
                <div class="container">
                    <div
                        class="row justify-content-between align-items-center align-items-center flex-column flex-md-row mb-n6">
                        <div class="col-auto mb-6">
                            <div class="footer-copyright">
                                <p class="copyright-text">&copy; 2021 <a href="index.html">therankme</a>. Made with <i
                                        class="fa fa-heart text-danger"></i> by <a href="https://therankme.com/"
                                        target="_blank">therankme</a> </p>

                            </div>
                        </div>
                        <div class="col-auto mb-6">
                            <div class="footer-payment">
                                <div class="image">
                                    <img src="" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Footer Bottom -->
        </div>
    </footer>
    <!-- End Footer Section -->    
    <!-- material-scrolltop button -->
    <button class="material-scrolltop" type="button"><i class="fa fa-chevron-up text-light"></i></button>

    <div class="modal fade" id="modalAddcart" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close modal-close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="addd-product-container">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if($section_name != "Payment"){ ?>
    <div class="modal fade" tabindex="-1" id="modal-user">
        <div class="modal-dialog">
            <div class="modal-content p-1">
                <div class="d-block">
                    <div class="d-flex justify-content-end p-2"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <h5 class="modal-title text-center c-p-deep-blue font-weight-bold">INGRESE A SU CUENTA</h5>
                </div>
                <div class="modal-body">
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
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-register" data-bs-dismiss="modal" class="text-center mt-4">¿No tiene una cuenta? Registrese</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="modal-register">
        <div class="modal-dialog">
            <div class="modal-content p-1">
                <div class="d-block">
                    <div class="d-flex justify-content-end p-2"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <h5 class="modal-title text-center c-p-deep-blue font-weight-bold">NUEVO REGISTRO DE CUENTA</h5>
                </div>
                <div class="modal-body">
                    <form class="register-client">
                        <div class="alert-register"></div>
                        <div class="default-form-box">
                            <div class="box-session">
                                <i class="fa fa-user-o"></i>
                                <input type="text" class="client-name valid valid_text" placeholder="Nombre">
                            </div>
                            <span class="d-none text-danger fs-12">Este campo solo debe contener letras y espacios.</span>
                        </div>
                        <div class="default-form-box">
                            <div class="box-session">
                                <i class="fa fa-user-o"></i>
                                <input type="text" class="client-surname valid valid_text" placeholder="Apellido">
                            </div>
                            <span class="d-none text-danger fs-12">Este campo solo debe contener letras y espacios.</span>
                        </div>
                        <div class="default-form-box">
                            <div class="box-session">
                                <i class="icon-phone"></i>
                                <input type="text" class="client-phone valid valid_phone" placeholder="Teléfono / celular">
                            </div>
                            <span class="d-none text-danger fs-12">Añadir números de 7 o 10 dígitos.</span>
                        </div>
                        <div class="default-form-box">
                            <div class="box-session">
                                <i class="fa fa-envelope-o"></i>
                                <input type="email" class="client-email valid valid_email" placeholder="Correo electrónico">
                            </div>
                            <span class="d-none text-danger fs-12">Este campo debe tener un correo valido.</span>
                        </div>
                        <div class="default-form-box">
                            <div class="box-session">
                                <i class="icon-lock"></i>
                                <input type="password" class="client-password valid valid_password" placeholder="Contraseña">
                                <span class="mr-3" role='button'><i class="fa fa-eye-slash show-password"></i></span>
                            </div>
                            <span class="d-none text-danger fs-12">Añadir mínimo 8 caracteres entre numeros, letras minusculas y mayusculas.</span>
                        </div>
                        <div class="login_submit">
                            <button class="btn btn-md btn-black-default-hover m-auto" type="submit">CREAR CUENTA</button>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-user" data-bs-dismiss="modal" class="text-center mt-4">¿Ya tienes una cuenta? Ingrese</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php }else{ 
        if (isset($_SESSION['login'])) {
    ?>
    <div class="modal fade" id="modalProductsChanges" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title font-weight-bold m-auto c-p-deep-blue text-center"></h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="c-coral text-center font-weight-bold">Productos pedidos</h5>
                            <div class="oredererProducts"></div>
                        </div>
                        <div class="col-md-4">
                            <h5 class="c-coral text-center font-weight-bold">Presentan cambios</h5>
                            <div class="productsChanges"></div>
                        </div>
                        <div class="col-md-4">
                            <h5 class="c-coral text-center font-weight-bold">Pedido actualizado</h5>
                            <div class="newProducts"></div>
                            <div class="modifiedTotal"></div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="modal-footer">
                    
                </div>

            </div>
        </div>
    </div>
    <?php   
        }
    } 
    ?>

    <script> const base_url = "<?= BASE_URL; ?>"; </script>
    <script> const media_store= "<?= MEDIA_STORE; ?>"; </script>
    
    <script src="<?= MEDIA_STORE; ?>js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/vendor/jquery-3.5.1.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/vendor/popper.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/vendor/bootstrap.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/vendor/jquery-ui.min.js"></script>

    <script src="<?= MEDIA_STORE; ?>js/plugins/sweetalert2.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/swiper-bundle.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/material-scrolltop.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/jquery.nice-select.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/jquery.zoom.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/venobox.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/jquery.waypoints.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/jquery.lineProgressbar.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/aos.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/jquery.instagramFeed.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/ajax-mail.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/main.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/store-functions.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/store-storage.js"></script>
  

    <?php
        if(isset($file_js) && is_array($file_js) && !empty($file_js)){
            foreach ($file_js as $keyjs => $valuejs) {
                echo '<script src="'.MEDIA_STORE.'js/'.$valuejs.'.js"></script>';
            }
        }
    ?>

</body>
</html>
