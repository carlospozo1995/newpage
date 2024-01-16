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

					require URL_LOCAL . 'vendor/autoload.php';
					$search_value = $_GET['search'];
					$client = \Algolia\AlgoliaSearch\SearchClient::create(
						$_ENV['ALGOLIA_APP_ID'],
						$_ENV['ALGOLIA_ADMIN_API_KEY']
					);

					$index = $client->initIndex('index_products');

					$results = $index->search($search_value, [
						'hitsPerPage' => 10,
						'facets' => ["brand", "price"]
					]);

					$variable["file_js"][] = "resultado";
					$variable["search"] = $search_value;
					$variable["results"] = $results;
					
					View::renderPage('Resultado', $variable);	

				break;
			}
		}
		
	}

?>


