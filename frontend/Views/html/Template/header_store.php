<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="">
	<title><?= $title_store ?></title>

    <link rel="stylesheet" href="<?= MEDIA_STORE; ?>css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="<?= MEDIA_STORE; ?>css/vendor/ionicons.css">
    <link rel="stylesheet" href="<?= MEDIA_STORE; ?>css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="<?= MEDIA_STORE; ?>css/vendor/jquery-ui.min.css">

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

            <div class="header-top header-top-bg--white section-fluid">
                <div class="container-fluid">
                    <div class="col-12 d-flex align-items-center justify-content-between">
                        <div class="header-top-left">
                            <div
                                class="header-top-contact header-top-contact-color--black header-top-contact-hover-color--aqua">
                                <a href="tel:0123456789" class="icon-space-right"><i class="icon-call-in"></i>0123456789</a>
                                <a href="mailto:demo@example.com" class="icon-space-right"><i class="icon-envelope"></i>demo@example.com</a>
                            </div>
                        </div>
                        <div class="header-top-center">

                            <div class="header-logo">
                                <div class="logo">
                                    <a href="<?= BASE_URL ?>"><img src="<?= MEDIA_STORE ?>images/logo/logo_text.png" alt=""></a>
                                </div>
                            </div>

                        </div>
                        <div class="header-top-right">
                            
                            <ul class="header-action-link action-color--black action-hover-color--aqua">
                                <li>
                                    <a href="#offcanvas-wishlish" class="offcanvas-toggle">
                                        <i class="icon-heart"></i>
                                        <span class="item-count">3</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                        <i class="icon-bag"></i>
                                        <span class="item-count">3</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#search">
                                        <i class="icon-magnifier"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#offcanvas-about" class="offacnvas offside-about offcanvas-toggle">
                                        <i class="icon-menu"></i>
                                    </a>
                                </li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Start Mobile Header -->
    <div class="mobile-header  mobile-header-bg-color--white section-fluid d-lg-block d-xl-none">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <!-- Start Mobile Left Side -->
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
                    <!-- End Mobile Left Side -->

                    <!-- Start Mobile Right Side -->
                    <div class="mobile-right-side">
                        <ul class="header-action-link action-color--black action-hover-color--aqua">
                            <li>
                                <a href="#search">
                                    <i class="icon-magnifier icon-data"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#offcanvas-wishlish" class="offcanvas-toggle">
                                    <i class="icon-heart icon-data"></i>
                                    <span class="item-count">3</span>
                                </a>
                            </li>
                            <li>
                                <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                    <i class="icon-bag icon-data"></i>
                                    <span class="item-count">3</span>
                                </a>
                            </li>
                            <li>
                                <a href="#mobile-menu-offcanvas" class="offcanvas-toggle offside-menu">
                                    <i class="icon-menu icon-data"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Mobile Right Side -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Mobile Header -->