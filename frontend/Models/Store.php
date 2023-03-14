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

        static public function getProducts($data)
        {
            $sql = "SELECT * FROM products WHERE category_id IN ($data)";
            return $GLOBALS["db"]->selectAll($sql, array());
        }

        static public function produc()
        {
            $sql = "SELECT * FROM products WHERE status = 1";
            return $GLOBALS["db"]->selectAll($sql, array());
        }
        static public function getProductsLimit($start, $perload)
        {
             $sql = "SELECT * FROM products LIMIT $start, $perload";;
            return $GLOBALS["db"]->selectAll($sql, array());
        }
    }


?>