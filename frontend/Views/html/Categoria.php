<?php
    $cat_path = explode("/", $_GET['cat_path']);
    list($data1, $data2, $data3) = array_pad(array_map(function($x) { return "$x"; }, $cat_path), 3, "");

    $data_categories = Models_Store::getCategories($data1, $data2, $data3);
    
    if(count($cat_path) != count($data_categories)){
?>
    
    <div class="error-section">
        <div class="container">
            <div class="row">
                <div class="error-form">
                    <div style="margin-top: 50px; margin-bottom: 50px;" data-aos="fade-up" data-aos-delay="0">
                        <img style="width: 100%" src="<?= MEDIA_STORE; ?>images/not-product.png">
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php        
    }else{
        $end_path_id = Models_Store::getIdCategory(end($cat_path));
        $sons_end_path = Models_Categories::dataSons(end($end_path_id));
        $id_sons = "";

        foreach ($sons_end_path as $data) {
            $id_sons .= Utils::desencriptar($data["id_son"]).",";
        }
        $id_sons = rtrim($id_sons, ",");

        $id_sons = !empty($id_sons) ? $id_sons : end($end_path_id);
        $products = Models_Store::getProducts($id_sons, "", "", "", 0, 10);
        $total_products = Models_Store::getProducts($id_sons, "", "", "");
        
        if (!empty($products)) {

            // PRICE MIN AND PRICE MAX COLUMN
            $price_column = array_column($total_products, 'price');
            $price_min = intval(min($price_column));
            $price_max = intval(max($price_column));

            // STORAGE OF PRODUCT IMAGES
            $product_images = array();
            foreach ($products as $product) {
                $img_product = Models_Products::selectImages($product['id_product']);
                if (!empty($img_product)) {
                    $r_indexes = array_rand($img_product, 2);
                    foreach ($r_indexes as $index) {
                        $r_element = $img_product[$index];
                        $product_images[$product['id_product']][] = '<img class="img-fluid" src="'.MEDIA_ADMIN.'files/images/upload_products/'.$r_element['image'].'" alt="">';
                    }
                }else{
                    $product_images[$product['id_product']][] = '<img class="img-fluid" src="'.MEDIA_ADMIN.'files/images/upload_products/empty_img.png" alt="">';
                }
            }
            // ----------------------
?>
            <div class="breadcrumb-section" data-aos="fade-up" data-aos-delay="0">
                <div class="pt-4 pb-4 mb-4 bg-mist-white">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="breadcrumb-nav breadcrumb-nav-color--black">
                                    <nav aria-label="breadcrumb">
                                        <ul class="navigation-page">
                                            <?php
                                                echo '<li><a href="'.BASE_URL.'">HOME</a></li>';
                                                foreach ($cat_path as $key => $value) {
                                                    if ($key == count($cat_path)-1) {
                                                        echo '<li class="active">'.strtoupper(str_replace("-", " ", $value)).'</li>';
                                                    }else{
                                                        $url_page = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                                        $pos = strpos($url_page, $value);
                                                        if ($pos !== false) {
                                                            $href_data = substr($url_page, 0, $pos + strlen($value));
                                                        }
                                                        echo '<li><a href="'.$href_data.'">'.strtoupper(str_replace("-", " ", $value)).'</a></li>';
                                                    }
                                                }
                                            ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="shop-section">
                <div class="container">
                    <input type="hidden" id="data-store" value="<?= Utils::encryptStore($id_sons); ?>">
                    <div class="row flex-column-reverse flex-lg-row">
                        <div class="col-lg-3">

                            <!-- START SIDEBAR AREA -->
                            <div class="siderbar-section" data-aos="fade-up" data-aos-delay="0">

                                <div class="sidebar-single-widget">
                                    <h6 class="sidebar-title">CATEGORIAS</h6>

                                    <div class="sidebar-content">
                                        <?php
                                        $arrCategories = Models_Categories::arrCategories("");

                                        $categoriesFather = [];
                                        foreach ($arrCategories as $category) {
                                            $father = $category['fatherCategory'];
                                            $categoriesFather[$father][] = $category;
                                        }

                                        if (!empty($categoriesFather[""])) {
                                            echo '<ul class="sidebar-menu">';
                                                foreach ($categoriesFather[""] as $category) {
                                                    echo '<li class="accordion-item">';
                                                        echo '<div class="accordion-item-header">';
                                                            echo '<a href="'.BASE_URL.'categoria/'.$category['url'].'" class="category-url" data-category="'.$category['url'].'">'.$category["name_category"].'</a>';
                                                            echo '<i class="ion-ios-arrow-right" data-toggle="ul"></i>';
                                                        echo '</div>';
                                                        if(!empty($categoriesFather[$category['id_category']])){
                                                            echo '<ul class="accordion-category-list">';
                                                            foreach ($categoriesFather[$category['id_category']] as $subcategory) {
                                                                echo '<li class="accordion-item">';
                                                                    echo '<div class="accordion-item-header pr-3">';
                                                                        echo '<a href="'.BASE_URL.'categoria/'.$category['url']."/".$subcategory['url'].'" class="category-url" data-category="'.$subcategory['url'].'">'.$subcategory['name_category'].'</a>';
                                                                        if (!empty($categoriesFather[$subcategory['id_category']])) {
                                                                            echo '<i class="ion-ios-arrow-right" data-toggle="ul"></i>';
                                                                        }
                                                                    echo '</div>';
                                                                    if (!empty($categoriesFather[$subcategory['id_category']])) {
                                                                        echo '<ul class="accordion-category-list">';
                                                                        foreach ($categoriesFather[$subcategory['id_category']] as $key => $son) {
                                                                            echo '<li class="accordion-item">';
                                                                                echo '<a class="font-weight-normal category-url" href="'.BASE_URL.'categoria/'.$category['url']."/".$subcategory['url']."/".$son['url'].'" data-category="'.$son['url'].'">'.$son['name_category'].'</a>';
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
                                    </div>
                                </div>

                                <div class="sidebar-single-widget">
                                    <h6 class="sidebar-title">FILTER BY PRICE</h6>
                                    <div class="sidebar-content position-relative">
                                        <div class="cont-load-more"><span class="loader-more-data"></span></div>
                                        <div id="slider-range" data-min="<?= $price_min; ?>" data-max="<?= $price_max; ?>"></div>
                                        <div class="filter-type-price">
                                            <label for="amount">Price range:</label>
                                            <input type="text" id="amount">
                                        </div>
                                    </div>
                                </div> 

                                <div class="sidebar-single-widget">
                                    <h6 class="sidebar-title">Marca</h6>
                                    <div class="sidebar-content position-relative">
                                        <div class="cont-load-more"><span class="loader-more-data"></span></div>
                                        <div class="filter-type-select">
                                        <?php
                                        echo '<ul class="content-check-brand">';
                                            $countBrand = array();
                                            foreach ($total_products as $product) {
                                                if(isset($countBrand[$product['brand']])){
                                                    $countBrand[$product['brand']]++;
                                                }else{
                                                    $countBrand[$product['brand']] = 1;
                                                }
                                            }

                                            foreach ($countBrand as $brand => $amount) {
                                        ?>
                                                <li>
                                                    <label class="checkbox-default" for="<?= strtolower($brand); ?>">
                                                        <input type="checkbox" id="<?= strtolower($brand);?>">
                                                        <span><?= $brand." "."(".($amount).")"; ?></span>
                                                    </label>
                                                </li>
                                        <?php
                                                }
                                        echo '</ul>';
                                        ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- END SIDEBAR AREA -->

                        </div>

                        <div class="col-lg-9 position-relative pb-16">
                            <div class="content-loading">
                                <span class="loader-store"></span>
                            </div>

                            <div class="shop-sort-section">
                                <div class="container">
                                    <div class="row">
                                        <!-- Start Sort Wrapper Box -->
                                        <div class="sort-box d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column"
                                            data-aos="fade-up" data-aos-delay="0">
                                            <!-- Start Sort tab Button -->
                                            <div class="sort-tablist d-flex align-items-center">
                                                <ul class="tablist nav sort-tab-btn">
                                                    <li><a class="nav-link active" data-bs-toggle="tab"
                                                            href="#layout-3-grid"><img src="<?= MEDIA_ADMIN; ?>files/images/bkg_grid.png"
                                                                alt=""></a></li>
                                                    <li><a class="nav-link" data-bs-toggle="tab" href="#layout-list"><img
                                                                src="<?= MEDIA_ADMIN; ?>files/images/bkg_list.png" alt=""></a></li>
                                                </ul>

                                                <!-- Start Page Amount -->
                                                <div class="page-amount ml-2">
                                                    <span><?= count($total_products); ?> Productos</span>
                                                </div> <!-- End Page Amount -->
                                            </div> <!-- End Sort tab Button -->

                                            <!-- Start Sort Select Option -->
                                            <div class="sort-select-list d-flex align-items-center">
                                                <label class="mr-2">Ordenar por:</label>
                                                <form action="#">
                                                    <fieldset>
                                                        <select name="products-order" id="products-order">
                                                            <option value="default">Por defecto</option>
                                                            <option value="discount">Descuentos</option>
                                                            <option value="recent">Recien agregados</option>
                                                            <option value="price_asc">Precio: menor a mayor</option>
                                                            <option value="price_desc">Precio: mayor a menor</option>
                                                        </select>
                                                    </fieldset>
                                                </form>
                                            </div> <!-- End Sort Select Option -->
                                        </div> <!-- Start Sort Wrapper Box -->
                                    </div>
                                </div>
                            </div>

                            <!-- START SECTION PRODUCTS -->
                            <div class="sort-product-tab-wrapper">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="tab-content tab-animate-zoom">
                                                <!-- Start grid view products -->
                                                <div class="tab-pane active show sort-layout-single" id="layout-3-grid">
                                                    <div class="row" id="container-products-grid">
                                                    <?php
                                                    foreach ($products as $product) {
                                                    ?>
                                                        <div class="col-xl-3 col-sm-6 col-sm-4 col-adaptive">
                                                            <div class="product-default-single-item" data-aos="fade-up" data-aos-delay="0">
                                                                <div class="image-box">
                                                                <?php

                                                                echo '<a href="'.BASE_URL."producto/".$product["url"].'" class="image-link' . (!empty($product['discount']) ? ' content-off" data-discount="'.$product['discount'].'% off"' : '"') . '>';
                                                                    // PRINT IMAGES OF PRODUCTS
                                                                    echo implode('', $product_images[$product['id_product']]);

                                                                echo '</a>';

                                                                ?>
                                                                    <div class="action-link">
                                                                        <div class="action-link-right mx-auto">
                                                                            <a href="" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="icon-eye" title="Vista rápida"></i></a>
                                                                            <a href=""><i class="icon-heart" title="Añadir a favoritos"></i></a>
                                                                            <?php
                                                                            if (!empty($product['stock'])) {
                                                                                echo '<a href="" class="addToCart" id="'.Utils::encriptar($product['id_product']).'"><i class="icon-basket" title="Añadir al carrito"></i></a>';
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="content">
                                                                    <div class="text-center">
                                                                        <h6><a class="title-product" href="<?= BASE_URL.'producto/'.$product['url']; ?>"><?= $product['name_product']; ?></a></h6>
                                                                        <p><?= $product['brand']; ?></p>

                                                                    <?php

                                                                    if (!empty($product['cantDues'])) {
                                                                    echo '<div class="content-data-product no-empty">'; 
                                                                        echo '<div class="price-product no-empty">';
                                                                    }else{
                                                                    echo '<div class="content-data-product empty">'; 
                                                                        echo '<div class="price-product empty">';
                                                                    }
                                                                            echo (!empty($product['prevPrice'])) ? '<del>'.SMONEY. Utils::formatMoney($product['prevPrice']).'</del>' : '';
                                                                            echo '<span>'.SMONEY.Utils::formatMoney($product['price']).'</span>';
                                                                        echo '</div>';

                                                                        echo (!empty($product['cantDues'])) ? '<span class="ml-2 text-left">'.$product['cantDues'].' cuotas '.SMONEY. Utils::formatMoney($product['priceDues']).'</span>' : '';
                                                                    echo '</div>';

                                                                    ?>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    </div>
                                                </div>
                                                <!-- End grid view products -->

                                                <!-- Start list view products -->
                                                <div class="tab-pane sort-layout-single" id="layout-list">
                                                    <div class="row" id="container-products-single">
                                                    <?php
                                                    foreach ($products as $product) {
                                                    ?>
                                                        <div class="col-12">
                                                            <div class="product-list-single">
                                                            <?php
                                                            echo '<a href="'.BASE_URL."producto/".$product["url"].'" class="product-list-img-link' . (!empty($product['discount']) ? ' content-off" data-discount="'.$product['discount'].'% off"' : '"') . '>';
                                                                // PRINT IMAGES OF PRODUCTS
                                                                echo implode('', $product_images[$product['id_product']]);
                                                            echo '</a>';
                                                            ?>
                                                                <div class="product-list-content">
                                                                    <h5 class="product-list-link">
                                                                        <a href="<?= BASE_URL.'producto/'.$product['url']; ?>"><?=  $product['name_product']; ?></a>
                                                                    </h5>
                                                                    <p><?= $product['brand']; ?></p>
                                                                <?php

                                                                if (!empty($product['cantDues'])) {
                                                                echo '<div class="content-data-product no-empty single-list">'; 
                                                                    echo '<div class="price-product no-empty">';
                                                                }else{
                                                                echo '<div class="content-data-product empty">'; 
                                                                    echo '<div class="price-product empty">';
                                                                }
                                                                        echo (!empty($product['prevPrice'])) ? '<del>'.SMONEY. Utils::formatMoney($product['prevPrice']).'</del>' : '';
                                                                        echo '<span>'.SMONEY.Utils::formatMoney($product['price']).'</span>';
                                                                    echo '</div>';

                                                                    echo (!empty($product['cantDues'])) ? '<span class="ml-2 text-left">'.$product['cantDues'].' cuotas '.SMONEY. Utils::formatMoney($product['priceDues']).'</span>' : '';
                                                                echo '</div>';

                                                                ?>
                                                                    <p class="mt-3 text-justify"><?=  $product['desMain']; ?></p>

                                                                    <?php echo (empty($product['stock'])) ? '<p class="n-stock">No disponible</p>' : ''; ?>

                                                                    <div class="product-action-icon-link-list">
                                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview" class="btn btn-lg btn-black-default-hover" title="Vista rápida">
                                                                            <i class="icon-eye" ></i>
                                                                        </a>
                                                                        <a href="wishlist.html" class="btn btn-lg btn-black-default-hover" title="Añadir a favoritos">
                                                                            <i class="icon-heart"></i>
                                                                        </a>
                                                                        <?php
                                                                        if (!empty($product['stock'])) {
                                                                            echo '<a href="compare.html" class="btn btn-lg btn-black-default-hover addToCart" id="'.Utils::encriptar($product['id_product']).'" title="Añadir al carrito">
                                                                                    <i class="icon-basket"></i>
                                                                                </a>';
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    </div>
                                                </div>
                                                <!-- End list view products -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END SECTION PRODUCTS -->

                            <!-- START PAGINACTION -->
                            <?php
                                echo '<div class="container-pagination-btn">';
                                if (count($total_products) > 10) {
                                    echo '<div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                                            <button id="load-more" class="load-more time-trans-txt  position-relative">VER MÁS <div class="cont-load-more"><span class="loader-more-data"></span></div></button>
                                         </div>';
                                }
                                echo '</div>';
                            ?>
                            <!-- END PAGINATION -->
                        </div>
                    </div>
                </div>
            </div>
<?php
        }else{
?>
            <div class="error-section">
                <div class="container">
                    <div class="row">
                        <div class="error-form">
                            <div style="margin-top: 50px; margin-bottom: 50px" data-aos="fade-up" data-aos-delay="0">
                                <img style="width: 100%" src="<?= MEDIA_STORE; ?>images/not-product.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    }
?>