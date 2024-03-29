<?php if (!empty($_SESSION['module']['crear'])) { ?>
    <div class="modal fade" id="modalFormCategory">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header headerRegister">
                    <h4 class="modal-title">Nueva Categoria</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Los campos que contienen un (<span class="text-danger">*</span>) son obligatorios. Los demás dependerán de su decisión.</p>
                    <div class="card card-primary">

                        <form id="formNewCategory">
                            <input type="hidden" name="id_category" id="id_category" value="">

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name_category">Nombre<span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" placeholder="Nombre" name="name_category" id="name_category">
                                        </div>

                                        <div class="form-group">
                                            <label for="listCategories">Pertenece a:<span class="text-danger"> *</span></label>
                                            <select class="form-control" style="width: 100%;" name="listCategories" id="listCategories"></select>
                                        </div>

                                        <div class="form-group">
                                            <div class="contImgUpload">
                                                <input type="hidden" class="image_actual" name="icon_actual" id="icon_actual" value="">
                                                <input type="hidden" class="image_remove" name="icon_remove" id="icon_remove" value="0">

                                                <label>Icono (64x64)</label>
                                                <p class="text-info text-center errorImage"></p>

                                                <div class="contImage">
                                                    <div class="prevImgUpload prevIcon">
                                                        <span class="delImgUpload notBlock delIcon">X</span>
                                                        <label for="icon"></label>
                                                        <div></div>
                                                    </div>
                                                    <div class="upimg">
                                                        <input type="file" name="icon" id="icon" class="imagen">
                                                    </div>
                                                    <div class="alertImgUpload alertErrorImg"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="contImgUpload">
                                                <input type="hidden" class="image_actual" name="photo_actual" id="photo_actual" value="">
                                                <input type="hidden" class="image_remove" name="photo_remove" id="photo_remove" value="0">

                                                <label>Banner small (450x250)</label>
                                                <!-- <p class="text-info text-center errorImage"></p> -->

                                                <!-- <div class="contImage"> -->
                                                <div>
                                                    <div class="prevImgUpload prevPhoto">
                                                        <span class="delImgUpload notBlock delPhoto">X</span>
                                                        <label for="photo"></label>
                                                        <div></div>
                                                    </div>
                                                    <div class="upimg">
                                                        <input type="file" name="photo" id="photo" class="imagen">
                                                    </div>
                                                    <!-- <div class="alertImgUpload alertErrorImg"></div> -->
                                                    <div class="alertImgUpload"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- ---------------------- -->
                                        <div class="form-group">
                                            <div class="contImgUpload">
                                                <input type="hidden" class="image_actual" name="lgbanner_actual" id="lgbanner_actual" value="">
                                                <input type="hidden" class="image_remove" name="lgbanner_remove" id="lgbanner_remove" value="0">

                                                <label>Banner large (480x670)</label>

                                                <div>
                                                    <div class="prevImgUpload prev_lgbanner">
                                                        <span class="delImgUpload notBlock del_lgbanner">X</span>
                                                        <label for="lgbanner"></label>
                                                        <div></div>
                                                    </div>
                                                    <div class="upimg">
                                                        <input type="file" name="lgbanner" id="lgbanner" class="imagen">
                                                    </div>
                                                    
                                                    <div class="alertImgUpload"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ---------------------- -->
                                    </div>
                                    
                                    <div class="col-sm-6">
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
                                            <textarea class="form-control m-hgt-txarea" type="text" name="sliderDesOne" id="sliderDesOne"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Subtítulo slider</label>
                                            <textarea class="form-control m-hgt-txarea" name="sliderDesTwo" id="sliderDesTwo"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="listStatus">Status Categoria<span class="text-danger"> *</span></label>
                                            <select class="form-control" name="listStatus" id="listStatus">
                                                <option value="1">Activo</option>
                                                <option value="2">Inactivo</option>
                                            </select>
                                        </div>
                                   </div>

                                </div>                           
                            </div>

                            <div class="card-footer">
                                <button id="btnSubmitCategory" type="submit" class="btn btnText btn-primary">Guardar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>

                        </form>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
<?php } ?>

<?php if (!empty($_SESSION['module']['ver'])) { ?>
    <div class="modal fade" id="modalViewCategory">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header headerRegister">
                    <h4 class="modal-title">Datos de categoria</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Nombre:</td>
                                    <td class="text-center" id="celName"></td>
                                </tr>
                                <tr>
                                    <td>Imagen:</td>
                                    <td class="text-center" id="celImage"></td>
                                </tr>
                                <tr>
                                    <td>Icono:</td>
                                    <td class="text-center" id="celIcon"></td>
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
                                    <td>Título slider:</td>
                                    <td class="text-center" id="celDesSlrOne"></td>
                                </tr>
                                <tr>
                                    <td>Subtítulo slider:</td>
                                    <td class="text-center" id="celDesSlrTwo"></td>
                                </tr>
                                <tr>
                                    <td>Pertenece a:</td>
                                    <td class="text-center" id="celCtgFather"></td>
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