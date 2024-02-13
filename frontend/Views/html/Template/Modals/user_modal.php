<div class="modal fade" id="modalEditUser">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold text-primary">Editar Perfil</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" id="formEditUser">
                    <div class="form-group row">
                        <label for="dniUser" class="col-sm-2 col-form-label">Identificación</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="dniUser">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nameUser" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control valid valid_text" id="nameUser">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="surnameUser" class="col-sm-2 col-form-label">Apellido</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control valid valid_text" id="surnameUser">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phoneUser" class="col-sm-2 col-form-label">Teléfono</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control valid valid_phone" id="phoneUser">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="mr-auto ml-auto mt-2">
                            <button type="submit" class="btn btn-sm btn-primary">GUARDAR CAMBIOS</button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>