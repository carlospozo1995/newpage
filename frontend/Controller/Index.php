<?php

	class Controller_Index{
		public function buildPage()
		{
			$data["file_css"][] = "store";
			$data["file_js"][] = "store"; 
			View::renderPage('Index', $data);
		}
	}

?>