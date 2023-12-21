<?php

class Models_Resultado{

    static public function searchData($data) {
        $request = array();
        $getProdSearch = "SELECT p.id_product, p.name_product, p.brand, p.price, p.stock, p.prevPrice, p.discount, p.cantDues, p.priceDues, p.url, c.name_category FROM products p INNER JOIN categories c ON p.category_id = c.id_category WHERE (p.name_product LIKE ? OR p.brand LIKE ?) AND p.status = ? LIMIT 5";
        $arrProd = $GLOBALS["db"]->selectAll($getProdSearch, array('%'.$data.'%', '%'.$data.'%', 1));

        if (empty($arrProd)) {
            $getUrlCtg = "SELECT url FROM categories WHERE name_category LIKE ? AND status = ?";
            $arrUrl = $GLOBALS["db"]->auto_array($getUrlCtg, array('%'.$data.'%', 1));
            if (!empty($arrUrl)) {
                $getCategories = "  WITH RECURSIVE category_path AS (
                                        SELECT id_category, fatherCategory, url
                                        FROM categories
                                        WHERE url = ?
                                        UNION
                                        SELECT c.id_category, c.fatherCategory, c.url
                                        FROM categories c
                                        JOIN category_path cp ON c.id_category = cp.fatherCategory
                                    )
                                    SELECT url
                                    FROM category_path
                                    ORDER BY id_category";
                $arrCategories =  $GLOBALS["db"]->selectAll($getCategories, array($arrUrl['url']));
                if (!empty($arrCategories)) {
                    $url_reference = array_column($arrCategories, 'url');
                    $end_path_id = Models_Store::getIdCategory(end($url_reference));
                    $sons_end_path = Models_Categories::dataSons(end($end_path_id));
                    $id_sons = "";

                    foreach ($sons_end_path as $data) {
                        $id_sons .= Utils::desencriptar($data["id_son"]).",";
                    }
                    $id_sons = rtrim($id_sons, ",");

                    $id_sons = !empty($id_sons) ? $id_sons : end($end_path_id);
                    $products = Models_Store::getProducts($id_sons, "", "", "", 0, 5);
                    
                    $amount = "SELECT COUNT(*) AS amount FROM products WHERE category_id IN ($id_sons) AND status = ?";
                    $request = array("products" => $products,  "amount" => $GLOBALS["db"]->selectAll($amount, array(1)));
                }
            }
        }else{
            $amount = "SELECT COUNT(*) AS amount FROM products WHERE (name_product LIKE ? OR brand LIKE ?) AND status = ?";
            $request = array("products" => $arrProd, "amount" => $GLOBALS["db"]->selectAll($amount, array('%'.$data.'%', '%'.$data.'%', 1)));
        }
        return $request;
    }

    static public function showSearchData($data) {
        $request = array();
        if (count($data) < 2) {
            $sql = "SELECT id_product, name_product, desMain, brand, price, stock, prevPrice, discount, cantDues, priceDues, url FROM products WHERE name_product LIKE ? || brand LIKE ? AND status = ? ORDER BY dataCreate ASC LIMIT 0, 10";
            $arrData = $GLOBALS["db"]->selectAll($sql, array('%'.$data[0].'%', '%'.$data[0].'%', 1));
            if (empty($arrData)) {
                $getUrlCtg = "SELECT url FROM categories WHERE name_category LIKE ? AND status = ?";
                $arrUrl = $GLOBALS["db"]->auto_array($getUrlCtg, array('%'.$data[0].'%', 1));
                if (!empty($arrUrl)) {
                    $getCategories = "  WITH RECURSIVE category_path AS (
                                            SELECT id_category, fatherCategory, url
                                            FROM categories
                                            WHERE url = ?
                                            UNION
                                            SELECT c.id_category, c.fatherCategory, c.url
                                            FROM categories c
                                            JOIN category_path cp ON c.id_category = cp.fatherCategory
                                        )
                                        SELECT url
                                        FROM category_path
                                        ORDER BY id_category";
                    $arrCategories =  $GLOBALS["db"]->selectAll($getCategories, array($arrUrl['url']));
                    
                    if (!empty($arrCategories)) {
                        $url_reference = array_column($arrCategories, 'url');
                        $end_path_id = Models_Store::getIdCategory(end($url_reference));
                        $sons_end_path = Models_Categories::dataSons(end($end_path_id));
                        $id_sons = "";

                        foreach ($sons_end_path as $data) {
                            $id_sons .= Utils::desencriptar($data["id_son"]).",";
                        }
                        $id_sons = rtrim($id_sons, ",");

                        $id_sons = !empty($id_sons) ? $id_sons : end($end_path_id);
                        $products = Models_Store::getProducts($id_sons, "", "", "", 0, 10);
                        
                        $dataSummary = self::dataSummary($id_sons);
                        $request = array("products" => $products, "data" => $id_sons, "dataSummary" => $dataSummary);
                    }
                }
            }else{
                $dataSummary = self::dataSummary($data);
                $request = array("products" => $arrData, "data" => $data, "dataSummary" => $dataSummary);
            }
        }else{
            $sql = "SELECT p.id_product, p.name_product, p.desMain, p.brand, p.price, p.stock, p.prevPrice, p.discount, p.cantDues, p.priceDues, p.url, c.name_category FROM products p INNER JOIN categories c ON p.category_id = c.id_category WHERE c.name_category LIKE ? AND p.brand LIKE ? AND p.status = ? ORDER BY p.dataCreate ASC LIMIT 0, 10";
            $products = $GLOBALS["db"]->selectAll($sql, array('%'.$data[0].'%', '%'.$data[1].'%', 1));

            if (!empty($products)) {
                $dataSummary = self::dataSummary($data);
                $request = array("products" => $products, "data" => $data, "dataSummary" => $dataSummary);
            }
        }
        return $request;
    }
    
    static public function dataSummary($data) {
        $arraySql = array();
        $sqlPriceAmount = "SELECT MIN(p.price) AS price_min, MAX(p.price) AS price_max, COUNT(*) AS amount_products FROM products p ";
        $sqlBrand = "SELECT p.brand, COUNT(*) as amount FROM products p ";
        if (is_string($data)) {
           $sqlPriceAmount .= "WHERE p.category_id IN ($data) AND p.status = ?"; 
           $sqlBrand .= "WHERE p.category_id IN ($data) AND p.status = ? GROUP BY brand";
           $arraySql = array(1);
        }

        if (is_array($data)) {
            if (count($data) < 2) {
                $sqlPriceAmount .= "WHERE (p.name_product LIKE ? OR p.brand LIKE ?) AND p.status = ?"; 
                $sqlBrand .= "WHERE (p.name_product LIKE ? OR p.brand LIKE ?) AND p.status = ? GROUP BY brand";
                $arraySql = array('%'.$data[0].'%', '%'.$data[0].'%', 1);
            }else{
                $sqlPriceAmount .= "INNER JOIN categories c ON p.category_id = c.id_category WHERE (c.name_category LIKE ? AND p.brand LIKE ?) AND p.status = ?";
                $sqlBrand .= "INNER JOIN categories c ON p.category_id = c.id_category WHERE (c.name_category LIKE ? AND p.brand LIKE ?) AND p.status = ? GROUP BY brand";
                $arraySql = array('%'.$data[0].'%', '%'.$data[1].'%', 1);
            }
        }

        $dataPriceAmount = $GLOBALS["db"]->selectAll($sqlPriceAmount, $arraySql);
        $dataBrand = $GLOBALS["db"]->selectAll($sqlBrand, $arraySql);
        
        return array("dataPriceAmount" => $dataPriceAmount, "dataBrand" => $dataBrand);
    }

    static public function getProductsCategorias($get, $data, $more = "") {
        $sql = "SELECT $get FROM products WHERE category_id IN ($data) AND status = ? $more";
        return $GLOBALS["db"]->selectAll($sql, array(1));
    }

}

?>