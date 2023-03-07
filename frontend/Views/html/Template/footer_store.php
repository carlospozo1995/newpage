    
    <!-- material-scrolltop button -->
    <button class="material-scrolltop" type="button"><i class="fa fa-chevron-up text-light"></i></button>
    
    <script> const base_url = "<?= BASE_URL; ?>"; </script>
    <script src="<?= MEDIA_STORE; ?>js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/vendor/jquery-3.5.1.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/vendor/popper.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/vendor/bootstrap.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/vendor/jquery-ui.min.js"></script>

    <script src="<?= MEDIA_STORE; ?>js/plugins/swiper-bundle.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/material-scrolltop.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/jquery.nice-select.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/jquery.zoom.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/venobox.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/jquery.waypoints.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/jquery.lineProgressbar.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/aos.min.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/jquery.instagramFeed.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/plugins/ajax-mail.js"></script>

    <script src="<?= MEDIA_STORE; ?>js/main.js"></script>
    <script src="<?= MEDIA_STORE; ?>js/store-functions.js"></script>

    <?php
    if(isset($file_js) && is_array($file_js) && !empty($file_js)){
        foreach ($file_js as $keyjs => $valuejs) {
            echo '<script src="'.MEDIA_STORE.'js/'.$valuejs.'.js"></script>';
        }
    }
?>
</body>
</html>