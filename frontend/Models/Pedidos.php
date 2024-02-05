<?php

    class Models_Pedidos{

        static public function getOrders($user) {
            $sql = "SELECT o.id_order, o.num_order, o.dateCreate, o.user_id, o.total, o.payment_type_id, o.shipping_address, o.status, s.reviewed_date, s.shipping_date, s.delivery_date, s.reviewed_comment, s.shipping_comment, s.delivery_comment FROM orders o INNER JOIN order_progress s ON o.id_order = s.order_id";
            if ($user != 1) {
                $sql .= " WHERE o.user_id = $user";
            }
            return $GLOBALS["db"]->selectAll($sql, array());
        }

        static public function getOrder($data) {
            $sql_o = "SELECT o.id_order, o.num_order, o.dateCreate, o.shipping_cost, o.user_id, o.total, o.payment_type_id, o.shipping_address, o.status, u.name_user, u.surname_user, u.phone, u.email, s.reviewed_date, s.shipping_date, s.delivery_date FROM orders o JOIN users u ON o.user_id = u.id_user JOIN order_progress s ON o.id_order = s.order_id WHERE o.id_order = ?";
            $request_o =  $GLOBALS["db"]->auto_array($sql_o, array($data));

            $sql_p = "SELECT product_id, name_product, price, quantityOrdered, url_product FROM detail_orders WHERE order_id = ?";
            $request_p = $GLOBALS["db"]->selectAll($sql_p, array($data));
           
            $request_o['ordered_products'] = $request_p;
            return $request_o;
        }

        static public function getOrderProgress($data) {
            $sql = "SELECT s.reviewed_date, s.shipping_date, s.delivery_date, s.reviewed_comment, s.shipping_comment, s.delivery_comment, o.num_order FROM order_progress s INNER JOIN orders o ON s.order_id = o.id_order WHERE s.order_id = ?";
            return $GLOBALS["db"]->selectAll($sql, array($data));
        }

        static public function updateOrderProgress($id, $date, $fielDate, $comment, $fielComment) {
            if (empty($comment)) {
                if ($fielComment == "reviewed_comment") {
                    $comment = "Hemos revisado su pedido, iniciamos proceso de entrega.";
                }

                if ($fielComment == "shipping_comment") {
                    $comment = "Su pedido ha sido despachado y está en ruta hacia su destino.";
                }

                if ($fielComment == "delivery_comment") {
                    $comment = "¡Felicidades! Su pedido ha sido entregado satisfactoriamente.";
                }
            }
            $arrData = array($fielDate => $date, $fielComment => $comment);
            return $GLOBALS["db"]->update("order_progress", $arrData, "order_id='".$id."'");
        }

        static public function getStatusOrder($data) {
            $sql = "SELECT status FROM orders WHERE id_order = ?";
            return $GLOBALS["db"]->auto_array($sql, array($data));
        }

        static public function updateStatusOrder($status, $data) {
            return $GLOBALS["db"]->update("orders", array("status" => $status), "id_order='".$data."'");
        }

        static public function updateStockByCancelled($id, $quantity) {
            $sql = "SELECT stock  FROM products WHERE id_product = ?";
            $request = $GLOBALS["db"]->auto_array($sql, array($id));

            if (!empty($request)) {

                $newStock = intval($request['stock'] + intval($quantity));
                
                $arrUpdate = array("stock" => $newStock);
                return $GLOBALS["db"]->update("products", $arrUpdate, "id_product='".$id."'");

            }
        }

    }


?>