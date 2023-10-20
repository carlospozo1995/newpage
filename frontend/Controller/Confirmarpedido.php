<?php
	class Controller_Confirmarpedido{
		
		public function buildPage()
		{	
			Utils::sessionStartStore();

            $orderClient = $_GET['order'];
            $verifyOrder = Models_Store::verifyOrder($orderClient);
            if(isset($_SESSION['login']) && !empty($orderClient) && empty($verifyOrder)){
                if (isset($_SESSION['paymentProcessData']) && $_SESSION['paymentProcessData']['paymentType'] != 1){
                    $orderData = $_SESSION['paymentProcessData'];
                    if ($orderData['uniqueCode'] == $orderClient) {
                        $shipping_costs = [
                            1 => ['cost' => 0, 'name' => 'Balao'],
                            2 => ['cost' => 5, 'name' => 'Santa Rita'],
                            3 => ['cost' => 10, 'name' => 'San Carlos'],
                        ];
                        $mainTown = isset($shipping_costs[$orderData['mainTown']]) ? $shipping_costs[$orderData['mainTown']]['name'] : '';
                        $subtotal = 0;
                        $iva = 0;
                        $total = 0;

                        foreach ($orderData['orderedProducts'] as $order) {
                            $subtotal += $order['price'] * $order['amount_product'];
                        }

                        $shipping_cost = $subtotal < 100 ? $shipping_costs[$orderData['mainTown']]['cost'] : 0;
                        $iva = $subtotal * 0.12;
                        // iva function
                        if ($subtotal > 0) {
                            $total = $subtotal + number_format($iva, 2) + $shipping_cost;
                        }

                        $addInfo = !empty($orderData['addInfo']) ? '-'.$orderData['addInfo'] : "";
                        $message = !empty($orderData['messageClient']) ? $orderData['messageClient'] : null;

                        $insertedData = array("num_order" => crc32(date("Y-m-d h:i:s")), "transaction_uniqueCode" => $orderData['uniqueCode'], "user_id" => $orderData['idClient'], "shipping_cost" => $shipping_cost, "total" => $total, "payment_type_id" => $orderData['paymentType'], "addressee" => $orderData['addressee'], "shipping_address" => $mainTown .'-'. $orderData['street'] .$addInfo, "message" => $message, "status" => 'Progress');

                        $insertOrders = Models_Store::insertOrders($insertedData, true);
                        
                        if ($insertOrders > 0) {
                            $arrDetailProducts = array();
                            // enviar correo al cliente sobre su compra
                            foreach ($orderData['orderedProducts'] as $order) {
                                $insertOrdersDetails = array("order_id" => $insertOrders, "product_id" => Utils::descryptStore($order['id']), "name_product" => $order['name'], "price" => $order['price'], "quantityOrdered" => $order['amount_product'], "url_product" => $order['url']);

                                $insertDetails = Models_Store::insertOrders($insertOrdersDetails, false);
                                $arrDetailProducts[] = $insertDetails;
                            }
                            
                            if (count($arrDetailProducts) > 0){
                                // echo count($arrDetailProducts);
                            }else{
                                // enviar mensaje al administrador sobre los detalles de los productos no insertados en la tabla detallePedidos mandando el array $insertOrdersDetails
                            }
                        }else{
                            // enviar mensaje al administrador sobre los productos no insertados en la tabla pedido mandando el array $insertedData
                        }
                    }
                }

                $idClient_transaction = Models_Store::getIdClient($orderClient);
                if (!empty($idClient_transaction) && $idClient_transaction['user_id'] == $_SESSION['idUser']) {
                    View::renderPage('Confirmarpedido', array("orderClient" => $orderClient));
                }else{
                    header("Location: ".BASE_URL);
                }

                if (isset($_SESSION['paymentProcessData']) && $orderData['paymentType'] != 1 && $orderData['uniqueCode'] == $orderClient) {
                    unset($_SESSION['paymentProcessData']);
                }
            }else{
                header("Location: ".BASE_URL);
            }
		}
	}

?>

