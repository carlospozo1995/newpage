<?php

    class Models_Store{
        // SQL INSERT CLIENT
        static public function insertClient($name, $surname, $phone, $email, $password)
        {
            $sql = "SELECT * FROM users WHERE email = ?";
            $request = $GLOBALS["db"]->auto_array($sql, array($email));
            if (empty($request)) {
                $arrData[] = array("name_user" => ucfirst($name), "surname_user" => ucfirst($surname), "phone" => $phone, "email"  => $email, "password" => $password, "rolid" => 6);
                $result = $GLOBALS["db"]->insert_multiple("users", $arrData);
            }else{
                $result = "email_exists";
            }

            return $result;
        }

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
            $sql = "SELECT * FROM products WHERE url = ? AND status = 1";
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

        static public function getProductId($data)
        {
            $sql_prod = "SELECT p.id_product, p.category_id, p.code, p.name_product, p.url, c.name_category AS categoria, p.price, p.stock FROM products p INNER JOIN categories c ON p.category_id = c.id_category WHERE p.status = 1 AND p.id_product = ?";
            $request_prod = $GLOBALS["db"]->auto_array($sql_prod, array($data));

            if (!empty($request_prod)) {
                $id_product = $request_prod['id_product'];
                $sql_img = "SELECT image FROM img_product WHERE product_id = ?";
                $request_img = $GLOBALS["db"]->selectAll($sql_img, array($id_product));

                if(count($request_img) > 0){
                    for ($i=0; $i < count($request_img); $i++) {
                        $request_img[$i]['url_image'] = MEDIA_ADMIN.'files/images/upload_products/'.$request_img[$i]["image"];
                    }
                }else{
                    $request_img[0]['url_image'] = MEDIA_ADMIN.'files/images/upload_products/empty_img.png';
                }

                $request_prod['images'] = $request_img;
            }

            return $request_prod;
        }

        static public function paymentType() {
            $sql = "SELECT * FROM payment_type";
            $request = $GLOBALS["db"]->selectAll($sql, array());
            return $request;
        }

        static public function getOrderedProducts($data, $flag)
        {
            $sql = "SELECT id_product, code, name_product, stock, url, price, status FROM products WHERE id_product IN ($data)";
            if ($flag) {$sql .= ' AND status = 1';}

            $products = $GLOBALS["db"]->selectAll($sql, array());

            $sql_img = "SELECT product_id, image FROM img_product WHERE product_id IN ($data)";
            $request_img = $GLOBALS["db"]->selectAll($sql_img, array());

            foreach ($products as &$product) {
                $images = array_filter($request_img, function ($img) use ($product) {
                    return $img['product_id'] == $product['id_product'];
                });
                if (count($images) > 0) {
                    $product['images'] = array_values($images);
                    foreach ($product['images'] as &$image) {
                        $image['url_image'] = MEDIA_ADMIN . 'files/images/upload_products/' . $image['image'];
                    }
                } else {
                    $product['images'][]['url_image'] = MEDIA_ADMIN . 'files/images/upload_products/empty_img.png';
                }
            }

            return $products;
        }

        static public function updateStockTransaction($productIdsArr, $amountProductsArr, $productsIds)
        {
            $sql = "UPDATE products SET stock = CASE id_product ";

            foreach ($productIdsArr as $index => $productId) {
                $amount = $amountProductsArr[$index];
                $sql .= "WHEN $productId THEN CASE WHEN stock > 0 THEN stock - $amount ELSE 0 END ";
            }

            $sql .= "ELSE stock END WHERE FIND_IN_SET(id_product, '$productsIds') AND status = 1";

            $request =  $GLOBALS["db"]->execute($sql);
            return $request;
        }

        static public function updatStockByCancellation($productIdsArr, $amountProductsArr, $productsIds)
        {
            $sql = "UPDATE products SET stock = CASE id_product ";

            foreach ($productIdsArr as $index => $productId) {
                $amount = $amountProductsArr[$index];
                $sql .= "WHEN $productId THEN stock + $amount ";
            }

            $sql .= "ELSE stock END WHERE FIND_IN_SET(id_product, '$productsIds') AND status = 1";

            $request =  $GLOBALS["db"]->execute($sql);
            return $request;
        }

        static public function insertCardPurchaseValidationData($unique_code, $productsIdsArr, $productsAmountArr) {
            $arrData[] = array("code_unique" => $unique_code, "products_id" => implode("," ,$productsIdsArr), "products_amount" => implode("," ,$productsAmountArr));
            $result = $GLOBALS["db"]->insert_multiple("card_transaction", $arrData);
            return $result;
        }

        static public function insertOrders($orders, $flag) {
            $arrData[] = $orders;
            $result = $flag === true ? $GLOBALS["db"]->insert_multiple("orders", $arrData) : $GLOBALS["db"]->insert_multiple("detail_orders", $arrData, true);
            return $result;
        }

        static public function getIdClient($data) {
            $sql = "SELECT user_id FROM orders WHERE transaction_uniqueCode = '$data'";
            return $GLOBALS["db"]->auto_array($sql, array($data));
        }

        static public function getDataClient($data)
        {
            $sql = "SELECT dni, name_user, surname_user, phone, email FROM users WHERE id_user = ?";
            return $GLOBALS["db"]->auto_array($sql, array($data));
        }

        static public function updateDniClient($data, $id_client){
            $arrData = array("dni" => $data);
            $result = $GLOBALS["db"]->update("users", $arrData, "id_user='".$id_client."'");
            return $result;
        }

        static public function showOrderClient($data) {
            $sql_order = "SELECT o.id_order, o.dateCreate, o.shipping_cost, o.total, o.payment_type_id, o.shipping_address, o.status, u.dni, u.name_user, u.surname_user, u.phone, u.email FROM orders o INNER JOIN users u ON o.user_id = u.id_user WHERE o.transaction_uniqueCode = ?";
            $request_o = $GLOBALS["db"]->auto_array($sql_order, array($data));

            $sql_products = "SELECT product_id, name_product, price, quantityOrdered, url_product FROM detail_orders WHERE order_id = ?";
            $request_p = $GLOBALS["db"]->selectAll($sql_products, array($request_o['id_order']));
           
            $productIds = implode(',', array_map(function($data) {
                return $data['product_id'];
            }, $request_p));

            $sql_img = "SELECT product_id, image FROM img_product WHERE product_id IN ($productIds)";
            $request_img = $GLOBALS["db"]->selectAll($sql_img, array());

            foreach ($request_p as &$product) {
                $images = array_filter($request_img, function ($img) use ($product) {
                    return $img['product_id'] == $product['product_id'];
                });
                if (count($images) > 0) {
                    $firstImage = reset($images);
                    $product['images'] = $firstImage['image'];
                } else {
                    $product['images'] = MEDIA_ADMIN . 'files/images/upload_products/empty_img.png';
                }
            }

            $request_o['ordered_products'] = $request_p;
            return $request_o;

        }
    }
?>

