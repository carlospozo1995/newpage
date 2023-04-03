<?php

    class Models_Store{

        // SQL PAGE CATEGORIAS
        static public function getCategories($data1, $data2, $data3)
        {   
            $sql = "SELECT * FROM categories WHERE (url = ? AND fatherCategory IS NULL)";

            if (!empty($data2)) {
                $sql .= " OR (url = ? AND fatherCategory = (SELECT id_category FROM categories WHERE url = ?))";
            }

            if (!empty($data3)) {
                $sql .= " OR (url = ? AND fatherCategory = (SELECT id_category FROM categories WHERE url = ?))";
            }
            return $GLOBALS["db"]->selectAll($sql, array($data1, $data2, $data1, $data3, $data2));
        }

        static public function getIdCategory($data)
        {
            $sql = "SELECT id_category FROM categories WHERE url = ?";
            return $GLOBALS["db"]->auto_array($sql, array($data));
        }

        static public function getProducts($data, $brandCheck, $order, $range, $start = null, $perload = null)
        { 
            $sql = "SELECT * FROM products WHERE category_id IN ($data) $brandCheck $range AND status = 1 $order";

            if ($start !== null && $perload !== null) {
                $sql .= " LIMIT $start, $perload";
            }
            
            return $GLOBALS["db"]->selectAll($sql, array());
        }

        // SQL PAGE CATEGORIAS
        static public function getProduct($data)
        {
            $sql = "SELECT * FROM products WHERE url = ?";
            return $GLOBALS["db"]->auto_array($sql, array($data));
        }

    }

?>
