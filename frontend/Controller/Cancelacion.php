<?php
	class Controller_Cancelacion{
		
		public function buildPage()
		{	
			Utils::sessionStartStore();
			// if (isset($_SESSION['productsIdsArr'], $_SESSION['productsAmountArr'], $_SESSION['productsIds']) ) {
			// 	Models_Store::updatStockByCancellation($_SESSION['productsIdsArr'], $_SESSION['productsAmountArr'], $_SESSION['productsIds']);
				View::renderPage('Cancelacion');
			// 	unset($_SESSION['productsIdsArr'], $_SESSION['productsAmountArr'], $_SESSION['productsIds']);
			// }else{
			// 	header("Location: ".BASE_URL);
			// }
		}
	}

?>