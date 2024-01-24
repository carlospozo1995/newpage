
<?php

	class Controller_Orden{
		public function buildPage()
		{	
			session_start();
		
			if (empty($_SESSION['idUser'])) {
				header('Location: '.BASE_URL.'Dashboard');
			}

            $id_order = Utils::desencriptar($_GET['order']);
            $dataOrder = Models_Pedidos::getOrder($id_order); 
            
            if (!empty($dataOrder)) {
                // Utils::dep($dataOrder);
                View::renderPage('Orden', $dataOrder);
            }else{
                header('Location: '.BASE_URL.'Dashboard');
            }
            
		}
	}

?>