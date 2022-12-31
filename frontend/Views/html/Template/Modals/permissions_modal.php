<div class="modal fade modalPermisos" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Permisos - Roles de Usuario  - <?= $data_modal['rol']['name_rol'] ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="form_permissions">
                    <input type="hidden" id="id_rol" name="id_rol" value="<?= Utils::encriptar($data_modal['idRol']); ?>">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Módulo</th>
                                    <th class="text-center">Ver</th>
                                    <th class="text-center">Crear</th>
                                    <th class="text-center">Actualizar</th>
                                    <th class="text-center">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                
                                    $no = 1;
                                    $modules = $data_modal['modules'];
                                    for ($i=0; $i < count($modules); $i++) { 
                                        $permissions = $modules[$i]['permissions'];
                                        $verCheck = $permissions['ver'] == 1 ? " checked " : "";
                                        $crearCheck = $permissions['crear'] == 1 ? " checked " : "";
                                        $actualizarCheck = $permissions['actualizar'] == 1 ? " checked " : "";
                                        $eliminarCheck = $permissions['eliminar'] == 1 ? " checked " : "";

                                        $id_module = $modules[$i]['id_module'];
                                
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <?= $no; ?>
                                        <input type="hidden" name="arr_modules[<?= $i; ?>][id_module]" value="<?= Utils::encriptar($id_module) ?>">
                                    </td>
                                    <td class="text-center"><?= $modules[$i]['name_module']; ?></td>
                                    <td class="text-center">
                                        <input type="checkbox" data-bootstrap-switch data-off-color="secondary" name="arr_modules[<?= $i; ?>][ver]"  <?= $verCheck ?> data-on-color="success">
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" data-bootstrap-switch data-off-color="secondary" name="arr_modules[<?= $i; ?>][crear]"  <?= $crearCheck ?> data-on-color="success">
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" data-bootstrap-switch data-off-color="secondary" name="arr_modules[<?= $i; ?>][actualizar]"  <?= $actualizarCheck ?> data-on-color="success">
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" data-bootstrap-switch data-off-color="secondary" name="arr_modules[<?= $i; ?>][eliminar]"  <?= $eliminarCheck ?> data-on-color="success">
                                    </td>
                                </tr>
                                <?php
                                    $no++;
                                    // CIERRE DEL CICLO FOR
                                    }

                                ?>

                            </tbody>
                        </table>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-success" type="submit"><i class="fas fa-check-circle"></i> Guardar</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>