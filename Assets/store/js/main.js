
(function($) {
    "use strict";

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
        $('#search > form > input').focus();
    });

    $('#search, #search button.close').on('click', function(event) {
        if ( event.target.className == 'close' ) {
            $('body').css('overflow', 'auto');
            $(this).removeClass('open');
            $('#search form input').val("");
            $(".search-modal .search-data").addClass('d-none');
            $('.search-modal .search-content').css('top', '50%');
            $('.search-modal .search-data').css('top', '50%');
        }
    });

    $('#search form').on('submit', function (e) {
        e.preventDefault(e);
        let valInput = $('#search form input').val();

        if (valInput != "" && valInput.length > 1) {
            window.location.href = base_url + "resultado/"+ valInput;
        }
    });

    $("#search form input").on('keyup', function () {
        let value = $("#search form input").val();
        let suggestions = "";
        if (value.length > 1) {
            $(".search-modal .search-data").removeClass('d-none');
            $.ajax({
                url: base_url + "index/searchData/",
                dataType: 'JSON',
                method: 'POST',
                data: {
                    data_value: value 
                },
                beforeSend: function () {
                    $('.content-suggestions').html("");
                    $('.searched-product-content .content-products').html("");
                    $('.content-amount-products').html("");
                    $('.search-data .cont-load-search').css("display", "flex");
                },
                success: function (data) {
                    if (data.html != "") {
                        let amountText = data.amount < 6 ? 'Ver productos' : `Ver todos los ${data.amount} productos`;
                        data.suggestions.forEach(element => {

                            suggestions += '<li class="has-dropdown xtranslate-5 time-trans-txt"><a href="'+base_url+'resultado/'+element['name_category'].toLowerCase()+' '+element['brand'].toLowerCase()+'" class="link-store lh-lg">'+element['name_category']+' - '+element['brand']+'</a></li>';
                        });
                        $('.content-suggestions').html(suggestions);
                        $('.searched-product-content .content-products').html(data.html);
                        $('.content-amount-products').html(`
                            <div class="container fs-16 pt-4 text-center">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="${base_url}resultado/${value}">${amountText}</a>
                                    </div>
                                </div>
                            </div>
                        `);
                        
                        new Swiper('.swiper-container.product-default-slider-4grid-1row', {
                            slidesPerView: 3,
                            spaceBetween: 20,
                            speed: 1500,
                    
                            navigation: {
                                nextEl: '.search-product-slider-default-1row .swiper-button-next',
                                prevEl: '.search-product-slider-default-1row .swiper-button-prev',
                            },

                            centerInsufficientSlides: true,

                            breakpoints: {
                    
                                0: {
                                    slidesPerView: 1,
                                },
                                576: {
                                    slidesPerView: 1,
                                },
                                768: {
                                    slidesPerView: 2,
                                },
                                1400: {
                                    slidesPerView: 3,
                                },
                                1800: {
                                    slidesPerView: 4,
                                }
                            }
                        });

                        $('.search-modal .search-content').css('top', '30%');
                        $('.search-modal .search-data').css('top', '30%');

                    }else{
                        $('.searched-product-content .content-products').html('<p class="text-center pt-5">No se encontraron produtos con ese termino.</p>');
                        $('.content-suggestions').html('<p>No se encontraron sugerencias.</p>');
                        $('.search-modal .search-content').css('top', '50%');
                        $('.search-modal .search-data').css('top', '50%');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error)
                },
                complete: function() {
                    $('.search-data .cont-load-search').css("display", "none");
                }
            });
        }else{
            $(".search-modal .search-data").addClass('d-none');
            $('.search-modal .search-content').css('top', '50%');
            $('.search-modal .search-data').css('top', '50%');
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
     *   Product Slider Active - 5 Grid Single Rows
     **********************************************/
    var productSlider5grid1row = new Swiper('.product-default-slider-5grid-1row.swiper-container', {
        slidesPerView: 5,
        spaceBetween: 30,
        speed: 1500,

        navigation: {
            nextEl: '.new-products-slider-default-1row .swiper-button-next',
            prevEl: '.new-products-slider-default-1row .swiper-button-prev',
        },

        breakpoints: {

            0: {
                slidesPerView: 2,
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
            },
            1500: {
                slidesPerView: 5,
            }
        }
    });
    
    /*********************************************
     *   Product Slider Active - 4 Grid Single Rows
     **********************************************/
    
    $('.swiper-container.product-default-slider-4grid-1row').each(function() {
        let $this = $(this);
        let parent = $this.parent()[0].classList[0];
        new Swiper($this[0],{
            slidesPerView: 4,
            spaceBetween: 30,
            speed: 1500,

            navigation: {
                nextEl: '.'+parent+' .swiper-button-next',
                prevEl: '.'+parent+' .swiper-button-prev',
            },

            breakpoints: {

                0: {
                    slidesPerView: 2,
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
    

})(jQuery);

