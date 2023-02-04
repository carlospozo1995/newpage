<?php if(!empty($_SESSION['module']['crear'])) { ?>
	<div class="modal fade" id="modalFormProduct">
	    <div class="modal-dialog modal-xl">
	        <div class="modal-content">
	        	<div class="modal-header headerRegister">
	                <h4 class="modal-title">Nuevo Producto</h4>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">
                    <p>Los campos que contienen un (<span class="text-danger">*</span>) son obligatorios. Los demás dependerán de su decisión.</p>
                    <div class="card card-primary">

                    	<form id="formNewProduct">
                    		<input type="hidden" name="id_product" id="id_product" value="">

                    		<div class="card-body">
                    			<div class="row">
                    				
                    				<div class="col-sm-6">
                    					<div class="form-group">
	                                        <label>Nombre<span class="text-danger"> *</span></label>
	                                        <input type="text" class="form-control" placeholder="Nombre" id="name_product" name="name_product">
	                                    </div>

	                                    <div class="form-group">
	                                        <label>Descripción principal<span class="text-danger"> *</span></label>
	                                        <textarea class="form-control m-hgt-txarea" id="desMainProd" name="desMainProd" ></textarea>
	                                    </div>

	                                    <div class="form-group">
	                                        <label>Descripción general</label>
	                                        <textarea class="form-control" id="desGeneralProd" name="desGeneralProd"></textarea>
	                                    </div>

	                                    <div class="form-group">
                                            <div class="contImgUpload">
                                                <input type="hidden" class="image_actual" name="sliderMbl_actual" id="sliderMbl_actual" value="">
                                                <input type="hidden" class="image_remove" name="sliderMbl_remove" id="sliderMbl_remove" value="0">

                                                <label>Slider Mobile (800x500)</label>

                                                <div class="contSlider">
                                                    <div class="prevImgUpload prevSliderMbl">
                                                        <span class="delImgUpload notBlock delSliderMbl">X</span>
                                                        <label for="sliderMbl"></label>
                                                        <div></div>
                                                    </div>
                                                    <div class="upimg">
                                                        <input type="file" name="sliderMbl" id="sliderMbl" class="imagen">
                                                    </div>
                                                    <div class="alertImgUpload"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="contImgUpload">
                                                <input type="hidden" class="image_actual" name="sliderDst_actual" id="sliderDst_actual" value="">
                                                <input type="hidden" class="image_remove" name="sliderDst_remove" id="sliderDst_remove" value="0">

                                                <label>Slider Desktop (1920x850)</label>

                                                <div class="contSlider">
                                                    <div class="prevImgUpload prevSliderDst">
                                                        <span class="delImgUpload notBlock delSliderDst">X</span>
                                                        <label for="sliderDst"></label>
                                                        <div></div>
                                                    </div>
                                                    <div class="upimg">
                                                        <input type="file" name="sliderDst" id="sliderDst" class="imagen">
                                                    </div>
                                                    <div class="alertImgUpload"></div>
                                                </div>
                                            </div>
                                        </div>
                    				</div>

                    				<div class="col-sm-6">
                    					<div class="form-group">
                                            <label>Slider Descripción</label>
                                            <textarea class="form-control m-hgt-txarea" name="sliderDes" id="sliderDes"></textarea>
                                        </div>

                                        <div class="form-group">
	                                        <label>Marca<span class="text-danger"> *</span></label>
	                                        <input type="text" class="form-control" id="brand" name="brand">
	                                    </div>

	                                    <div class="form-group">
	                                        <label>Código<span class="text-danger"> *</span></label>
	                                        <input type="text" class="form-control" id="code" name="code">
	                                    </div>

	                                    <div class="row">
	                                        <div class="col-sm-6">
	                                            <div class="form-group">
	                                                <label>Precio<span class="text-danger"> *</span></label>
	                                                <input type="text" class="form-control" id="price" name="price">
	                                            </div>
	                                        </div>
	                                        <div class="col-sm-6">
	                                            <div class="form-group">
	                                                <label>Stock<span class="text-danger"> *</span></label>
	                                                <input type="text" class="form-control" id="stock" name="stock">
	                                            </div>
	                                        </div>
	                                    </div>

	                                    <div class="form-group">
                                            <label>Pertenece a:<span class="text-danger"> *</span></label>
                                            <select class="form-control" style="width: 100%;" name="listCategories" id="listCategories">
                                            	<?php
                                            	 	$categories_arr = Models_Products::getCategories();
                                            		foreach ($categories_arr as $category) {
                                            			!empty($category['fatherName']) ? $father_name = ' ('.$category['fatherName'].')' : $father_name = "";
                                            			echo '<option value="'.$category['id_category'].'">'.$category['name_category'].$father_name.' </option>';
                                            		}
                                            	?>
                                            </select>
                                        </div>

										<div class="form-group">
                                            <label for="listStatus">Status Producto<span class="text-danger"> *</span></label>
                                            <select class="form-control" name="listStatus" id="listStatus">
                                                <option value="1">Activo</option>
                                                <option value="2">Inactivo</option>
                                            </select>
                                        </div>

                                        <br>
                                        <div class="row">
	                                        <div class="col-sm-6">
	                                            <div class="form-group">
	                                                <button id="btnSubmitProduct" type="submit" class="btn btn-primary btn-block">Agregar</button>
	                                            </div>
	                                        </div>
	                                        <div class="col-sm-6">
	                                            <div class="form-group">
	                                                <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Cancelar</button>
	                                            </div>
	                                        </div>
	                                    </div>
                    				</div>

                    			</div>
                    		</div>

                    		<div class="card-footer">
	                            <div class="row">
	                                <div class="col-sm-12">
	                                    <div class="form-group">
	                                        <div class="containerGallery">
	                                            <span><b>Agregar fotos</b> (440 x 545)</span>
	                                            <button class="btnAddImage btn btn-info btn-sm" type="button">
	                                                <i class="fas fa-plus-circle"></i>
	                                            </button>

	                                        </div>
	                                        <hr>
	                                        <div id="containerImages">
	                                            <!-- IMAGENES DE PRODUCTOS POR JS -->
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
                    	</form>

					</div>
                </div>
	      </div>
	    </div>
	</div>
<?php } ?>