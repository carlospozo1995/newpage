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

        // static public function getNameCategories($id_product)
        // {
        //     $sql = "SELECT CONCAT_WS(' > ', c4.name_category, c3.name_category, c2.name_category, c1.name_category) AS category_path
        //         FROM products p
        //         JOIN categories c1 ON p.category_id = c1.id_category
        //         LEFT JOIN categories c2 ON c1.fatherCategory = c2.id_category
        //         LEFT JOIN categories c3 ON c2.fatherCategory = c3.id_category
        //         LEFT JOIN categories c4 ON c3.fatherCategory = c4.id_category
        //         WHERE p.id_product = $id_product";
        //     return $GLOBALS["db"]->selectAll($sql, array());
        // }

        static public function getNameCategories($id_product)
        {
            $sql = "SELECT CONCAT_WS(' > ', categories.category_path) AS category_path
                    FROM (
                        SELECT 
                            c.id_category, 
                            c.name_category,
                            (
                                SELECT CONCAT_WS(' > ', cp.name_category, c.name_category) 
                                FROM categories cp
                                WHERE cp.id_category = c.fatherCategory
                            ) AS category_path
                        FROM categories c
                        JOIN products p ON p.category_id = c.id_category
                        WHERE p.id_product = $id_product
                    ) categories
                    WHERE categories.category_path IS NOT NULL";

            return $GLOBALS["db"]->selectAll($sql, array());
        }


    }
?>
