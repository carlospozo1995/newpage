<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="">
	<title><?= $namePage == 'Index' ? $title_store : $title_page ; ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= MEDIA_STORE; ?>css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="<?= MEDIA_STORE; ?>css/vendor/ionicons.css">
    <link rel="stylesheet" href="<?= MEDIA_STORE; ?>css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="<?= MEDIA_STORE; ?>css/vendor/jquery-ui.min.css">

    <link rel="stylesheet" href="<?= MEDIA_STORE; ?>css/plugins/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= MEDIA_STORE; ?>css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?= MEDIA_STORE; ?>css/plugins/animate.min.css">
    <link rel="stylesheet" href="<?= MEDIA_STORE; ?>css/plugins/nice-select.css">
    <link rel="stylesheet" href="<?= MEDIA_STORE; ?>css/plugins/venobox.min.css">
    <link rel="stylesheet" href="<?= MEDIA_STORE; ?>css/plugins/jquery.lineProgressbar.css">
    <link rel="stylesheet" href="<?= MEDIA_STORE; ?>css/plugins/aos.min.css">

    <link rel="stylesheet" href="<?= MEDIA_STORE; ?>css/style.css">
    <link rel="stylesheet" href="<?= MEDIA_STORE; ?>css/store-style.css">
    <?php
		if(isset($file_css) && is_array($file_css) && !empty($file_css)){
			foreach ($file_css as $keycss => $valuecss) {
				echo '<link rel="stylesheet" href="'.MEDIA_STORE.'css/'.$valuecss.'.css">';
			}
		}
	?>
</head>
<body>
    <header class="header-section d-none d-xl-block">
        <div class="header-wrapper">

            <div class="header-top-main header-bottom-color--black section-fluid<?= isset($_SESSION['login']) ? ' d-flex justify-content-between align-items-center' : '';?>">
                <div class="header-top-contact header-top-contact-color--white header-top-contact-hover-color--page">
                    <a href="tel:0123456789" class="icon-space-right"><i class="icon-call-in"></i>0123456789</a>
                    <a href="mailto:demo@example.com" class="icon-space-right"><i class="icon-envelope"></i>demo@example.com</a>
                </div>
                <?= isset($_SESSION['login']) ? '<span class="text-light font-weight-bold text-uppercase">'.'!HOLA¡ '.$_SESSION['data_user']['name_user'].' '.$_SESSION['data_user']['surname_user'].'</span>' : ''; ?>
            </div>

            <?php if($section_name == "Index"){echo '<div class="header-top header-top-bg--white section-fluid">';}else{echo '<div class="header-top header-top-bg--white section-fluid" style="background: linear-gradient(to right, #bae1e1, #f5e7e3)">';} ?>
                <div class="container-fluid">
                    <div class="col-12 d-flex align-items-center justify-content-between">
                        <div class="z-20 header-top-left">
                            <div class="header-logo">
                                <div class="logo">
                                    <a href="<?= BASE_URL ?>"><img src="<?= MEDIA_STORE ?>images/logo/logo_text.png" alt=""></a>
                                </div>
                            </div>
                        </div>

                        <div class="z-20 header-top-right">
                            <ul class="header-action-link action-color--black action-hover-color--page">
                                <?php if($section_name != "Payment"){ ?>
                                <li class="position-relative user-session">
                                    <button<?= isset($_SESSION['login']) ? ' id="popover_mycount"' : ' data-bs-toggle="modal" data-bs-target="#modal-user"';?>>
                                        <i class="icon-user"></i>
                                    </button>
                                </li>
                                <?php }else{
                                    if (isset($_SESSION['login'])) {
                                ?>
                                <li class="position-relative user-session">
                                    <button id="popover_mycount">
                                        <i class="icon-user"></i>
                                    </button>
                                </li>
                                <?php
                                    }
                                } ?>

                                <li>
                                    <a href="#offcanvas-wishlish" class="offcanvas-toggle">
                                        <i class="icon-heart"></i>
                                        <span class="item-count">0</span>
                                    </a>
                                </li>
                                <?php
                                if($section_name != "Carrito" && $section_name != "Payment"){
                                ?>
                                    <li>
                                        <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                            <i class="icon-basket-loaded"></i>
                                            <span class="item-count amount-product-cart">0</span>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                                <li>
                                    <a href="#search">
                                        <i class="icon-magnifier"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <?php if($section_name == "Index") { echo '<div class="z-20 header-bottom section-fluid">';}else{ echo '<div class="z-20 header-bottom section-fluid" style="background: linear-gradient(to right, #bae1e1, #f5e7e3)">';} ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <div class="main-menu main-menu-style-4 menu-color--white menu-hover-color--aqua">
                                <nav>
                                <?php
                                    $arrCategories = Models_Categories::arrCategories("");

                                    $categoriesFather = [];
                                    foreach ($arrCategories as $category) {
                                        $father = $category['fatherCategory'];
                                        $categoriesFather[$father][] = $category;
                                    }

                                    if (!empty($categoriesFather[""])) {
                                        echo '<ul>';
                                            foreach ($categoriesFather[""] as $category) {
                                                echo '<li class="has-dropdown item-menu">';
                                                    echo '<a href="'.BASE_URL.'categoria/'.$category['url'].'" class="show-effect"> <div><img class="icon-menu-desktop" src="'.MEDIA_ADMIN.'files/images/uploads/'.$category['icon'].'" alt=""></div> <span>'.$category["name_category"].'</span></a>';
                                                    if(!empty($categoriesFather[$category['id_category']])){ 
                                                        echo '<ul class="sub-menu d-flex">';
                                                        foreach ($categoriesFather[$category['id_category']] as $subcategory) {
                                                            echo '<li class="item-sub-menu">';
                                                                echo '<a href="'.BASE_URL.'categoria/'.$category['url']."/".$subcategory['url'].'" class="time-trans-txt">'.$subcategory['name_category'].'</a>';
                                                                if (!empty($categoriesFather[$subcategory['id_category']])) {
                                                                    echo '<ul class="son-sub-menu">';
                                                                    foreach ($categoriesFather[$subcategory['id_category']] as $key => $son) {
                                                                        echo '<li class="item-son-sub-menu">';
                                                                            echo '<a href="'.BASE_URL.'categoria/'.$category['url']."/".$subcategory['url']."/".$son['url'].'" class="time-trans-txt">'.$son['name_category'].'</a>';
                                                                        echo '</li>';
                                                                    }
                                                                    echo '</ul>';
                                                                }
                                                            echo '</li>';
                                                        }
                                                        echo '</ul>';
                                                    }
                                                echo '</li>';
                                            }
                                        echo '</ul>';
                                    }
                                ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

            <div class="z-100 sticky-header sticky-color--white section-fluid seperate-sticky-bar">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <div class="main-menu main-menu-style-4 menu-color--white menu-hover-color--aqua">
                                <nav>
                                <?php
                                    $arrCategories = Models_Categories::arrCategories("");

                                    $categoriesFather = [];
                                    foreach ($arrCategories as $category) {
                                        $father = $category['fatherCategory'];
                                        $categoriesFather[$father][] = $category;
                                    }

                                    if (!empty($categoriesFather[""])) {
                                        echo '<ul>';
                                            foreach ($categoriesFather[""] as $category) {
                                                echo '<li class="has-dropdown item-menu">';
                                                    echo '<a href="'.BASE_URL.'categoria/'.$category['url'].'" class="show-effect"> <div><img class="icon-menu-desktop" src="'.MEDIA_ADMIN.'files/images/uploads/'.$category['icon'].'" alt=""></div> <span>'.$category["name_category"].'</span></a>';
                                                    if(!empty($categoriesFather[$category['id_category']])){ 
                                                        echo '<ul class="sub-menu d-flex">';
                                                        foreach ($categoriesFather[$category['id_category']] as $subcategory) {
                                                            echo '<li class="item-sub-menu">';
                                                                echo '<a href="'.BASE_URL.'categoria/'.$category['url']."/".$subcategory['url'].'" class="time-trans-txt">'.$subcategory['name_category'].'</a>';
                                                                if (!empty($categoriesFather[$subcategory['id_category']])) {
                                                                    echo '<ul class="son-sub-menu">';
                                                                    foreach ($categoriesFather[$subcategory['id_category']] as $key => $son) {
                                                                        echo '<li class="item-son-sub-menu">';
                                                                            echo '<a href="'.BASE_URL.'categoria/'.$category['url']."/".$subcategory['url']."/".$son['url'].'" class="time-trans-txt">'.$son['name_category'].'</a>';
                                                                        echo '</li>';
                                                                    }
                                                                    echo '</ul>';
                                                                }
                                                            echo '</li>';
                                                        }
                                                        echo '</ul>';
                                                    }
                                                echo '</li>';
                                            }
                                        echo '</ul>';
                                    }
                                ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($section_name == "Index"): ?>
            <div class="container-slider z-10"> 
                <div class="hero-slider-section">
                    <div class="hero-slider-active swiper-container">
                        <div class="swiper-wrapper">
                        <?php
                        $sliderDstCtg = Models_Banners::getBanners("banners_category", "sliderDst, sliderDesOne, sliderDesTwo, redirect", 1);
                        $sliderDstProd = Models_Banners::getBanners("banners_product", "sliderDst, sliderDes, redirect", 1);

                        if (empty($sliderDstCtg) && empty($sliderDstProd)) {
                            echo '<div class="hero-single-slider-item swiper-slide">';
                                echo '<div class="hero-slider-bg">';
                                    echo '<img src="'.MEDIA_ADMIN.'files/images/slider-test-dst.png">';
                                echo '</div>';
                            echo '</div>';
                        }else{
                            foreach ($sliderDstCtg as $key => $value) {
                                echo '<div class="hero-single-slider-item swiper-slide">';
                                    echo '<div class="hero-slider-bg">';
                                        echo '<a href="'.BASE_URL.'categoria/'.$value['redirect'].'">';
                                            echo '<img src="'.MEDIA_ADMIN.'files/images/uploads/'.$value['sliderDst'].'">';
                                        echo '</a>';
                                    echo '</div>';

                                    echo '<div class="hero-slider-wrapper">';
                                        echo '<div class="container">';
                                            echo '<div class="row">';
                                                echo '<div class="col-auto">';
                                                    echo '<div class="hero-slider-content">';
                                                    if (!empty($value['sliderDesOne'])) {
                                                        if (!empty($value['sliderDesTwo'])) {
                                                            echo '<h4 class="subtitle">'.$value['sliderDesTwo'].'</h4>';
                                                            echo '<h1 class="title">'.$value['sliderDesOne'].'</h1>';
                                                        }else{
                                                            echo '<h1 class="title title-time-one">'.$value['sliderDesOne'].'</h1>';
                                                        }
                                                    }
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            }

                            foreach ($sliderDstProd as $key => $value) {
                                echo '<div class="hero-single-slider-item swiper-slide">';
                                    echo '<div class="hero-slider-bg">';
                                        echo '<a href="'.BASE_URL.'producto/'.$value['redirect'].'">';
                                            echo '<img src="'.MEDIA_ADMIN.'files/images/upload_products/'.$value['sliderDst'].'">';
                                        echo '</a>';
                                    echo '</div>';

                                    echo '<div class="hero-slider-wrapper">';
                                        echo '<div class="container">';
                                            echo '<div class="row">';
                                                echo '<div class="col-auto">';
                                                    echo '<div class="hero-slider-content">';
                                                        if (!empty($value['sliderDes'])){
                                                            echo '<h1 style="margin-top:-125px" class="title title-time-one">'.$value['sliderDes'].'</h1>';
                                                        }
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            }
                        }
                        ?>
                        </div>

                        <!-- If we need pagination -->
                        <div class="swiper-pagination active-color-store"></div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev d-none d-lg-block"></div>
                        <div class="swiper-button-next d-none d-lg-block"></div>
                    </div>
                </div>
            </div>
            <?php endif ?>

        </div>
    </header>

    <!-- Start Mobile Header -->
    <?php if($section_name == "Index"){echo '<div class="mobile-header  mobile-header-bg-color--white section-fluid d-lg-block d-xl-none bg-mist-white">';}else{ echo '<div class="mobile-header  mobile-header-bg-color--white section-fluid d-lg-block d-xl-none" style="background: linear-gradient(to right, #bae1e1, #f5e7e3)">';} ?>
    
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex align-items-center justify-content-between f-dir-colum-res">
                    
                    <div class="mobile-header-left">
                        <ul class="mobile-menu-logo">
                            <li>
                                <a href="<?= BASE_URL; ?>">
                                    <div class="logo">
                                        <img src="<?= MEDIA_STORE ?>images/logo/logo_text.png" alt="">
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="mobile-right-side">
                        <ul class="header-action-link action-color--black action-hover-color--page">
                            <?php if($section_name != "Payment"){ ?>
                            <li class="position-relative user-session">
                                <button<?= isset($_SESSION['login']) ? ' id="popover_mycount"' : ' data-bs-toggle="modal" data-bs-target="#modal-user"';?>>
                                    <i class="icon-user"></i>
                                </button>
                            </li>
                            <?php } else{
                                if(isset($_SESSION['login'])){
                            ?>
                            <li class="position-relative user-session">
                                <button id="popover_mycount">
                                    <i class="icon-user"></i>
                                </button>
                            </li>
                            <?php       
                                }
                            }?>
                            <li>
                                <a href="#offcanvas-wishlish" class="offcanvas-toggle">
                                    <i class="icon-heart"></i>
                                    <span class="item-count">0</span>
                                </a>
                            </li>
                            <?php if($section_name != "Carrito" && $section_name != "Payment"){ ?>
                            <li>
                                <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                    <i class="icon-basket-loaded"></i>
                                    <span class="item-count amount-product-cart">0</span>
                                </a>
                            </li>
                            <?php } ?>
                            <li>
                                <a href="#search">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#mobile-menu-offcanvas" class="offcanvas-toggle offside-menu">
                                    <i class="icon-menu"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Mobile Header -->

    <!--  Start Offcanvas Mobile Menu Section -->
    <div id="mobile-menu-offcanvas" class="offcanvas offcanvas-rightside offcanvas-mobile-menu-section">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right">
            <button class="offcanvas-close"><i class="ion-android-close"></i></button>
        </div> <!-- End Offcanvas Header -->
        <!-- Start Offcanvas Mobile Menu Wrapper -->
        <div class="offcanvas-mobile-menu-wrapper">
            <!-- Start Mobile Menu  -->
            <div class="mobile-menu-bottom">
                <!-- Start Mobile Menu Nav -->
                <div class="offcanvas-menu">
                    <?php
                        $arrCategories = Models_Categories::arrCategories("");

                        $categoriesFather = [];
                        foreach ($arrCategories as $category) {
                            $father = $category['fatherCategory'];
                            $categoriesFather[$father][] = $category;
                        }

                        if (!empty($categoriesFather[""])) {
                            echo '<ul>';
                                foreach ($categoriesFather[""] as $category) {
                                    echo '<li>';
                                        echo '<div class="cont-link">';
                                            echo '<a href="'.BASE_URL.'categoria/'.$category['url'].'"><img class="icon-menu-mobile" src="'.MEDIA_ADMIN.'files/images/uploads/'.$category['icon'].'" alt=""><span>'.$category['name_category'].'</span></a>';
                                        echo '</div>';
                                        if(!empty($categoriesFather[$category['id_category']])){ 
                                            echo '<ul class="mobile-sub-menu">';
                                            foreach ($categoriesFather[$category['id_category']] as $subcategory) {
                                                echo '<li>';
                                                    echo '<div class="cont-link">';
                                                        echo '<a class="offset-2" href="'.BASE_URL.'categoria/'.$category['url']."/".$subcategory['url'].'">'.$subcategory['name_category'].'</a>';
                                                    echo '</div>';
                                                    
                                                    if (!empty($categoriesFather[$subcategory['id_category']])) {
                                                        echo '<ul class="mobile-sub-menu">';
                                                        foreach ($categoriesFather[$subcategory['id_category']] as $key => $son) {
                                                            echo '<li>';
                                                                echo '<div class="cont-link">';
                                                                     echo '<a class="offset-3" href="'.BASE_URL.'categoria/'.$category['url']."/".$subcategory['url']."/".$son['url'].'">'.$son['name_category'].'</a>';
                                                                echo '</div>';
                                                               
                                                            echo '</li>';
                                                        }
                                                        echo '</ul>';
                                                    }
                                                echo '</li>';
                                            }
                                            echo '</ul>';
                                        }
                                    echo '</li>';
                                }
                            echo '</ul>';
                        }
                    ?>
                </div> <!-- End Mobile Menu Nav -->
            </div> <!-- End Mobile Menu -->

            <!-- Start Mobile contact Info -->
            <div class="mobile-contact-info">
                <div class="logo">
                    <a href="<?= BASE_URL ?>"><img src="<?= MEDIA_STORE ?>images/logo/logo.png" alt=""></a>
                </div>

                <address class="address">
                    <span>Address: Your address goes here.</span>
                    <span>Call Us: 0123456789, 0123456789</span>
                    <span>Email: demo@example.com</span>
                </address>

                <ul class="social-link">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                </ul>

                <ul class="user-link">
                    <li><a href="wishlist.html">Wishlist</a></li>
                    <li><a href="<?= BASE_URL; ?>carrito">Carrito</a></li>
                    <li><a href="checkout.html">Checkout</a></li>
                </ul>
            </div>
            <!-- End Mobile contact Info -->

        </div> <!-- End Offcanvas Mobile Menu Wrapper -->
    </div> <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

    <!-- Start Offcanvas Search Bar Section -->
    <div id="search" class="search-modal">
        <button type="button" class="close">×</button>
        <form>
            <div class="search-content">
                <input type="text" placeholder="¡Hola! ¿Qué producto buscas?">
                <button type="submit" class="btn btn-lg btn-deep-blue"><i class="icon-magnifier font-weight-bold"></i></button>
            </div>

            <div class="search-data d-none">
                <div class="row">
                    <div class="col-lg-4 position-relative">
                        <p>SUGERENCIAS</p>
                        <ul class="content-suggestions">
                        
                        </ul>
                    </div>

                    <div class="col-lg-8 border-left position-relative">
                        <div class="searched-product-content">
                            <div class="product-default-slider-section section-fluid">
                                <div class="product-wrapper"">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12 content-products">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="content-amount-products"></div>

                        <div class="cont-load-search"><span class="loader-search"></span></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- End Offcanvas Search Bar Section -->

    <!-- Start Offcanvas Addcart Section -->
    <div id="offcanvas-add-cart" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right">
            <button class="offcanvas-close"><i class="ion-android-close"></i></button>
        </div> <!-- End Offcanvas Header -->

        <!-- Start  Offcanvas Addcart Wrapper -->
        <div class="offcanvas-add-cart-wrapper">
            <h4 class="offcanvas-title text-center font-weight-bold">CARRITO DE COMPRAS</h4>
            <div id="modal-shopping-cart-container">
                
            </div>
        </div> <!-- End  Offcanvas Addcart Wrapper -->

    </div> <!-- End  Offcanvas Addcart Section -->

    <!-- Start Offcanvas Mobile Menu Section -->
    <div id="offcanvas-wishlish" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right">
            <button class="offcanvas-close"><i class="ion-android-close"></i></button>
        </div> <!-- ENd Offcanvas Header -->

        <!-- Start Offcanvas Mobile Menu Wrapper -->
        <div class="offcanvas-wishlist-wrapper">
            <h4 class="offcanvas-title">Wishlist</h4>
            <ul class="offcanvas-wishlist">
                <li class="offcanvas-wishlist-item-single">
                    <div class="offcanvas-wishlist-item-block">
                        <a href="#" class="offcanvas-wishlist-item-image-link">
                            <img src="" alt=""
                                class="offcanvas-wishlist-image">
                        </a>
                        <div class="offcanvas-wishlist-item-content">
                            <a href="#" class="offcanvas-wishlist-item-link">Car Wheel</a>
                            <div class="offcanvas-wishlist-item-details">
                                <span class="offcanvas-wishlist-item-details-quantity">1 x </span>
                                <span class="offcanvas-wishlist-item-details-price">$49.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas-wishlist-item-delete text-right">
                        <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                    </div>
                </li>
                <li class="offcanvas-wishlist-item-single">
                    <div class="offcanvas-wishlist-item-block">
                        <a href="#" class="offcanvas-wishlist-item-image-link">
                            <img src="" alt=""
                                class="offcanvas-wishlist-image">
                        </a>
                        <div class="offcanvas-wishlist-item-content">
                            <a href="#" class="offcanvas-wishlist-item-link">Car Vails</a>
                            <div class="offcanvas-wishlist-item-details">
                                <span class="offcanvas-wishlist-item-details-quantity">3 x </span>
                                <span class="offcanvas-wishlist-item-details-price">$500.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas-wishlist-item-delete text-right">
                        <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                    </div>
                </li>
                <li class="offcanvas-wishlist-item-single">
                    <div class="offcanvas-wishlist-item-block">
                        <a href="#" class="offcanvas-wishlist-item-image-link">
                            <img src="" alt=""
                                class="offcanvas-wishlist-image">
                        </a>
                        <div class="offcanvas-wishlist-item-content">
                            <a href="#" class="offcanvas-wishlist-item-link">Shock Absorber</a>
                            <div class="offcanvas-wishlist-item-details">
                                <span class="offcanvas-wishlist-item-details-quantity">1 x </span>
                                <span class="offcanvas-wishlist-item-details-price">$350.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas-wishlist-item-delete text-right">
                        <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                    </div>
                </li>
            </ul>
            <ul class="offcanvas-wishlist-action-button">
                <li><a href="#" class="btn btn-block btn-aqua">View wishlist</a></li>
            </ul>
        </div> <!-- End Offcanvas Mobile Menu Wrapper -->

    </div> <!-- End Offcanvas Mobile Menu Section -->

    <!-- Offcanvas Overlay -->
    <div class="offcanvas-overlay"></div>

    <!-- START SECTION PAGE -->
    <div class="content-section-page">