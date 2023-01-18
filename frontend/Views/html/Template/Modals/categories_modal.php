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
                    <div class="card card-primary">

                        <form id="formNewCategory">
                            <input type="hidden" id="id_category" value="">

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name_category">Nombre</label>
                                            <input type="text" class="form-control" placeholder="Nombre" name="name_category" id="name_category">
                                        </div>

                                        <div class="form-group">
                                            <label for="listCategories">Pertenece a:</label>
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

                                                <label>Imagen categoria (150x150)</label>
                                                <p class="text-info text-center errorImage"></p>

                                                <div class="contImage">
                                                    <div class="prevImgUpload prevPhoto">
                                                        <span class="delImgUpload notBlock delPhoto">X</span>
                                                        <label for="photo"></label>
                                                        <div></div>
                                                    </div>
                                                    <div class="upimg">
                                                        <input type="file" name="photo" id="photo" class="imagen">
                                                    </div>
                                                    <div class="alertImgUpload alertErrorImg"></div>
                                                </div>
                                            </div>
                                        </div>
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
                                                <input type="hidden" class="image_actual" name="" id="sliderDst_actual" value="">
                                                <input type="hidden" class="image_remove" name="" id="sliderDst_remove" value="0">

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
                                            <label>Slider Descripción 1</label>
                                            <textarea class="form-control m-hgt-txarea" type="text" name="sliderDscOne" id="sliderDscOne"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Slider Descripción 2</label>
                                            <textarea class="form-control m-hgt-txarea" name="sliderDscTwo" id="sliderDscTwo"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="listStatus">Status Categoria</label>
                                            <select class="form-control" name="listStatus" id="listStatus">
                                                <option value="1">Activo</option>
                                                <option value="2">Inactivo</option>
                                            </select>
                                        </div>
                                   </div>

                                </div>                           
                            </div>

                            <div class="card-footer">
                                <button id="btnSubmitCategory" type="submit" class="btn btn-primary btnText">Guardar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>

                        </form>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
<?php } ?>

<!-- <?php //if (!empty($_SESSION['module']['ver'])) { ?> -->
    <!-- <div class="modal fade" id="modalViewUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header headerRegister">
                    <h4 class="modal-title">Datos del usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Identificación:</td>
                                    <td id="celDni"></td>
                                </tr>
                                <tr>
                                    <td>Nombres:</td>
                                    <td id="celName"></td>
                                </tr>
                                <tr>
                                    <td>Apellidos:</td>
                                    <td id="celSurname"></td>
                                </tr>
                                <tr>
                                    <td>Teléfono:</td>
                                    <td id="celPhone"></td>
                                </tr>
                                <tr>
                                    <td>Email(Usuario):</td>
                                    <td id="celEmail"></td>
                                </tr>
                                <tr>
                                    <td>Tipo Usuario:</td>
                                    <td id="celName_rol"></td>
                                </tr>
                                <tr>
                                    <td>Estado:</td>
                                    <td id="celStatus"></td>
                                </tr>
                                <tr>
                                    <td>Fecha registro:</td>
                                    <td id="celDate_create"></td>
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
    </div> -->

<!-- <?php //} ?> -->