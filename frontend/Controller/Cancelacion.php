<?php
	class Controller_Cancelacion{
		
		public function buildPage()
		{	
			Utils::sessionStartStore();
			if (isset($_SESSION['paymentProcessData'])) {
				$orderData = $_SESSION['paymentProcessData'];

				$updateByCancellation = Utils::updateStockByCancelation($orderData['orderedProducts']);
				$uniqueCode = $orderData['uniqueCode'];
				$delCardTransaction = Models_Store::deleteData($uniqueCode);
				
				if ($updateByCancellation == false) {
					// enviar mensaje al administrador sobre los productos no actualizados si existe un error(enviando $orderData['orderedProducts'])
				}
				
				View::renderPage('Cancelacion');
				unset($_SESSION['paymentProcessData']);
			}else{
				header("Location: ".BASE_URL);
			}
		}
	}

?>