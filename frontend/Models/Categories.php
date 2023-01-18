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
            $data_id = "";

            if(!empty($data)){$data_id = " AND id_category != $data";}
            $sql = "SELECT * FROM categories WHERE status = ?".$data_id;
            $result = $GLOBALS["db"]->selectAll($sql, array(1));
            return $result;
        }

    }

?>