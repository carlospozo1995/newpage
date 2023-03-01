<?php

    class Models_Categories{

        static public function getCategories()
        {
            $sql = "SELECT table1.*, table2.name_category AS nameFather FROM categories table1 LEFT JOIN categories table2 ON table1.fatherCategory = table2.id_category WHERE table1.status != ?";
            $result = $GLOBALS["db"]->selectAll($sql, array(0));
            return $result;  
        }

        static public function arrCategories($data)
        {
            $params = " status = 1";

            if(!empty($data)){
                $params = " status != 0 AND id_category != $data";
            }
            
            $sql = "SELECT * FROM categories WHERE $params";
            return $GLOBALS["db"]->selectAll($sql, array());
        }

        static public function insertCategory($name, $photo, $icon, $sliderDst, $sliderMbl, $sliderDesOne, $sliderDesTwo, $option_list, $status)
        {
            $urlVowel = Utils::replaceVowel(utf8_decode($name));
            $sql = "SELECT * FROM categories WHERE name_category = ? AND fatherCategory is null";
            $request = $GLOBALS["db"]->auto_array($sql, array($name));

            if (empty($request)) {
                $arrData[] = array("name_category" => $name, "photo" => $photo, "icon" => $icon, "sliderDst" => $sliderDst, "sliderMbl" => $sliderMbl, "sliderDesOne" => $sliderDesOne, "sliderDesTwo" => $sliderDesTwo, "fatherCategory" => $option_list, "url" => strtolower(str_replace(" ", "-", $urlVowel)), "status" => $status); 
                return $GLOBALS["db"]->insert_multiple("categories", $arrData);
            }else{
                return "exist";
            }
        }

        static public function selectCategory($data)
        {
            $sql = "SELECT table1.*, DATE_FORMAT(table1.datecreate, '%d-%m-%Y') AS date_create, table2.name_category AS nameFather FROM categories table1 LEFT JOIN categories table2 ON table1.fatherCategory = table2.id_category WHERE table1.id_category = ?";
            return $GLOBALS["db"]->auto_array($sql, array($data));
        }

        static public function selectImages($table, $colum_1, $colum_2, $data_1, $data_2)
        {
            $sql = "SELECT $colum_1, $colum_2 FROM $table WHERE $colum_1 = ? AND $colum_2 = ?";
            return $GLOBALS["db"]->auto_array($sql, array($data_1, $data_2)); 
        }

        static public function updateCategory($id, $name, $photo, $icon, $sliderDst, $sliderMbl, $sliderDesOne, $sliderDesTwo, $option_list, $status)
        {
            $sql = "SELECT * FROM categories WHERE name_category = ? AND id_category != ? AND fatherCategory is null";
            $request = $GLOBALS["db"]->auto_array($sql, array($name, $id));
            
            if(empty($request)){
                $urlVowel = Utils::replaceVowel(utf8_decode($name));
                $arrData = array("name_category" => $name, "photo" => $photo, "icon" => $icon, "sliderDst" => $sliderDst, "sliderMbl" => $sliderMbl, "sliderDesOne" => $sliderDesOne, "sliderDesTwo" => $sliderDesTwo, "fatherCategory" => $option_list, "url" => strtolower(str_replace(" ", "-", $urlVowel)), "status" => $status);
                $result = $GLOBALS["db"]->update("categories", $arrData, "id_category='".$id."'");

                if($result > 0){
                    $id_categories = "";
                    foreach (self::dataSons($id) as $item) {
                        $id_categories .= Utils::desencriptar($item['id_son']) . ',';
                    }
                    $id_categories = rtrim($id_categories, ',');
                    $GLOBALS["db"]->update("categories", array("status" => $status), "id_category in(".$id_categories.")");                    
                }
            }else{
                $result = "exist";
            }
            return $result;
        }

        static public function dataSons($father) {
            $arr_data = array();
            $sql = "SELECT id_category, fatherCategory, name_category, status FROM categories where status != 0";
            $all_categories = $GLOBALS["db"]->selectAll($sql, array());
            $categories = [];
            foreach ($all_categories as $category) {
                $categories[$category['id_category']] = $category;
            }
            $queue = [$father];
            while (!empty($queue)) {
                $current_father = array_shift($queue);
                $current_father_name = $categories[$current_father]['name_category'];
                foreach ($categories as $category) {
                    if ($category['fatherCategory'] == $current_father) {
                        $data = [
                            'id_son' => Utils::encriptar($category['id_category']),
                            'father_name' => $current_father_name,
                            'status_son' => $category['status']
                        ];
                        array_push($arr_data, $data);
                        array_push($queue, $category['id_category']);
                    }
                }
            }
            return $arr_data;
        }

        static public function deleteCategory($data)
        {
            if (empty($data)) {return false;}
            
            $sonsCategory = self::dataSons($data);

            if(!empty($sonsCategory)){
                $result = "exist_ctg";
            }else{
                $sql = "SELECT * FROM products WHERE category_id = ? AND status != ?";
                $request_prod = $GLOBALS["db"]->selectAll($sql, array($data, 0));
            
                if (!empty($request_prod)) {
                    $result = "exist_prod";
                }else{
                    $status['status'] = 0;
                    $GLOBALS["db"]->update("categories", $status, "id_category='".$data."'");
                    $result = "ok";
                }
            }

            return $result;
        }
      
    }

?>