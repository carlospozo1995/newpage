<?php if(!empty($_SESSION['module']['crear'])) { ?>
	<div class="modal fade" id="modalFormProduct" tabindex="1">
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
                                        
                    					<div class="form-group">
                                            <label>Título slider</label>
                                            <textarea class="form-control m-hgt-txarea" name="sliderDes" id="sliderDes"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Tags</label>
                                            <div class="u-tagsinput">
                                                <input type="text" data-role="tagsinput" name="tagsProduct" id="tagsProduct">
                                            </div>
                                        </div>
                    				</div>

                    				<div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="contImgUpload">
                                                <input type="hidden" class="image_actual" name="lgbannerP_actual" id="lgbannerP_actual" value="">
                                                <input type="hidden" class="image_remove" name="lgbannerP_remove" id="lgbannerP_remove" value="0">

                                                <label>Banner large (320X500)</label>

                                                <div>
                                                    <div class="prevImgUpload prev_lgbannerP">
                                                        <span class="delImgUpload notBlock del_lgbannerP">X</span>
                                                        <label for="lgbannerP"></label>
                                                        <div></div>
                                                    </div>
                                                    <div class="upimg">
                                                        <input type="file" name="lgbannerP" id="lgbannerP" class="imagen">
                                                    </div>
                                                    
                                                    <div class="alertImgUpload"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="contImgUpload">
                                                <input type="hidden" class="image_actual" name="wbanner_actual" id="wbanner_actual" value="">
                                                <input type="hidden" class="image_remove" name="wbanner_remove" id="wbanner_remove" value="0">

                                                <label>Banner width (960x540)</label>
                                               
                                                <div>
                                                    <div class="prevImgUpload prevWidthBanner">
                                                        <span class="delImgUpload notBlock delwbanner">X</span>
                                                        <label for="widthBanner"></label>
                                                        <div></div>
                                                    </div>
                                                    <div class="upimg">
                                                        <input type="file" name="widthBanner" id="widthBanner" class="imagen">
                                                    </div>
                                                    
                                                    <div class="alertImgUpload"></div>
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
                                            			echo '<option value="'.Utils::encriptar($category['id_category']).'">'.$category['name_category'].$father_name.' </option>';
                                            		}
                                            	?>
                                            </select>
                                        </div>

                                        <div class="form-group">
	                                        <label>Marca<span class="text-danger"> *</span></label>
	                                        <input type="text" class="form-control" id="brand" name="brand">
	                                    </div>

	                                    <div class="form-group">
	                                        <label>Código<span class="text-danger"> *</span></label>
	                                        <input type="text" class="form-control valid valid_number" id="code" name="code">
	                                    </div>

	                                    <div class="row">
	                                        <div class="col-sm-6">
	                                            <div class="form-group">
	                                                <label>Precio actual<span class="text-danger"> *</span></label>
	                                                <input type="text" class="form-control valid valid_price" id="price" name="price">
	                                            </div>
	                                        </div>
	                                        <div class="col-sm-6">
	                                            <div class="form-group">
	                                                <label>Stock</label>
	                                                <input type="text" class="form-control valid valid_number" id="stock" name="stock">
	                                            </div>
	                                        </div>
	                                    </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Precio anterior</label>
                                                    <input type="text" class="form-control valid valid_price" id="prev_price" name="prev_price">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Descuento</label>
                                                    <input type="text" class="form-control valid valid_number" id="discount" name="discount">
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="text-center font-weight-bold">Cuotas <span style="font-size: 15px;" class="font-weight-normal">(Llenar ambos campos)</span></h5>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Cantidad de cuotas</label>
                                                    <input type="text" class="form-control valid valid_number" id="cantDues" name="cantDues">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Precio de cuotas</label>
                                                    <input type="text" class="form-control valid valid_price" id="priceDues" name="priceDues">
                                                </div>
                                            </div>
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
	                                                <button id="btnSubmitProduct" type="submit" class="btn btn-primary btnText btn-block">Agregar</button>
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
	                                            <span><b>Agregar fotos</b> (600 x 690)</span>
	                                            <button class="btnAddImage btn btn-info btn-sm" type="button">
	                                                <i class="fa-solid fa-plus"></i> 
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

<?php if (!empty($_SESSION['module']['ver'])) { ?>
    <div class="modal fade" id="modalViewProduct">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header headerRegister">
                    <h4 class="modal-title">Datos del producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <table class="table table-bordered">
                            <tbody>
								<tr>
                                	<td>Código:</td>
                                    <td class="text-center" id="celCode"></td>
                                </tr>
                                <tr>
                                    <td>Nombre:</td>
                                    <td class="text-center" id="celName"></td>
                                </tr>
								<tr>
                                    <td>Marca:</td>
                                    <td class="text-center" id="celBrand"></td>
                                </tr>
								<tr>
                                    <td>Categoria:</td>
                                    <td class="text-center" id="celCategory"></td>
                                </tr>
								<tr>
                                    <td>Precio actual:</td>
                                    <td class="text-center" id="celPrice"></td>
                                </tr>
                                <tr>
                                    <td>Precio anterior:</td>
                                    <td class="text-center" id="celPricePrev"></td>
                                </tr>
                                <tr>
                                    <td>Descuento:</td>
                                    <td class="text-center" id="celDiscount"></td>
                                </tr>
								<tr>
                                    <td>Stock:</td>
                                    <td class="text-center" id="celStock"></td>
                                </tr>
								<tr>
                                    <td>Slider desktop:</td>
                                    <td class="text-center" id="celSlrDesktop"></td>
                                </tr>
                                <tr>
                                    <td>Slider Mobile:</td>
                                    <td class="text-center" id="celSlrMobile"></td>
                                </tr>
								<tr>
                                    <td>Descripción principal:</td>
                                    <td class="text-center" id="celDesMain"></td>
                                </tr>
                                <tr>
                                    <td>Descripción general:</td>
                                    <td id="celDesGeneral"></td>
                                </tr>
                                <tr>
                                    <td>Cantidad de cuotas:</td>
                                    <td class="text-center" id="celCantDues"></td>
                                </tr>
                                <tr>
                                    <td>Precio de la cuota:</td>
                                    <td class="text-center" id="celPriceDues"></td>
                                </tr>
								<tr>
                                    <td>Fotos del producto:</td>
                                    <td class="text-center" id="celPhoto"></td>
                                </tr>
                                <tr>
                                    <td>Fecha registro:</td>
                                    <td class="text-center" id="celDate_create"></td>
                                </tr>
                                <tr>
                                    <td>Estado:</td>
                                    <td class="text-center" id="celStatus"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
            </div>
        </div>
    </div>

<?php } ?>