<?php					
	if (!empty($url_categories)) {

        $data_url = "";
        foreach ($url_categories as $url) {
            $data_url .= "'".$url."'" . ","; 
        }
        $data_url = rtrim($data_url, ",");
        $data_categories = Models_Store::getCategories($data_url);

        if (count($url_categories) != count($data_categories)) {
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
            $id_end = Models_Store::getCategory(end($url_categories));
            $sons = Models_Categories::dataSons(end($id_end));
            $id_sons = "";

            foreach ($sons as $data) {
                $id_sons .= Utils::desencriptar($data["id_son"]) . ",";
            }
            $id_sons = rtrim($id_sons, ",");
            $id_sons = !empty($id_sons) ? $id_sons : end($id_end);
            Utils::dep(Models_Store::getProducts("$id_sons"));
        }
        
    }else{
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
    }
?>