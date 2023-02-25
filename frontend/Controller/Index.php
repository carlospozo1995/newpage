<?php

	class Controller_Index{
		public function buildPage()
		{	
			$data["file_css"][] = "index-store";
			$data["file_js"][] = "index-store"; 
			View::renderPage('Index', $data);
		}
	}

?>