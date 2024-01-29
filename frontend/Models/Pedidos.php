<?php

    class Models_Pedidos{

        static public function getOrders($user) {
            $sql = "SELECT o.id_order, o.num_order, o.dateCreate, o.user_id, o.total, o.payment_type_id, o.shipping_address, o.status, s.reviewed_date, s.shipping_date, s.delivery_date, s.reviewed_comment, s.shipping_comment, s.delivery_comment FROM orders o INNER JOIN order_status s ON o.id_order = s.order_id";
            if ($user != 1) {
                $sql .= " WHERE o.user_id = $user";
            }
            return $GLOBALS["db"]->selectAll($sql, array());
        }

        static public function getOrder($data) {
            $sql_o = "SELECT o.id_order, o.num_order, o.dateCreate, o.shipping_cost, o.user_id, o.total, o.payment_type_id, o.shipping_address, o.status, u.name_user, u.surname_user, u.phone, u.email, s.reviewed_date, s.shipping_date, s.delivery_date FROM orders o JOIN users u ON o.user_id = u.id_user JOIN order_status s ON o.id_order = s.order_id WHERE o.id_order = ?";
            $request_o =  $GLOBALS["db"]->auto_array($sql_o, array($data));

            $sql_p = "SELECT product_id, name_product, price, quantityOrdered, url_product FROM detail_orders WHERE order_id = ?";
            $request_p = $GLOBALS["db"]->selectAll($sql_p, array($data));
           
            $request_o['ordered_products'] = $request_p;
            return $request_o;
        }

        static public function getStatusOrder($data) {
            $sql = "SELECT s.reviewed_date, s.shipping_date, s.delivery_date, s.reviewed_comment, s.shipping_comment, s.delivery_comment, o.num_order FROM order_status s INNER JOIN orders o ON s.order_id = o.id_order WHERE s.order_id = ?";
            return $GLOBALS["db"]->selectAll($sql, array($data));
        }

    }


?>