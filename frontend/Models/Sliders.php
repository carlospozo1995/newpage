<?php

	class Models_Sliders{

		static public function sliderCategory($data)
		{
			$request = "";

			if ($data != "") {
				$sql = "SELECT sliderDst, sliderMbl, sliderDesOne, sliderDesTwo FROM categories WHERE status = 1 AND sliderDst != '' AND sliderMbl != '' AND name_category IN (".$data.")";
				$request = $GLOBALS["db"]->selectAll($sql, array());;
				if (count($request) > 0) {
				 	for ($i=0; $i < count($request); $i++) { 
				 		// $request[$i]['imgCategoria'] = BASE_URL.'Assets/images/uploads/'.$request[$i]['imgCategoria'];
				 		$request[$i]['sliderDst'] = MEDIA_ADMIN.'files/images/uploads/'.$request[$i]['sliderDst'];
				 		$request[$i]['sliderMbl'] = MEDIA_ADMIN.'files/images/uploads/'.$request[$i]['sliderMbl'];
				 	}
				} 
			}
			return $request;
		}

		static public function sliderProduct($data)
		{
			$request = "";

			if ($data != "") {
				$sql = "SELECT sliderDst, sliderMbl, sliderDes FROM products WHERE status = 1 AND sliderDst != '' AND name_product IN (".$data.")";
				$request = $GLOBALS["db"]->selectAll($sql, array());;
				if (count($request) > 0) {
				 	for ($i=0; $i < count($request); $i++) { 
				 		$request[$i]['sliderDst'] = MEDIA_ADMIN.'files/images/upload_products/'.$request[$i]['sliderDst'];
				 		$request[$i]['sliderMbl'] = MEDIA_ADMIN.'files/images/upload_products/'.$request[$i]['sliderMbl'];
				 	}
				} 
			}
			return $request;
		}

	}

?>
