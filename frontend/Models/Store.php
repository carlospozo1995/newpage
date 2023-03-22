<?php

    class Models_Store{

        static public function getCategories($data)
        {
            $sql = "SELECT * FROM categories WHERE url IN ($data)";
            return $GLOBALS["db"]->selectAll($sql, array());
        }

        static public function getCategory($data)
        {
            $sql = "SELECT id_category FROM categories WHERE url = ?";
            return $GLOBALS["db"]->auto_array($sql, array($data));
        }

        static public function getProducts($data, $data_sql, $flag, $start = null, $perload = null)
        {   
            if ($flag === true) {
                $sql = "SELECT * FROM products WHERE category_id IN ($data) $data_sql";
            }else{
                $sql = "SELECT * FROM products WHERE category_id IN ($data) AND status = 1 $data_sql";
            }

            if ($start !== null && $perload !== null) {
                $sql .= " LIMIT $start, $perload";
            }   

            return $GLOBALS["db"]->selectAll($sql, array());
        }

    }


?>