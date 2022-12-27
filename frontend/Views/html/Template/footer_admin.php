		<footer class="main-footer">
	    	<div class="float-right d-none d-sm-block">
	    		<b>Version</b> 3.2.0
	    	</div>
	    	<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
		</footer>
	</div>

<script> const base_url = "<?= BASE_URL; ?>"; </script>
<script src="<?= MEDIA_ADMIN ; ?>js/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= MEDIA_ADMIN ; ?>js/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= MEDIA_ADMIN ; ?>js/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= MEDIA_ADMIN ; ?>js/plugins/toastr/toastr.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= MEDIA_ADMIN ; ?>js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= MEDIA_ADMIN ; ?>css/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= MEDIA_ADMIN ; ?>css/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= MEDIA_ADMIN ; ?>css/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= MEDIA_ADMIN ; ?>css/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= MEDIA_ADMIN ; ?>css/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= MEDIA_ADMIN ; ?>js/plugins/jszip/jszip.min.js"></script>
<script src="<?= MEDIA_ADMIN ; ?>js/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= MEDIA_ADMIN ; ?>js/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= MEDIA_ADMIN ; ?>css/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= MEDIA_ADMIN ; ?>css/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= MEDIA_ADMIN ; ?>css/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?= MEDIA_ADMIN ; ?>js/plugins/bootstrap-switch/bootstrap-switch.min.js"></script>
<!-- Select2 -->
<script src="<?= MEDIA_ADMIN ; ?>js/plugins/select2/select2.min.js"></script>
<!-- Tinymce -->
<script src="<?= MEDIA_ADMIN ; ?>js/plugins/tinymce/tinymce.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= MEDIA_ADMIN ; ?>js/adminlte.min.js"></script>
<!-- My script -->
<script src="<?= MEDIA_ADMIN ; ?>js/global.js"></script>
<?php
    if(isset($file_js) && is_array($file_js) && !empty($file_js)){
        foreach ($file_js as $keyjs => $valuejs) {
            echo '<script src="'.MEDIA_ADMIN.'js/'.$valuejs.'.js"></script>';
        }
    }
?>