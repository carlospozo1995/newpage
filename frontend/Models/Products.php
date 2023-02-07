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
            $sql = "SELECT  table_p.*, table_c.name_category AS category FROM products table_p INNER JOIN categories table_c ON table_p.category_id = table_c.id_category where table_p.id_product = ?";
            return $GLOBALS["db"]->auto_array($sql, array($data));
        }

    }

?>