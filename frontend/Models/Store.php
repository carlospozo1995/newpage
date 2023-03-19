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

        static public function getProducts($data, $data_sql, $start = null, $perload = null)
        {
            $limit = "";
            if ($start !== null && $perload !== null) {
                $limit = " LIMIT $start, $perload";
            }
            $sql = "SELECT * FROM products WHERE category_id IN ($data) AND status = 1 $data_sql $limit";
            
            return $GLOBALS["db"]->selectAll($sql, array());
        }

    }


?>