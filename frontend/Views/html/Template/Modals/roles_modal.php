
<div class="modal fade" id="modalFormRol">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header headerRegister-mc">
                <!-- <h1><?= $data['test']; ?></h1> -->
                <h4 class="modal-title">Nuevo Rol</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-primary">

                    <form id="formNewRol" name="formNewRol">
                        <input type="hidden" id="idRol" name="idRol" value="">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="txtNombre">Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre del rol" id="txtNombre" name="txtNombre">
                            </div>

                            <div class="form-group">
                                <label for="textDescripcion">Descripción</label>
                                <textarea class="form-control" rows="3" placeholder="Descripción del rol" id="txtDescripcion" name="txtDescripcion"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="listStatus">Status Rol</label>
                                <select class="form-control" id="listStatus" name="listStatus">
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

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