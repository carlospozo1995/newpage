static public function deleteCategory($data)
        {
            if (empty($data)) {return false;}

            $sql = "SELECT * FROM products WHERE category_id = ?";
            $exist_products =  $GLOBALS["db"]->selectAll($sql, array($data));

            if (empty($exist_products)) {
                $status['status'] = 0;
                $request =  $GLOBALS["db"]->update("categories", $status, "id_category='".$data."'");
                
                $request ? $result = "ok" : $result = "error";
            }else{
                $result = "product_exist";
            }

            

            return $result;
        }




        controller------------


        case 'delCategory':
					if (empty(Utils::getParam("data", ""))) {
						die();
					}else{
						
						$id_category = Utils::desencriptar(Utils::getParam("data", ""));
						$sonsCategory = Models_Categories::dataSons($id_category);
						$result = "";

						!empty($sonsCategory) ? $result = "exist" : $result = Models_Categories::deleteCategory($id_category);

						try {
							if ($result == "ok") {
								$status = true;
								$msg = "Se ha eliminado la categoria con exito.";
							}else if($result == "exist"){
								throw new Exception("No puede eliminar una cartegoria que contiene subcategorias.");
								die();
							}else if($result = "product_exist"){
								throw new Exception("Verifique si la categoria a eliminar no contenga productos.");
								die();
							}else{
								throw new Exception("Ha ocurrido un error. Intentelo mas tarde.");
								die();
							}
						} catch (Exception $e) {
							$status = false;
							$msg = $e->getMessage();
						}

						$data = array("status" => $status,"msg" => $msg);
						echo json_encode($data);
					}
				break;





                <!-- ------------------------------------- -->

                CONTROLLER

                case 'delCategory':
					if (empty(Utils::getParam("data", ""))) {
						die();
					}else{
						$id_category = Utils::desencriptar(Utils::getParam("data", ""));
						$result = Models_Categories::deleteCategory($id_category);
						try {
							if($result == ""){
								throw new Exception("Ha ocurrido un error. Intentelo mas tarde.");
								die();
							}else if ($result == "ok") {
								$status = true;
								$msg = "Se ha eliminado la categoria con exito.";
							}else if($result == "exist_ctg"){
								throw new Exception("No puede eliminar una cartegoria que contiene subcategorias.");
								die();
							}else if($result = "exist_prod"){
								throw new Exception("Verifique si la categoria a eliminar no contenga productos.");
								die();
							}
							// else{
							// 	throw new Exception("Ha ocurrido un error. Intentelo mas tarde.");
							// 	die();
							// }
						} catch (Exception $e) {
							$status = false;
							$msg = $e->getMessage();
						}

						$data = array("status" => $status,"msg" => $msg);
						echo json_encode($data);
					}
					
				break;



                MODELS

                if (empty($data)) {return false;}
            
            $sonsCategory = self::dataSons($data);

            if (!empty($sonsCategory)) {
                $result = "exist_ctg";
            }else{
                $sql = "SELECT * FROM products WHERE category_id = ? AND status != 0";
                $request_prod =  $GLOBALS["db"]->selectAll($sql, array($data));

                if (!empty($request_prod)) {
                    $result = "exist_prod";
                }else{
                    $status['status'] = 0;
                    $request =  $GLOBALS["db"]->update("categories", $status, "id_category='".$data."'");
                    if($request){$result = "ok";}
                }

                
            }
            return $result;

            //     $status['status'] = 0;
            //     $request =  $GLOBALS["db"]->update("categories", $status, "id_category='".$data."'");
                
            //     $request ? $result = "ok" : $result = "error";
            

            // return $result;