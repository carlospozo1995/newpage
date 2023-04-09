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

        // SQL PAGE PRODUCTO
        static public function getProduct($data)
        {
            $sql = "SELECT * FROM products WHERE url = ?";
            return $GLOBALS["db"]->auto_array($sql, array($data));
        }

        static public function getCategoryNames($id_product)
        {
            $sql = "SELECT 
                c1.name_category AS category1, c1.url AS url1,
                c2.name_category AS category2, c2.url AS url2,
                c3.name_category AS category3, c3.url AS url3
            FROM 
                (SELECT * FROM products WHERE id_product = ?) p
                JOIN categories c1 ON p.category_id = c1.id_category
                LEFT JOIN categories c2 ON c1.fatherCategory = c2.id_category
                LEFT JOIN categories c3 ON c2.fatherCategory = c3.id_category
            ";

            $result = $GLOBALS["db"]->selectAll($sql, array($id_product));
            return isset($result[0]) ? $result[0] : array();
        }

    }
?>
