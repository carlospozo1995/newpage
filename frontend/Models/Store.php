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

        static public function getNameCategories($id_product)
        {
            // $sql = "SELECT CONCAT_WS(' > ', c4.name_category, c3.name_category, c2.name_category, c1.name_category) AS category_path
            //     FROM products p
            //     JOIN categories c1 ON p.category_id = c1.id_category
            //     LEFT JOIN categories c2 ON c1.fatherCategory = c2.id_category
            //     LEFT JOIN categories c3 ON c2.fatherCategory = c3.id_category
            //     LEFT JOIN categories c4 ON c3.fatherCategory = c4.id_category
            //     WHERE p.id_product = $id_product";

           
            // $sql = "SELECT c1.name_category as category1, c2.name_category as category2, c3.name_category as category3, c4.name_category as category4
            // FROM products p
            // JOIN categories c1 ON p.category_id = c1.id_category
            // LEFT JOIN categories c2 ON c1.fatherCategory = c2.id_category
            // LEFT JOIN categories c3 ON c2.fatherCategory = c3.id_category
            // LEFT JOIN categories c4 ON c3.fatherCategory = c4.id_category
            // WHERE p.id_product = $id_product";
           

            // $sql = "SELECT category.name_category
            // FROM products p
            // JOIN categories category ON p.category_id = category.id_category";

            // for ($i = 1; $i <= 4; $i++) {
            //     $sql .= " LEFT JOIN categories cat{$i} ON category.fatherCategory = cat{$i}.id_category";
            // }

            // $sql .= " WHERE p.id_product = $id_product";




            // $sql = "SELECT category.name_category as category_name, cat1.name_category as parent_category_name";

            // for ($i = 2; $i <= 4; $i++) {
            //     $sql .= " , cat{$i}.name_category as parent_cat{$i}_name";
            // }

            // $sql .= " FROM products p
            //         JOIN categories category ON p.category_id = category.id_category";

            // for ($i = 1; $i <= 4; $i++) {
            //     $sql .= " LEFT JOIN categories cat{$i} ON category.fatherCategory = cat{$i}.id_category";
            // }

            // $sql .= " WHERE p.id_product = $id_product";



            // $sql = "SELECT category.name_category as category1";

            // for ($i = 2; $i <= 3; $i++) {
            //     $sql .= " , cat{$i}.name_category as category{$i}";
            // }

            // $sql .= " FROM products p
            //         JOIN categories category ON p.category_id = category.id_category";

            // for ($i = 1; $i <= 3; $i++) {
            //     $sql .= " LEFT JOIN categories cat{$i} ON category.fatherCategory = cat{$i}.id_category";
            // }

            // $sql .= " WHERE p.id_product = $id_product";

            //         return $GLOBALS["db"]->selectAll($sql, array());
            //     }


           // $sql = "SELECT 
           //      CONCAT_WS(' > ', c1.name_category, IFNULL(c2.name_category, ''), IFNULL(c3.name_category, '')) AS category_path
           //  FROM 
           //      products p
           //      JOIN categories c1 ON p.category_id = c1.id_category
           //      LEFT JOIN categories c2 ON c1.fatherCategory = c2.id_category
           //      LEFT JOIN categories c3 ON c2.fatherCategory = c3.id_category
           //  WHERE 
           //      p.id_product = $id_product
           //  UNION
           //  SELECT
           //      CONCAT_WS(' > ', c4.name_category, c3.name_category, c2.name_category, c1.name_category) AS category_path
           //  FROM
           //      products p
           //      JOIN categories c1 ON p.category_id = c1.id_category
           //      LEFT JOIN categories c2 ON c1.fatherCategory = c2.id_category
           //      LEFT JOIN categories c3 ON c2.fatherCategory = c3.id_category
           //      LEFT JOIN categories c4 ON c3.fatherCategory = c4.id_category
           //  WHERE
           //      p.id_product = $id_product
           //      AND c3.id_category IS NULL";





        //    $sql = "SELECT 
        //     CONCAT_WS(' > ', c1.name_category, c2.name_category) AS category_path
        // FROM 
        //     products p
        //     JOIN categories c1 ON p.category_id = c1.id_category
        //     JOIN categories c2 ON c1.fatherCategory = c2.id_category
        // WHERE 
        //     p.id_product = $id_product
        // UNION
        // SELECT
        //     CONCAT_WS(' > ', c1.name_category) AS category_path
        // FROM
        //     products p
        //     JOIN categories c1 ON p.category_id = c1.id_category
        // WHERE
        //     p.id_product = $id_product
        //     AND c1.fatherCategory IS NULL";




            $sql = "SELECT c1.name_category as category1, c2.name_category as category2, c3.name_category as category3
        FROM 
            products p
            JOIN categories c1 ON p.category_id = c1.id_category
            LEFT JOIN categories c2 ON c1.fatherCategory = c2.id_category
            LEFT JOIN categories c3 ON c2.fatherCategory = c3.id_category
        WHERE 
            p.id_product = $id_product";


             return $GLOBALS["db"]->selectAll($sql, array());

        }
           


    }
?>
