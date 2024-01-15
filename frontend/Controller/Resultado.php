<?php

	class Controller_Resultado{
		
		public function buildPage()
		{	
			Utils::sessionStartStore();
			
			$data = array();
			$action = Utils::getParam("action", "");
			switch ($action) {
				case ' ':
                    return false;
                break;
				default:
					
					View::renderPage('Resultado');	

				break;
			}
		}
		
	}

?>


