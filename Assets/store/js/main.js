(function($) {
    "use strict";

    /*****************************
     * Number Format
     *****************************/
    function numberFormat(number, decimals = 2, decPoint = ',', thousandsSep = '.') {
        return number.toFixed(decimals).replace('.', decPoint).replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSep);
    }
    /*****************************
     * Commons Variables
     *****************************/
    var $window = $(window),
        $body = $('body');

    /****************************
     * Sticky Menu
     *****************************/
    $(window).on('scroll', function() {
        var scroll = $(window).scrollTop();
        if (scroll < 150) {
            $(".sticky-header").removeClass("sticky");
        } else {
            $(".sticky-header").addClass("sticky");
        }
    });

    $(window).on('scroll', function() {
        var scroll = $(window).scrollTop();
        if (scroll < 150) {
            $(".seperate-sticky-bar").removeClass("sticky");
        } else {
            $(".seperate-sticky-bar").addClass("sticky");
        }
    });

    /************************************************
     * Modal Search 
     ***********************************************/
    $('a[href="#search"]').on('click', function(event) {
        event.preventDefault();
        $('body').css('overflow', 'hidden');
        $('#search').addClass('open');
        $('#search > form > input[type="search"]').focus();
    });

    $('#search, #search button.close').on('click', function(event) {
        if ( event.target.className == 'close' ) {
            $('body').css('overflow', 'auto');
            $(this).removeClass('open');
        }
    });

    /*****************************
     * Off Canvas Function
     *****************************/
    (function() {
        var $offCanvasToggle = $('.offcanvas-toggle'),
            $offCanvas = $('.offcanvas'),
            $offCanvasOverlay = $('.offcanvas-overlay'),
            $mobileMenuToggle = $('.mobile-menu-toggle');
        $offCanvasToggle.on('click', function(e) {
            e.preventDefault();
            $('body').css('overflow', 'hidden');
            var $this = $(this),
                $target = $this.attr('href');
            $body.addClass('offcanvas-open');
            $($target).addClass('offcanvas-open');
            $offCanvasOverlay.fadeIn();
            if ($this.parent().hasClass('mobile-menu-toggle')) {
                $this.addClass('close');
            }
        });
        $('.offcanvas-close, .offcanvas-overlay').on('click', function(e) {
            e.preventDefault();
            $('body').css('overflow', 'auto');
            $body.removeClass('offcanvas-open');
            $offCanvas.removeClass('offcanvas-open');
            $offCanvasOverlay.fadeOut();
            $mobileMenuToggle.find('a').removeClass('close');
        });
    })();


    /**************************
     * Offcanvas: Menu Content
     **************************/
    
    // Change function //
    // function mobileOffCanvasMenu() {
    //     var $offCanvasNav = $('.offcanvas-menu'),
    //         $offCanvasNavSubMenu = $offCanvasNav.find('.mobile-sub-menu');

    //     /*Add Toggle Button With Off Canvas Sub Menu*/
    //     $offCanvasNavSubMenu.parent().prepend('<div class="offcanvas-menu-expand"></div>');

    //     /*Category Sub Menu Toggle*/
    //     $offCanvasNav.on('click', 'li a, .offcanvas-menu-expand', function(e) {
    //         var $this = $(this);

    //         if ($this.attr('href') === '#' || $this.hasClass('offcanvas-menu-expand')) {
    //             e.preventDefault();
    //             if ($this.siblings('ul:visible').length) {
    //                 $this.parent('li').removeClass('active');
    //                 $this.siblings('ul').slideUp();
    //                 $this.parent('li').find('li').removeClass('active');
    //                 $this.parent('li').find('ul:visible').slideUp();
    //             } else {
    //                 $this.parent('li').addClass('active');
    //                 $this.closest('li').siblings('li').removeClass('active').find('li').removeClass('active');
    //                 $this.closest('li').siblings('li').find('ul:visible').slideUp();
    //                 $this.siblings('ul').slideDown();
    //             }
    //         }
    //     });
    // }


    function mobileOffCanvasMenu() {
        var $offCanvasNav = $('.offcanvas-menu'),
        $offCanvasNavSubMenu = $offCanvasNav.find('.mobile-sub-menu');

        /*Add Toggle Button With Off Canvas Sub Menu*/
        $offCanvasNavSubMenu.parent().each(function() {
            var $this = $(this),
            $subMenu = $this.find('> ul');
            if ($subMenu.length) {
                $this.children('.cont-link').append('<span class="offcanvas-menu-expand-icon d-flex align-items-center"><i class="fa fa-angle-right"></i></span>');
            }
        });

        /*Category Sub Menu Toggle*/
        $offCanvasNav.on('click', 'li a, .offcanvas-menu-expand-icon', function(e) {
            var $this = $(this);
            if ($this.attr('href') === '#' || $this.hasClass('offcanvas-menu-expand-icon')) {
                e.preventDefault();
                var $ul = $this.closest('li').find('> ul');
                if ($ul.filter(':visible').length) {
                    $this.closest('li').removeClass('active');
                    $ul.slideUp();
                    $this.closest('li').find('li').removeClass('active');
                    $this.closest('li').find('ul:visible').slideUp();
                } else {
                    $this.closest('li').addClass('active');
                    $this.closest('li').siblings('li').removeClass('active').find('li').removeClass('active');
                    $this.closest('li').siblings('li').find('ul:visible').slideUp();
                    $ul.slideDown();
                }
            }
        });
    }

    mobileOffCanvasMenu();

    /************************************************
     * Nice Select
     ***********************************************/
    $('select').niceSelect();


    /*************************
     *   Hero Slider Active
     **************************/
    var heroSlider = new Swiper('.hero-slider-active.swiper-container', {
        slidesPerView: 1,
        effect: "fade",
        speed: 1500,
        watchSlidesProgress: true,
        loop: true,
        autoplay: false,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });


    /****************************************
     *   Product Slider Active - 4 Grid 2 Rows
     *****************************************/
    var productSlider4grid2row = new Swiper('.product-default-slider-4grid-2row.swiper-container', {
        slidesPerView: 4,
        spaceBetween: 30,
        speed: 1500,
        slidesPerColumn: 2,
        slidesPerColumnFill: 'row',

        navigation: {
            nextEl: '.product-slider-default-2rows .swiper-button-next',
            prevEl: '.product-slider-default-2rows .swiper-button-prev',
        },

        breakpoints: {

            0: {
                slidesPerView: 1,
            },
            576: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            },
            1200: {
                slidesPerView: 4,
            }
        }
    });


    /*********************************************
     *   Product Slider Active - 4 Grid Single Rows
     **********************************************/
    var productSlider4grid1row = new Swiper('.product-default-slider-4grid-1row.swiper-container', {
        slidesPerView: 4,
        spaceBetween: 30,
        speed: 1500,

        navigation: {
            nextEl: '.product-slider-default-1row .swiper-button-next',
            prevEl: '.product-slider-default-1row .swiper-button-prev',
        },

        breakpoints: {

            0: {
                slidesPerView: 1,
            },
            576: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            },
            1200: {
                slidesPerView: 4,
            }
        }
    });

    /*********************************************
     *   Product Slider Active - 4 Grid Single 3Rows
     **********************************************/
    var productSliderListview4grid3row = new Swiper('.product-listview-slider-4grid-3rows.swiper-container', {
        slidesPerView: 4,
        spaceBetween: 30,
        speed: 1500,
        slidesPerColumn: 3,
        slidesPerColumnFill: 'row',

        navigation: {
            nextEl: '.product-list-slider-3rows .swiper-button-next',
            prevEl: '.product-list-slider-3rows .swiper-button-prev',
        },

        breakpoints: {

            0: {
                slidesPerView: 1,
            },
            640: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            },
            1200: {
                slidesPerView: 4,
            }
        }
    });


    /*********************************************
     *   Blog Slider Active - 3 Grid Single Rows
     **********************************************/
    var blogSlider = new Swiper('.blog-slider.swiper-container', {
        slidesPerView: 3,
        spaceBetween: 30,
        speed: 1500,

        navigation: {
            nextEl: '.blog-default-slider .swiper-button-next',
            prevEl: '.blog-default-slider .swiper-button-prev',
        },
        breakpoints: {

            0: {
                slidesPerView: 1,
            },
            576: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            },
        }
    });


    /*********************************************
     *   Company Logo Slider Active - 7 Grid Single Rows
     **********************************************/
    var companyLogoSlider = new Swiper('.company-logo-slider.swiper-container', {
        slidesPerView: 7,
        speed: 1500,

        navigation: {
            nextEl: '.company-logo-slider .swiper-button-next',
            prevEl: '.company-logo-slider .swiper-button-prev',
        },
        breakpoints: {

            0: {
                slidesPerView: 1,
            },
            480: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            992: {
                slidesPerView: 3,
            },
            1200: {
                slidesPerView: 7,
            },
        }
    });

    /********************************
     *  Product Gallery - Horizontal View
     **********************************/
    var galleryThumbsHorizontal = new Swiper('.product-image-thumb-horizontal.swiper-container', {
        loop: true,
        speed: 1000,
        spaceBetween: 25,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

    });

    var gallerylargeHorizonatal = new Swiper('.product-large-image-horaizontal.swiper-container', {
        slidesPerView: 1,
        speed: 1500,
        thumbs: {
            swiper: galleryThumbsHorizontal
        }
    });

    /********************************
     *  Product Gallery - Vertical View
     **********************************/
    var galleryThumbsvartical = new Swiper('.product-image-thumb-vartical.swiper-container', {
        direction: 'vertical',
        centeredSlidesBounds: true,
        slidesPerView: 4,
        watchOverflow: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        spaceBetween: 25,
        freeMode: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

    });

    var gallerylargeVartical = new Swiper('.product-large-image-vartical.swiper-container', {
        slidesPerView: 1,
        speed: 1500,
        thumbs: {
            swiper: galleryThumbsvartical
        }
    });

    /********************************
     *  Product Gallery - Single Slide View
     * *********************************/
    var singleSlide = new Swiper('.product-image-single-slide.swiper-container', {
        loop: true,
        speed: 1000,
        spaceBetween: 25,
        slidesPerView: 4,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            576: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            992: {
                slidesPerView: 4,
            },
            1200: {
                slidesPerView: 4,
            },
        }

    });

    /******************************************************
     * Quickview Product Gallery - Horizontal
     ******************************************************/
    var modalGalleryThumbs = new Swiper('.modal-product-image-thumb', {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      });

      var modalGalleryTop = new Swiper('.modal-product-image-large', { 
        thumbs: {
          swiper: modalGalleryThumbs
        }
      });

    /********************************
     * Blog List Slider - Single Slide
     * *********************************/
    var blogListSLider = new Swiper('.blog-list-slider.swiper-container', {
        loop: true,
        speed: 1000,
        slidesPerView: 1,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

    });

    /********************************
     *  Product Gallery - Image Zoom
     **********************************/
    $('.zoom-image-hover').zoom();

    /************************************************
     * Animate on Scroll
     ***********************************************/
    AOS.init({
       
        duration: 1000, 
        once: true, 
        easing: 'ease',
    });
    window.addEventListener('load', AOS.refresh);    

    /************************************************
     * Video  Popup
     ***********************************************/
    $('.video-play-btn').venobox(); 

    /************************************************
     * Scroll Top
     ***********************************************/
    $('body').materialScrollTop();


    /************************************************
     * Acorddion Menu - Page Category
     ***********************************************/
    $('.accordion-item-header i').click(function() {
        var toggle = $(this).data('toggle');
        if (toggle == 'ul') {
            $(this).toggleClass('rotate-90');
            $(this).parent().next('ul').slideToggle();
        } else if (toggle == 'none') {

        }
    });
    

    /************************************************
    * QUANTITY OF PRODUCT TO BUY (input-number)
    ***********************************************/
    var stock_quantity = parseInt($('.product-variable-quantity input[type="number"]').attr('max'));

    $('.product-variable-quantity').on('click input', '.btn-minus, .btn-plus, input[type="number"]', function () {
        let input = $(this).siblings('input[type="number"]');
        let value = parseInt(input.val());

        if ($(this).hasClass('btn-minus')) {
            input.val(Math.max(value - 1, 1));
        } else if ($(this).hasClass('btn-plus')) {
            input.val(Math.min(value + 1, stock_quantity));
        } else if ($(this).is('input[type="number"]')) {
            input.val(Math.min(Math.max(value, 1), stock_quantity));
        }
    });

    $('.product-variable-quantity input[type="number"]').on('blur', function () {
        let value = parseInt($(this).val());

        if (isNaN(value) || value === '' || value === null) {
            $(this).val(1);
        } else if (value > stock_quantity) {
            $(this).val(stock_quantity);
        }
    });


    /************************************************
     * Add To Cart Modal
     ***********************************************/
    $('.addToCart').each(function () {
        $(this).on('click', function (e) {
            e.preventDefault();
            let id = $(this).attr("id");
            let amount = 1;
            let name = $(this).data("name");
            let price = parseFloat($(this).data("price"));
            
            if ($('#amount-product').length) {
                amount = parseInt($('#amount-product').val());
            }

            $.ajax({
                url: base_url + "index/addCartProduct/",
                dataType: 'JSON',
                method: 'POST',
                data: {
                    id_product: id,
                    amount_product: amount,
                },
                beforeSend: function() {
                    
                },
                success: function(data){
                    if (data.status) {
                        let product_added = data.product_added;

                        $(".addd-product-container").html(`
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="modal-add-cart-product-img">
                                                <img class="img-fluid"
                                                    src="${product_added.image}" alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="modal-add-cart-info"><i class="fa fa-check-square"></i>Añadido al carrito con éxito!</p>
                                            <p class="cart-name-product font-weight-bold c-p-deep-blue">${product_added.name.toUpperCase()}</p>
                                            <p> <strong>Precio: </strong> <span class="cart-price-product">$${numberFormat(parseFloat(product_added.price))}</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 modal-border">
                                    <ul class="modal-add-cart-product-shipping-info">
                                        <li> <strong><i class="icon-shopping-cart"></i> Tiene ${data.amountCart} productos en su carrito.</strong></li>
                                        <li>
                                            <div class="modal-add-cart-product-cart-buttons font-weight-bold">
                                                <a href="${base_url}carrito">Ver carrito</a>
                                                <a href="checkout.html">Procesar pago</a>
                                            </div>
                                        </li>
                                        <li class="modal-continue-button"><a href="#" data-bs-dismiss="modal">CONTINUAR COMPRANDO</a></li>
                                    </ul>
                                </div>
                            </div>
                            `);

                        $('.amount-product-cart').text(data.amountCart);
                        $("#container-shopping-cart").html(data.html_shoppingCart);
                    }else{
                        $(".addd-product-container").html(`<h1 class="text-center text-danger">${data.error}</h1>`);
                    }
                },
                error: function(xhr, status, error) {
                },
                complete: function() {
                    
                }
            });     
        })
    });


})(jQuery);

/*****************************
* Delete Item Shopping Cart
*****************************/
function delItemCart(element) {
    let option = $(element).attr("option");
    let id = $(element).attr("idpr");
    
    if (option == 1 || option == 2) {
        $.ajax({
            url: base_url + "index/delItemCart/",
            dataType: 'JSON',
            method: 'POST',
            data: {
                id_product: id,
                option: option,
            },
            beforeSend: function() {
                
            },
            success: function(data){
                if (data.status) {
                    $('.amount-product-cart').text(data.amountCart);
                    $("#container-shopping-cart").html(data.html_shoppingCart);
                }else{
                    Swal.fire({icon: 'error', html: `<span class="font-weight-bold">${data.error}</span>`, confirmButtonColor: '#4431DE'});
                }
            },
            error: function(xhr, status, error) {
                console.log(error)
            },
            complete: function() {
                
            }
        });   
    }
}