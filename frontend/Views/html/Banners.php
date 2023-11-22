
<div class="content-wrapper">
    
    <section class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
         		<div class="col-sm-6 d-flex">
            		<h1><?= strtoupper($section_name); ?></h1>
                </div>
          	</div>
        </div>
    </section>
    
    <section class="content">
      	<div class="container-fluid">
        	<div class="row">
          		<div class="col-12">
            		<div class="card">
              			<div class="card-body">
                            <div class="col-md-12">
                                <div class="tile">
                                    <h4 class="tile-title">Slider Main (categoria)</h4>
                                    <div class="tile-body">

                                    <?php
                                    $sliderMCtg = Models_Banners::searchData("categories", "sliderDst", "id_category, name_category");
                                    if (!empty($sliderMCtg)) {
                                    ?>
                                        <form class="row" id="formSliderMCtg">
                                            <input type="hidden" class="type-imageCtg" value="1">
                                            <div class="form-group col-md-3">
                                                <select class="form-control select_options" name="sliderMCtg" id="sliderMCtg">
                                    <?php
                                                foreach ($sliderMCtg as $key => $value) {
                                                    echo '<option value="'.Utils::encriptar($value['id_category']).'">'.$value['name_category'].'</option>';
                                                }
                                    ?>
                                                </select> 
                                            </div>
                                        
                                            <div class="form-group col-md-4 align-self-end">
                                                <button class="btn btn-primary" type="submit">Agregar</button>
                                            </div>
                                        </form>

                                        <table id="tableSliderMCtg" class="table_order table table-bordered table-striped table_data">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Imagen desktop</th>
                                                    <th>Imagen mobile</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $idsCtgSM = array_map(function($element) {
                                                    return $element['id_category'];
                                                }, $sliderMCtg);
                                                $concatIdsCTgSM = implode(', ', $idsCtgSM);
                                                Models_Banners::modifyTBanners($concatIdsCTgSM, 1);

                                                $dataSliderMCtg = Models_Banners::getBanners("banners_category", "id_banner, banner_name, sliderDst, sliderMbl", 1);
                                                $id_row = 1;

                                                foreach ($dataSliderMCtg as $key => $value) {
                                                    $btnDelete = '';
                                                    $id_banner = Utils::encriptar($value["id_banner"]);

                                                    if (!empty($_SESSION['module']['eliminar']) && $_SESSION['idUser'] == 1) {
                                                        $btnDelete = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteData(this, \''.$id_banner.'\', \'tableSliderMCtg\', 1)" tilte="Eliminar"><i class="fa-solid fa-trash"></i></button>';
                                                    }

                                                    echo'<tr id="'.$id_banner.'">';
                                                        echo '<td>'.$id_row.'</td>';
                                                        echo '<td>'.$value['banner_name'].'</td>';
                                                        echo '<td class="text-center">';
                                                            echo '<img style="width:60px" src="'.MEDIA_ADMIN.'files/images/uploads/'.$value['sliderDst'].'">';
                                                        echo '</td>';
                                                        echo '<td class="text-center">';
                                                            echo '<img style="width:40px" src="'.MEDIA_ADMIN.'files/images/uploads/'.$value['sliderMbl'].'">';
                                                        echo '</td>';
                                                        echo '<td><div class="text-center">'.$btnDelete.'</div></td>';
                                                    echo'</tr>';

                                                    $id_row++;
                                                } 
                                            ?> 
                                            </tbody>
                                        </table>
                                    <?php
                                    }else{
                                        echo "<p>Debe tener por lo menos 1 slider agregado en la seccion de categorias.</p>";
                                    }
                                    ?>

                                    </div>
                                </div>
                            </div>
                        </div>
	        		</div>
        		</div>
    		</div>
    	</div>
    </section>
    <br>

    <section class="content">
      	<div class="container-fluid">
        	<div class="row">
          		<div class="col-12">
            		<div class="card">
              			<div class="card-body">
                            <div class="col-md-12">
                                <div class="tile">
                                    <h4 class="tile-title">Banner Large (categoria)</h4>
                                    <div class="tile-body">
                                    <?php
                                    $bannerLCtg = Models_Banners::searchData("categories", "banner_large", "id_category, name_category");
                                    if (count($bannerLCtg) >= 4) {
                                    ?>
                                         <form class="row" id="formBannerLCtg">
                                            <input type="hidden" class="type-imageCtg" value="2">
                                            <div class="form-group col-md-3">
                                                <select class="form-control select_options" name="bannerLCtg" id="bannerLCtg">
                                    <?php
                                                foreach ($bannerLCtg as $key => $value) {
                                                    echo '<option value="'.Utils::encriptar($value['id_category']).'">'.$value['name_category'].'</option>';
                                                }
                                    ?>
                                                </select> 
                                            </div>
                                        
                                            <div class="form-group col-md-4 align-self-end">
                                                <button class="btn btn-primary" type="submit">Agregar</button>
                                            </div>
                                        </form>

                                        <table id="tableBannerLCtg" class="table_order table table-bordered table-striped table_data">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Imagen</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $idsCtgBL = array_map(function($element) {
                                                    return $element['id_category'];
                                                }, $bannerLCtg);
                                                $concatIdsCTgBL = implode(', ', $idsCtgBL);
                                                Models_Banners::modifyTBanners($concatIdsCTgBL, 2);

                                                $dataBannerLCtg = Models_Banners::getBanners("banners_category", "id_banner, banner_name, banner_large", 2);
                                                $id_row = 1;

                                                foreach ($dataBannerLCtg as $key => $value) {
                                                    $btnDelete = '';
                                                    $id_banner = Utils::encriptar($value["id_banner"]);

                                                    if (!empty($_SESSION['module']['eliminar']) && $_SESSION['idUser'] == 1) {
                                                        $btnDelete = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteData(this, \''.$id_banner.'\', \'tableBannerLCtg\', 2)" tilte="Eliminar"><i class="fa-solid fa-trash"></i></button>';
                                                    }

                                                    echo'<tr id="'.$id_banner.'">';
                                                        echo '<td>'.$id_row.'</td>';
                                                        echo '<td>'.$value['banner_name'].'</td>';
                                                        echo '<td class="text-center">';
                                                            echo '<img style="width:40px" src="'.MEDIA_ADMIN.'files/images/uploads/'.$value['banner_large'].'">';
                                                        echo '</td>';
                                                        echo '<td><div class="text-center">'.$btnDelete.'</div></td>';
                                                    echo'</tr>';

                                                    $id_row++;
                                                } 
                                            ?> 
                                            </tbody>
                                        </table>
                                    <?php
                                    }else{
                                        echo "<p>Debe tener por lo menos 4 banner large agregados en la seccion de categorias.</p>";
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
	        		</div>
        		</div>
    		</div>
    	</div>
    </section>
    <br>

    <section class="content">
      	<div class="container-fluid">
        	<div class="row">
          		<div class="col-12">
            		<div class="card">
              			<div class="card-body">
                            <div class="col-md-12">
                                <div class="tile">
                                    <h4 class="tile-title">Banner Small (categoria)</h4>
                                    <div class="tile-body">

                                    <?php
                                    $bannerSCtg = Models_Banners::searchData("categories", "photo", "id_category, name_category");
                                    if (count($bannerSCtg) >= 5) {
                                    ?>
                                        <form class="row" id="formBannerSCtg">
                                            <input type="hidden" class="type-imageCtg" value="3">
                                            <div class="form-group col-md-3">
                                                <select class="form-control select_options" name="bannerSCtg" id="bannerSCtg">
                                    <?php
                                                foreach ($bannerSCtg as $key => $value) {
                                                    echo '<option value="'.Utils::encriptar($value['id_category']).'">'.$value['name_category'].'</option>';
                                                }
                                    ?>
                                                </select> 
                                            </div>
                                        
                                            <div class="form-group col-md-4 align-self-end">
                                                <button class="btn btn-primary" type="submit">Agregar</button>
                                            </div>
                                        </form>

                                        <table id="tableBannerSCtg" class="table_order table table-bordered table-striped table_data">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Imagen</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $idsCtgBS = array_map(function($element) {
                                                    return $element['id_category'];
                                                }, $bannerSCtg);
                                                $concatIdsCTgBS = implode(', ', $idsCtgBS);
                                                Models_Banners::modifyTBanners($concatIdsCTgBS, 3);

                                                $dataBannerSCtg = Models_Banners::getBanners("banners_category", "id_banner, banner_name, banner_small", 3);
                                                $id_row = 1;

                                                foreach ($dataBannerSCtg as $key => $value) {
                                                    $btnDelete = '';
                                                    $id_banner = Utils::encriptar($value["id_banner"]);

                                                    if (!empty($_SESSION['module']['eliminar']) && $_SESSION['idUser'] == 1) {
                                                        $btnDelete = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteData(this, \''.$id_banner.'\', \'tableBannerSCtg\', 3)" tilte="Eliminar"><i class="fa-solid fa-trash"></i></button>';
                                                    }

                                                    echo'<tr id="'.$id_banner.'">';
                                                        echo '<td>'.$id_row.'</td>';
                                                        echo '<td>'.$value['banner_name'].'</td>';
                                                        echo '<td class="text-center">';
                                                            echo '<img style="width:60px" src="'.MEDIA_ADMIN.'files/images/uploads/'.$value['banner_small'].'">';
                                                        echo '</td>';
                                                        echo '<td><div class="text-center">'.$btnDelete.'</div></td>';
                                                    echo'</tr>';

                                                    $id_row++;
                                                } 
                                            ?>
                                            </tbody>
                                        </table>
                                    <?php
                                    }else{
                                        echo "<p>Debe tener por lo menos 5 banner small agregados en la seccion de categorias.</p>";
                                    }
                                    ?>

                                    </div>
                                </div>
                            </div>
                        </div>
	        		</div>
        		</div>
    		</div>
    	</div>
    </section>
    <br>

    <!-- --------------------------------------------------------------------------------------- -->
    <!-- --------------------------------------------------------------------------------------- -->
    <!-- --------------------------------------------------------------------------------------- -->
    <!-- --------------------------------------------------------------------------------------- -->
    <!-- --------------------------------------------------------------------------------------- -->

    <section class="content">
      	<div class="container-fluid">
        	<div class="row">
          		<div class="col-12">
            		<div class="card">
              			<div class="card-body">
                            <div class="col-md-12">
                                <div class="tile">
                                    <h4 class="tile-title">Slider Main (producto)</h4>
                                    <div class="tile-body">
                                        
                                    <?php
                                    $sliderMProd = Models_Banners::searchData("products", "sliderDst", "id_product, name_product");
                                    if (!empty($sliderMProd)) {
                                    ?>
                                        <form class="row" id="formSliderMProd">
                                            <input type="hidden" class="type-imageProd" value="1">
                                            <div class="form-group col-md-3">
                                                <select class="form-control select_options" name="sliderMProd" id="sliderMProd">
                                    <?php
                                                foreach ($sliderMProd as $key => $value) {
                                                    echo '<option value="'.Utils::encriptar($value['id_product']).'">'.$value['name_product'].'</option>';
                                                }
                                    ?>
                                                </select> 
                                            </div>
                                        
                                            <div class="form-group col-md-4 align-self-end">
                                                <button class="btn btn-primary" type="submit">Agregar</button>
                                            </div>
                                        </form>

                                        <table id="tableSliderMProd" class="table_order table table-bordered table-striped table_data">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Imagen desktop</th>
                                                    <th>Imagen mobile</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    <?php
                                    }else{
                                        echo "<p>Debe tener por lo menos 1 slider agregado en la seccion de productos.</p>";
                                    }
                                    ?>  

                                    </div>
                                </div>
                            </div>     
                        </div>
	        		</div>
        		</div>
    		</div>
    	</div>
    </section>
    <br>

</div>
