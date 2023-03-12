
<?php                   
        $url_data = explode("/", $_GET['urlData']);
        $data_url = "";
        foreach ($url_data as $url) {
            $data_url .= "'".$url."'" . ","; 
        }
        $data_url = rtrim($data_url, ",");
        $data_categories = Models_Store::getCategories($data_url);

        if (count($url_data) != count($data_categories)) {
?>
            <div class="error-section">
                <div class="container">
                    <div class="row">
                        <div class="error-form">
                            <h1 class="big-title" data-aos="fade-up" data-aos-delay="0">404</h1>
                            <h4 class="sub-title" data-aos="fade-up" data-aos-delay="200">Opps! PAGE NOT BE FOUND</h4>
                            <p data-aos="fade-up" data-aos-delay="400">Sorry but the page you are looking for does not exist,
                                have been<br> removed, name changed or is temporarily unavailable.</p>
                            <div class="row">
                                <div class="col-10 offset-1 col-md-4 offset-md-4">
                                    <div class="default-search-style d-flex" data-aos="fade-up" data-aos-delay="600">
                                        <input class="default-search-style-input-box" type="search" placeholder="Search..."
                                            required>
                                        <button class="default-search-style-input-btn" type="submit"><i
                                                class="fa fa-search"></i></button>
                                    </div>
                                    <a href="<?= BASE_URL; ?>" class="btn btn-md btn-black-default-hover mt-7" data-aos="fade-up"
                                        data-aos-delay="800">Back to home page</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }else{
            $id_end = Models_Store::getCategory(end($url_data));
            $sons = Models_Categories::dataSons(end($id_end));
            $id_sons = "";

            foreach ($sons as $data) {
                $id_sons .= Utils::desencriptar($data["id_son"]) . ",";
            }
            $id_sons = rtrim($id_sons, ",");
            $id_sons = !empty($id_sons) ? $id_sons : end($id_end);
            $products = Models_Store::getProducts("$id_sons");
?>
            <div class="breadcrumb-section">
                <div class="pt-4 pb-4 mb-4 bg-mist-white">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                                    <nav aria-label="breadcrumb">
                                        <ul>
                                            <?php 
                                                echo '<li><a href="'.BASE_URL.'">HOME</a></li>';
                                                echo '<li class="active page-active" aria-current="page">'.strtoupper(str_replace("-", " ", end($url_data))).'</li>';
                                            ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ...:::: Start Shop Section:::... -->

            <div class="shop-section">
                <div class="container">
                    <div class="row flex-column-reverse flex-lg-row">
                        <div class="col-lg-3">
                            <!-- Start Sidebar Area -->
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

                                <!-- Start Single Sidebar Widget -->
                                <div class="sidebar-single-widget">
                                    <h6 class="sidebar-title">FILTER BY PRICE</h6>
                                    <div class="sidebar-content">
                                        <div id="slider-range"></div>
                                        <div class="filter-type-price">
                                            <label for="amount">Price range:</label>
                                            <input type="text" id="amount">
                                        </div>
                                    </div>
                                </div> <!-- End Single Sidebar Widget -->

                                <!-- Start Single Sidebar Widget -->
                                <div class="sidebar-single-widget">
                                    <h6 class="sidebar-title">MANUFACTURER</h6>
                                    <div class="sidebar-content">
                                        <div class="filter-type-select">
                                            <ul>
                                                <li>
                                                    <label class="checkbox-default" for="brakeParts">
                                                        <input type="checkbox" id="brakeParts">
                                                        <span>Brake Parts(6)</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="checkbox-default" for="accessories">
                                                        <input type="checkbox" id="accessories">
                                                        <span>Accessories (10)</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="checkbox-default" for="EngineParts">
                                                        <input type="checkbox" id="EngineParts">
                                                        <span>Engine Parts (4)</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="checkbox-default" for="hermes">
                                                        <input type="checkbox" id="hermes">
                                                        <span>hermes (10)</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="checkbox-default" for="tommyHilfiger">
                                                        <input type="checkbox" id="tommyHilfiger">
                                                        <span>Tommy Hilfiger(7)</span>
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> <!-- End Single Sidebar Widget -->

                                <!-- Start Single Sidebar Widget -->
                                <div class="sidebar-single-widget">
                                    <h6 class="sidebar-title">SELECT BY COLOR</h6>
                                    <div class="sidebar-content">
                                        <div class="filter-type-select">
                                            <ul>
                                                <li>
                                                    <label class="checkbox-default" for="black">
                                                        <input type="checkbox" id="black">
                                                        <span>Black (6)</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="checkbox-default" for="blue">
                                                        <input type="checkbox" id="blue">
                                                        <span>Blue (8)</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="checkbox-default" for="brown">
                                                        <input type="checkbox" id="brown">
                                                        <span>Brown (10)</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="checkbox-default" for="Green">
                                                        <input type="checkbox" id="Green">
                                                        <span>Green (6)</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="checkbox-default" for="pink">
                                                        <input type="checkbox" id="pink">
                                                        <span>Pink (4)</span>
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> <!-- End Single Sidebar Widget -->

                                <!-- Start Single Sidebar Widget -->
                                <div class="sidebar-single-widget">
                                    <h6 class="sidebar-title">Tag products</h6>
                                    <div class="sidebar-content">
                                        <div class="tag-link">
                                            <a href="#">asian</a>
                                            <a href="#">brown</a>
                                            <a href="#">euro</a>
                                            <a href="#">fashion</a>
                                            <a href="#">hat</a>
                                            <a href="#">t-shirt</a>
                                            <a href="#">teen</a>
                                            <a href="#">travel</a>
                                            <a href="#">white</a>
                                        </div>
                                    </div>
                                </div> <!-- End Single Sidebar Widget -->

                                <!-- Start Single Sidebar Widget -->
                                <div class="sidebar-single-widget">
                                    <div class="sidebar-content">
                                        <a href="product-details-default.html" class="sidebar-banner img-hover-zoom">
                                            <img class="img-fluid" src="assets/images/banner/side-banner.jpg" alt="">
                                        </a>
                                    </div>
                                </div> <!-- End Single Sidebar Widget -->

                            </div> <!-- End Sidebar Area -->
                        </div>
                        <div class="col-lg-9">
                            <!-- Start Shop Product Sorting Section -->
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
                                                    <span>Showing 1–9 of 21 results</span>
                                                </div> <!-- End Page Amount -->
                                            </div> <!-- End Sort tab Button -->

                                            <!-- Start Sort Select Option -->
                                            <div class="sort-select-list d-flex align-items-center">
                                                <label class="mr-2">Sort By:</label>
                                                <form action="#">
                                                    <fieldset>
                                                        <select name="speed" id="speed">
                                                            <option>Sort by average rating</option>
                                                            <option>Sort by popularity</option>
                                                            <option selected="selected">Sort by newness</option>
                                                            <option>Sort by price: low to high</option>
                                                            <option>Sort by price: high to low</option>
                                                            <option>Product Name: Z</option>
                                                        </select>
                                                    </fieldset>
                                                </form>
                                            </div> <!-- End Sort Select Option -->



                                        </div> <!-- Start Sort Wrapper Box -->
                                    </div>
                                </div>
                            </div> <!-- End Section Content -->

                            <!-- Start Tab Wrapper -->
                            <div class="sort-product-tab-wrapper">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 position-relative">
                                            <div class="content-loading">
                                                <span class="loader-store"></span>
                                            </div>

                                            <div class="tab-content tab-animate-zoom">
                                                <!-- Start Grid View Product -->
                                                <div class="tab-pane active show sort-layout-single" id="layout-3-grid">
                                                    <div class="row" id="container-products-grid">
                                                        <?php 

                                                        foreach ($products as $product) {
                                                        ?>
                                                            <div class="col-xl-3 col-sm-6 col-sm-4 col-12">
                                                                <!-- Start Product Default Single Item -->
                                                                <div class="product-default-single-item product-color--golden"
                                                                    data-aos="fade-up" data-aos-delay="0">
                                                                    <div class="image-box">
                                                                        <a href="product-details-default.html" class="image-link<?php if(!empty($product['discount'])){echo ' content-off" data-discount="'.$product['discount'].'% off"';}else{echo '"';} ?>>
                                                                            <?php
                                                                            $img_product = Models_Products::selectImages($product['id_product']);
                                                                            if (!empty($img_product)) {
                                                                                $r_indexes = array_rand($img_product, 2);
                                                                                foreach ($r_indexes as $index) {
                                                                                    $r_element = $img_product[$index];
                                                                                    echo '<img src="'.MEDIA_ADMIN.'files/images/upload_products/'.$r_element['image'].'" alt="">';
                                                                                }
                                                                            }else{
                                                                                echo '<img src="'.MEDIA_ADMIN.'files/images/upload_products/empty_img.png" alt="">';
                                                                            }  
                                                                            ?>
                                                                        </a>
                                                                        <div class="action-link">
                                                                            <div class="action-link-left">
                                                                                <a href="#" data-bs-toggle="modal"
                                                                                    data-bs-target="#modalAddcart">Add to Cart</a>
                                                                            </div>
                                                                            <div class="action-link-right">
                                                                                <a href="#" data-bs-toggle="modal"
                                                                                    data-bs-target="#modalQuickview"><i
                                                                                        class="icon-magnifier"></i></a>
                                                                                <a href="wishlist.html"><i
                                                                                        class="icon-heart"></i></a>
                                                                                <a href="compare.html"><i
                                                                                        class="icon-shuffle"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="content">
                                                                        <div class="text-center">
                                                                            <h6><a class="title-product" href="#"><?= $product['name_product']; ?></a></h6>
                                                                            <p><?= $product['brand']; ?></p>
                                                                            
                                                                        <?php if (!empty($product['cantDues'])){
                                                                            echo '<div class="content-data-product no-empty">'; echo '<div class="price-product no-empty">';
                                                                        }else{ echo '<div class="content-data-product empty">'; echo '<div class="price-product empty">'; }?>
                                                                                <?php if(!empty($product['prevPrice'])){ echo '<del>'.SMONEY ." ". Utils::formatMoney($product['prevPrice']).'</del>'; }?>
                                                                                    <span class=""><?= SMONEY ." ". Utils::formatMoney($product['price']) ;?></span>
                                                                                </div>
                                                                                <?php if (!empty($product['cantDues'])){ ?>
                                                                                    <span class="ml-2"><?= $product['cantDues']; ?> cuotas <?= SMONEY ." ". Utils::formatMoney($product['priceDues']);?></span>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- End Product Default Single Item -->
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        
                                                    </div>
                                                </div> <!-- End Grid View Product -->
                                                <!-- Start List View Product -->
                                                <div class="tab-pane sort-layout-single" id="layout-list">
                                                    <div class="row">
                                                        <?php foreach ($products as $product) { ?>
                                                            <div class="col-12">
                                                                <!-- Start Product Defautlt Single -->
                                                                <div class="product-list-single product-color--golden">
                                                                    <a href="product-details-default.html" class="product-list-img-link">
                                                                        <?php
                                                                        $img_product = Models_Products::selectImages($product['id_product']);
                                                                        if (!empty($img_product)) {
                                                                            $r_indexes = array_rand($img_product, 2);
                                                                            foreach ($r_indexes as $index) {
                                                                                $r_element = $img_product[$index];
                                                                                echo '<img class="img-fluid" src="'.MEDIA_ADMIN.'files/images/upload_products/'.$r_element['image'].'" alt="">';
                                                                            }
                                                                        }else{
                                                                            echo '<img class="img-fluid" src="'.MEDIA_ADMIN.'files/images/upload_products/empty_img.png" alt="">';
                                                                        }  
                                                                        ?>
                                                                    </a>
                                                                    <div class="product-list-content">
                                                                        <h5 class="product-list-link">
                                                                            <a href="product-details-default.html"><?=  $product['name_product']; ?></a>
                                                                        </h5>
                                                                        <ul class="review-star">
                                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                                            <li class="empty"><i class="ion-android-star"></i></li>
                                                                        </ul>
                                                                        <span class="product-list-price"><del>$30.12</del><?= SMONEY." ".Utils::formatMoney($product['price']); ?></span>
                                                                        <p><?=  $product['desMain']; ?></p>
                                                                        <div class="product-action-icon-link-list">
                                                                            <a href="#" data-bs-toggle="modal"
                                                                                data-bs-target="#modalAddcart"
                                                                                class="btn btn-lg btn-black-default-hover">Add to
                                                                                cart</a>
                                                                            <a href="#" data-bs-toggle="modal"
                                                                                data-bs-target="#modalQuickview"
                                                                                class="btn btn-lg btn-black-default-hover"><i
                                                                                    class="icon-magnifier"></i></a>
                                                                            <a href="wishlist.html"
                                                                                class="btn btn-lg btn-black-default-hover"><i
                                                                                    class="icon-heart"></i></a>
                                                                            <a href="compare.html"
                                                                                class="btn btn-lg btn-black-default-hover"><i
                                                                                    class="icon-shuffle"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div> <!-- End Product Defautlt Single -->
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div> <!-- End List View Product -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End Tab Wrapper -->

                            <!-- Start Pagination -->
                            <div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                                <ul>
                                    <li><a class="active" href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#"><i class="ion-ios-skipforward"></i></a></li>
                                </ul>
                            </div> <!-- End Pagination -->
                        </div>
                    </div>
                </div>
            </div> <!-- ...:::: End Shop Section:::... -->
<?php
        }
?>
