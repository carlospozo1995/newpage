<?php

	class Controller_Test{
		public function buildPage()
		{
			$data["file_css"][] = "store";
			$data["file_js"][] = "store"; 
			View::renderPage('Test', $data);
		}
	}

?>