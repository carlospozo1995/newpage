<?php 
  headerPage($data);
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php
    dep($_SESSION['permisosMod']);
      if (empty($_SESSION['permisosMod']['ver'])) {
    ?>
    <h2 class="text-center">Lo sentimos no tiene permiso a esta sección</h2>
    <?php 
      }else{ 
        getModal("modalUsuarios", $data);?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 add-new-mc">
            <h1><?= $data['page_name'] ?></h1>
            <?php if (!empty($_SESSION['permisosMod']['crear'])) {
            ?>
            <button type="button" class="btn btn-primary" id="btnNewUser" onclick="modalNewUser()"><i class="fas fa-plus-circle"></i> Nuevo</button>
            <?php
            } ?>
            
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
                <table id="tableUsuarios" class="table_order table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                    <!-- <th>Acciones</th> -->
                  </tr>
                  </thead>
                  <tbody>
                    <!-- CALL DATABASE USUARIOS WITH JS -->
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
    <?php } ?>
  </div>
  <!-- /.content-wrapper -->

<?php footerPage($data); ?>