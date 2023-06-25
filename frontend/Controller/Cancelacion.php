<?php
	class Controller_Cancelacion{
		
		public function buildPage()
		{	
			Utils::sessionStartStore();
			View::renderPage('Cancelacion');
		}
	}

?>