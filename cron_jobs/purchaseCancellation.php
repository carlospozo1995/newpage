<?php

    date_default_timezone_set("America/Guayaquil");
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "newproject";
    
    function executeQuery($conn, $query, $params = []) {
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            die("Error en la consulta: " . $conn->error);
        }
        
        if (!empty($params)) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        
        if ($stmt->errno) {
            die("Error en la ejecución de la consulta: " . $stmt->error);
        }
        
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        $stmt->close();
        return $data;
    }
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("La conexión a la base de datos falló: " . $conn->connect_error);
    }
    
    $conn->set_charset("utf8");
    
    $query_getData = "SELECT * FROM card_transaction";
    $arrTransaction = executeQuery($conn, $query_getData);

    if (!empty($arrTransaction)) {
        foreach ($arrTransaction as $value) {
            $uniqueCode = $value['code_unique'];
            $query_order = "SELECT * FROM orders WHERE transaction_uniqueCode = ?";
            $arrOrder = executeQuery($conn, $query_order, [$uniqueCode]);
            
            if (empty($arrOrder)) {
                $targetDate = new DateTime($value['date_create']);
                $currentDate = new DateTime();
                $difference = $currentDate->getTimestamp() - $targetDate->getTimestamp();
                $difference_minutes = $difference / 60;
                
                if ($difference_minutes >= 11) {
                    $query_update = "UPDATE products SET stock = CASE id_product ";
                    $ids = $value['products_id'];
                    $arrIds  = explode(",", $value['products_id']);
                    $arrAmount  = explode(",", $value['products_amount']);
                    
                    foreach ($arrIds as $index => $productId) { 
                        $amount = $arrAmount[$index];
                        $query_update .= "WHEN $productId THEN stock + $amount ";
                    }
                    
                    $query_update .= "ELSE stock END WHERE FIND_IN_SET(id_product, '$ids') AND status = 1";
                    if ($conn->query($query_update) == true) {
                        $query_delete = "DELETE FROM card_transaction WHERE code_unique = '$uniqueCode'";
                        $conn->query($query_delete);
                    } 
                }
            }
        }
    }
    
    $conn->close();
    
?>
