<?php

$dataSearch = $_GET['search'];
print_r($dataSearch);
// $products = Models_Resultado::testSearch($dataSearch);
// Utils::dep($products);
$products = Models_Resultado::searchProducts($dataSearch, "", "", "", 0, 10);
Utils::dep($products);

?>

    <div class="shop-section">
        <div class="container">
            <!-- <input type="hidden" id="data-store" value="<?= Utils::encryptStore($id_sons); ?>"> -->
            <div class="row flex-column-reverse flex-lg-row">
                <div class="col-lg-2-1">
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
                                <!-- <div id="slider-range" data-min="<?= $price_min; ?>" data-max="<?= $price_max; ?>"></div> -->
                                <div class="filter-type-price">
                                    <label for="amount">Price range:</label>
                                    <input type="text" id="amount" disabled>
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
                                    // foreach ($amount_brands as $item) {
                                ?>      
                                        <!-- <li>
                                            <label class="checkbox-default" for="<?= strtolower($item['brand']); ?>">
                                                <input type="checkbox" id="<?= strtolower($item['brand']);?>">
                                                <span><?= $item['brand']." "."(".($item['amount']).")"; ?></span>
                                            </label>
                                        </li> -->
                                <?php
                                    // }
                                echo '</ul>';
                                ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>