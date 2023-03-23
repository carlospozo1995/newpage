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
                    <div style="margin-top: 50px;" data-aos="fade-up" data-aos-delay="0">
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
        $products = Models_Store::getProducts($id_sons, 0, 10);
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

                                            foreach ($cat_path as $key => $value) {
                                                if ($key == count($cat_path)-1) {
                                                    echo '<li class="active">'.strtoupper(str_replace("-", " ", $value)).'</li>';
                                                }else{
                                                    echo '<li><a href="">'.strtoupper(str_replace("-", " ", $value)).'</a></li>';
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
<?php
    }
?>