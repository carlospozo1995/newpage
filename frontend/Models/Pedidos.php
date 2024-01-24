<?php

    class Models_Pedidos{

        static public function getOrders($user) {
            $sql = "SELECT id_order, num_order, dateCreate, user_id, total, payment_type_id, shipping_address, status, process FROM orders";
            if ($user != 1) {
                $sql .= " WHERE user_id = $user";
            }
            return $GLOBALS["db"]->selectAll($sql, array());
        }

        static public function getOrder($data) {
            $sql_o = "SELECT o.id_order, o.num_order, o.dateCreate, o.user_id, o.total, o.payment_type_id, o.shipping_address, o.status, o.process, u.name_user, u.surname_user, u.phone, u.email FROM orders o INNER JOIN users u ON o.user_id = u.id_user WHERE o.id_order = ?";
            $request_o =  $GLOBALS["db"]->auto_array($sql_o, array($data));

            $sql_p = "SELECT product_id, name_product, price, quantityOrdered, url_product FROM detail_orders WHERE order_id = ?";
            $request_p = $GLOBALS["db"]->selectAll($sql_p, array($data));
           
            $request_o['ordered_products'] = $request_p;
            return $request_o;
        }

    }


?>