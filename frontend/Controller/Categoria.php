<?php

	class Controller_Categoria{
		public function buildPage()
		{
			$data["file_css"][] = "store";
			$data["file_js"][] = "store"; 
			View::renderPage('Categoria', $data);
		}
	}

?>