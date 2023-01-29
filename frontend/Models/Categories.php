<?php

    class Models_Categories{

        static public function getCategories()
        {
            $sql = "SELECT table1.*, table2.name_category AS nameFather FROM categories table1 LEFT JOIN categories table2 ON table1.fatherCategory = table2.id_category WHERE table1.status != 0";
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
            $result = $GLOBALS["db"]->selectAll($sql, array());
            return $result;
        }

        static public function insertCategory($name, $photo, $icon, $sliderDst, $sliderMbl, $sliderDesOne, $sliderDesTwo, $option_list, $status)
        {
            $sql = "SELECT * FROM categories WHERE name_category = ? AND fatherCategory is null";
            $request = $GLOBALS["db"]->auto_array($sql, array($name));

            if (empty($request)) {
                $arrData[] = array("name_category" => $name, "photo" => $photo, "icon" => $icon, "sliderDst" => $sliderDst, "sliderMbl" => $sliderMbl, "sliderDesOne" => $sliderDesOne, "sliderDesTwo" => $sliderDesTwo, "fatherCategory" => $option_list, "status" => $status); 
                $result = $GLOBALS["db"]->insert_multiple("categories", $arrData);
            }else{
                $result = "exist";
            }
            return $result;
        }

        static public function selectCategory($data)
        {
            $sql = "SELECT table1.*, table2.name_category AS nameFather FROM categories table1 LEFT JOIN categories table2 ON table1.fatherCategory = table2.id_category WHERE table1.id_category = ?";
            return $GLOBALS["db"]->auto_array($sql, array($data));
        }

        static public function selectImages($colum_1, $colum_2, $data_1, $data_2)
        {
            $sql = "SELECT $colum_1, $colum_2 FROM categories WHERE $colum_1 = ? AND $colum_2 = ?";
            return $GLOBALS["db"]->auto_array($sql, array($data_1, $data_2)); 
        }


        static public function updateCategory($id, $name, $photo, $icon, $sliderDesOne, $sliderDesTwo, $option_list, $status)
        {
            $sql = "SELECT * FROM categories WHERE name_category = ? AND id_category != ? AND fatherCategory is null";
            $request = $GLOBALS["db"]->auto_array($sql, array($name, $id));
            
            if(empty($request)){
                $arrData = array("name_category" => $name, "photo" => $photo, "icon" => $icon, "sliderDesOne" => $sliderDesOne, "sliderDesTwo" => $sliderDesTwo, "fatherCategory" => $option_list, "status" => $status);
                $result = $GLOBALS["db"]->update("categories", $arrData, "id_category='".$id."'");

                if($result > 0){
                    $sons_id = array();
                    $recursive = self::recursiveData($id, $sons_id);
                    $implode_data = implode(",", $recursive);
                    $GLOBALS["db"]->update("categories", array("status" => $status), "id_category in(".$implode_data.")");                    
                }
            }else{
                $result = "exist";
            }

            return $result;
        }

        static public function recursiveData($father, &$arr_ids)
        {
            $sql = "SELECT id_category FROM categories WHERE fatherCategory = ?";
            $request = $GLOBALS["db"]->selectAll($sql, array($father));
            foreach ($request as $key => $value) {
                $id_data = $value['id_category'];
                $arr_ids[] = $id_data; 
                self::recursiveData($id_data, $arr_ids);
            }
            return $arr_ids;
        }
    }

?>