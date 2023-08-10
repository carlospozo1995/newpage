<?php
	class Controller_Pago{
		
		public function buildPage()
		{	
			Utils::sessionStartStore();

			$action = Utils::getParam("action", "");
			switch ($action) {
				case ' ':
					return false;
				break;

				default:
					$url_payment = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

					$queryString = parse_url($url_payment, PHP_URL_QUERY);
					parse_str($queryString, $params);

					$transaction = $params['id'];
					$client = $params['clientTransactionId'];
					if(isset($_SESSION['login']) && isset($transaction) && isset($client)){
						$data_array = array(
						"id"=> (int)$transaction,
						"clientTxId"=>$client );
						
						View::renderPage('Pago', $data_array);
					}else{
						header("Location: ".BASE_URL);
					}
				break;
			}

		}
	}

?>