<?php
	class Controller_Pago{
		
		public function buildPage()
		{	
			Utils::sessionStartStore();
			View::renderPage('Pago');
		}
	}

?>