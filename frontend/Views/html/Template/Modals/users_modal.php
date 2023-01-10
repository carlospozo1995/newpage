    
<?php if (!empty($_SESSION['module']['crear'])) { ?>
    <div class="modal fade" id="modalFormUser">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header headerRegister">
                    <h4 class="modal-title">Nuevo Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">

                        <form id="formNewUser">
                            <input type="hidden" id="id_user" value="">

                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="dni_user">Identificación</label>
                                            <input type="text" class="form-control" placeholder="0123456789" id="dni_user">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name_user">Nombre</label>
                                            <input type="text" class="form-control valid valid_text" placeholder="Nombre" id="name_user">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="surname_user">Apellido</label>
                                            <input type="text" class="form-control valid valid_text" placeholder="Apellido" id="surname_user">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone_user">Teléfono</label>
                                            <input type="text" class="form-control valid valid_number" placeholder="Telefono o celular" id="phone_user">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email_user">Correo</label>
                                            <input type="text" class="form-control valid valid_email" placeholder="Correo" id="email_user">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name_rol">Rol del usuario</label>
                                            <select style="width:100%" class="form-control" id="list_rol">
                                            <?php 
                                                // if (!empty($_SESSION['module']['ver'])){
                                                    $html_options = "";
                                                    $arr_roles = Models_Users::selectRoles();
                                                    
                                                    if (count($arr_roles) > 0) {
                                                        for ($i=0; $i < count($arr_roles); $i++) { 
                                                            $html_options .= '<option value="'.Utils::encriptar($arr_roles[$i]['id_rol']).'">'.$arr_roles[$i]['name_rol'].'</option>' ;
                                                        }
                                                    }    

                                                    echo $html_options;
                                                // }
                                            ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="status">Status usuario</label>
                                            <select class="form-control" id="status_user">
                                                <option value="1">Activo</option>
                                                <option value="2">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label for="password">Contraseña</label>
                                            <div class="d-flex align-items-center">
                                                <input type="password" class="form-control contPass valid valid_password" placeholder="ejemplo123" id="pass_user">
                                                <span class="ml-1" role='button'><i class="fa-regular fa-eye-slash" onclick="showPass(this)"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button id="btnSubmitUser" type="submit" class="btn btn-primary btnText">Guardar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
<?php } ?>