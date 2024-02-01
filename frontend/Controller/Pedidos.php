<?php

	class Controller_Pedidos{

		public function buildPage()
		{	
			Utils::sessionStart();
			if (empty($_SESSION['idUser'])) {
				header('Location: '.BASE_URL.'login');
			}

			$action = Utils::getParam("action", "");
			$data = array();
			$msg = "";
			$status = true;
			$request = "";
			$errorMessage = "Ha ocurrido un error. Inténtelo de nuevo.";

			switch ($action) {

                case "statusOrder":
					try {
						if (isset($_POST)) {
							$id_order = Utils::desencriptar($_POST['id_order']);

							if (!empty($id_order)) {
								$request = Models_Pedidos::getStatusOrder($id_order);
							}else{
								throw new Exception($errorMessage);
								die();
							}
						}else{
							throw new Exception($errorMessage);
							die();
						}
					} catch (Exception $e) {
						$status = false;
						$msg = $e->getMessage();
					}
					$data = array("status" => $status, "msg" => $msg, "request" => $request);
					echo json_encode($data);
                break;

				case "updateStatusOrder":
					try {
						if (isset($_POST)) {
							$id_order = Utils::desencriptar($_POST['id']);
							$amountEle = $_POST['amountEle'];
							$status = $_POST['status'];
							$date = $_POST['date'];
							$comment = $_POST['comment'];

							if ($amountEle == 1) {
								if (empty($id_order) || empty($status) || empty($date)) {
									throw new Exception($errorMessage);
								}
							
								$currentDate = new DateTime();
								$orderDate = new DateTime($date);
							
								if ($orderDate < $currentDate->setTime(0, 0, 0)) {
									throw new Exception($errorMessage);
								}
							
								$dataStatus = Models_Pedidos::getStatusOrder($id_order);
							
								if (empty($dataStatus)) {
									throw new Exception($errorMessage);
								}

								$statusFields = [
									1 => 'reviewed_date',
									2 => 'shipping_date',
									3 => 'delivery_date'
								];

								if (!empty($dataStatus[0][$statusFields[1]]) && empty($dataStatus[0][$statusFields[2]])) {
									if ($orderDate < new DateTime($dataStatus[0][$statusFields[1]])) {
										throw new Exception("Fecha pasada al del revisado.");
									}
								}

								if (!empty($dataStatus[0][$statusFields[2]])) {
									if ($orderDate < new DateTime($dataStatus[0][$statusFields[2]])) {
										throw new Exception("Fecha pasada al de la entrega.");
									}
								}
								$commentFields = [
									1 => 'reviewed_comment',
									2 => 'shipping_comment',
									3 => 'delivery_comment'
								];

								if (!isset($statusFields[$status])) {
									throw new Exception($errorMessage);
								}
								
								$field = $statusFields[$status];

								if (!empty($dataStatus[0][$field])) {
									throw new Exception($errorMessage);
								}

								$shippingEmpty = empty($dataStatus[0]['shipping_date']);
								$deliveryEmpty = empty($dataStatus[0]['delivery_date']);
								$reviewedEmpty = empty($dataStatus[0]['reviewed_date']);

								switch ($status) {
									case 1:
										if (!$shippingEmpty || !$deliveryEmpty) throw new Exception($errorMessage);
									break;
									case 2:
										if ($reviewedEmpty || !$deliveryEmpty) throw new Exception($errorMessage);
									break;
									case 3:
										if ($reviewedEmpty || $shippingEmpty) throw new Exception($errorMessage);
									break;
								}

								$updateStatus = Models_Pedidos::updateStatus($id_order, $date, $statusFields[$status], $comment, $commentFields[$status]);

								if ($updateStatus > 0) {
									$request = $status;
									$msg = "Progreso actualizado";
								}else{
									throw new Exception("Ha ocurrido un error. Inténtelo más tarde.");
								}
							} else {
								throw new Exception($errorMessage);
							}							

						}else{
							throw new Exception($errorMessage);
							die();
						}
					} catch (Exception $e) {
						$status = false;
						$msg = $e->getMessage();
					}
					$data = array("status" => $status, "request" => $request, "msg" => $msg);
					echo json_encode($data);

				break;

				default:
					Utils::permissionsData(MPEDIDOS);

					if (empty($_SESSION['module']['ver'])) {
						header('Location: '.BASE_URL.'Dashboard');	
					}

		            $variable["file_js"][] = "f_pedidos";
                    View::renderPage('Pedidos', $variable);
				break;

			}
		}

	}