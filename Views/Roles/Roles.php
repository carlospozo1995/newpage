<?php 
  headerPage($data); 
  getModal("modalRoles", $data);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php dep($_SESSION['permisosMod']);?>
    <!-- CONTAINER MODAL PERMISOS -->
    <div id="contentModalPermisos"></div>
    <!-- ------------------------ -->
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 add-new-mc">
            <h1><?= $data['page_name'] ?></h1>
            <?php if(!empty($_SESSION['permisosMod']['crear'])){ ?>
            <button type="button" class="btn btn-primary" onclick="modalNewRol();"><i class="fas fa-plus-circle"></i> Nuevo</button>
            <?php } ?>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tableRoles" class="table_order table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                    <!-- <th>Acciones</th> -->
                  </tr>
                  </thead>
                  <tbody>
                    <!-- CALL DATABASE ROLES WITH JS -->
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php footerPage($data); ?>