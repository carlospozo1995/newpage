<?php

    class Models_Products{

        static public function getCategories()
        {
            $sql = "SELECT table1.*, table2.name_category AS fatherName FROM categories table1 LEFT JOIN categories table2 ON table1.fatherCategory = table2.id_category where table1.id_category not in (select table3.fatherCategory from categories table3 where table3.fatherCategory is not null AND table3.status = 1 ORDER BY table3.name_category ASC) AND table1.status = 1 ORDER BY table1.name_category ASC";
            return $GLOBALS["db"]->selectAll($sql, array(0));
        }

        static public function getProducts()
        {
            $sql = "SELECT * FROM products WHERE status != ?";
            return $GLOBALS["db"]->selectAll($sql, array(0));
        }

        static public function insertProduct($name, $desMain, $desGeneral, $sliderDst, $sliderMbl, $sliderDes, $option_list, $brand, $code, $price, $stock, $status)
        {
            $sql = "SELECT * FROM products WHERE code = ?";
            $request = $GLOBALS["db"]->auto_array($sql, array($code));

            if (empty($request)) {
                $arrData[] = array("category_id" => $option_list, "code" => $code, "name_product" => $name, "desMain" => $desMain, "desGeneral" => $desGeneral, "sliderMbl" => $sliderMbl, "sliderDst" => $sliderDst, "sliderDes" => $sliderDes, "brand" => $brand, "price" => $price , "stock" => $stock, "status" => $status); 
                return $GLOBALS["db"]->insert_multiple("products", $arrData);
            }else{
                return "exist";
            }
        }

        static public function selectProduct($data)
        {
            $sql = "SELECT  table_p.*, DATE_FORMAT(table_p.datacreate, '%d-%m-%Y') AS date_create, table_c.name_category AS category FROM products table_p INNER JOIN categories table_c ON table_p.category_id = table_c.id_category WHERE table_p.id_product = ?";
            return $GLOBALS["db"]->auto_array($sql, array($data));
        }

        static public function insertImage($arrData)
        {
            if(empty($arrData) || !is_array($arrData)){return false;}
            return $GLOBALS["db"]->insert_multiple("img_product", $arrData);
        }

        static public function selectImages($data)
        {
            $sql = "SELECT * FROM img_product WHERE product_id = ?";
            return $GLOBALS["db"]->selectAll($sql, array($data));
        }

        static public function deleteImage($id, $img_name)
        {   
            return $GLOBALS["db"]->delete("img_product", "product_id = '$id' AND image = '$img_name'");
        }

        static public function updateProduct($id, $name, $desMain, $desGeneral, $sliderDst, $sliderMbl, $sliderDes, $option_list, $brand, $code, $price, $stock, $status)
        {
            $sql = "SELECT * FROM products WHERE code = ? AND id_product != $id";
            $request = $GLOBALS["db"]->auto_array($sql, array($code, $id));     

            if (empty($request)) {
                $arrData = array("category_id" => $option_list, "code" => $code, "name_product" => $name, "desMain" => $desMain, "desGeneral" => $desGeneral, "sliderMbl" => $sliderMbl, "sliderDst" => $sliderDst, "sliderDes" => $sliderDes, "brand" => $brand, "price" => $price , "stock" => $stock, "status" => $status); 
                $result = $GLOBALS["db"]->update("products", $arrData, "id_product='".$id."'");
            }else{
                $result = "exist";
            }  
            return $result;     
        }

        static public function deleteProduct($data)
        {
            if (empty($data)) {return false;}

            $status['status'] = 0;
            $request =  $GLOBALS["db"]->update("Products", $status, "id_product='".$data."'");
            
            if($request) {$result = "ok";}

            return $result;
        }

    }

?>