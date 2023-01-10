

	<div class="content-wrapper">
		
	    <section class="content-header">
		    
		    <div class="container-fluid">
		        <div class="row mb-2">
			        <div class="col-sm-6">
			            <h1><?= $section_name; ?></h1>
			        </div>
		        </div>
		    </div>

	    </section>

	    <section class="content">
	    	<?php 
				Utils::dep($_SESSION['data_user']); 
				Utils::dep($_SESSION['permissions']);
			?>
	    </section>

	</div>