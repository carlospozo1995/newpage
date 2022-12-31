<div class="modal fade" id="modalFormRol">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h4 class="modal-title">Nuevo Rol</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-primary">

                    <form id="formNewRol">
                        <input type="hidden" id="idRol" name="idRol" value="">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name_rol">Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre del rol" id="name_rol" name="name_rol">
                            </div>

                            <div class="form-group">
                                <label for="descrip_rol">Descripción</label>
                                <textarea class="form-control" rows="3" placeholder="Descripción del rol" id="descrip_rol" name="descrip_rol"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="rol_status">Status Rol</label>
                                <select class="form-control" id="rol_status" name="rol_status">
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button id="btnSubmitRol" type="submit" class="btn btn-primary btnText">Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                    
                </div>
            </div>
            
        </div>
    </div>
</div>