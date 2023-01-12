<?php

    class Models_Users{
        static public function getUsers()
        {
            $not_admin = ""; 

            if ($_SESSION['idUser'] != 1) {
                $not_admin = " AND u.id_user != 1";
            }

            $sql = "SELECT u.id_user, u.dni, u.name_user, u.surname_user, u.phone, u.email, u.status, r.name_rol, r.id_rol FROM users u INNER JOIN roles r ON u.rolid = r.id_rol WHERE u.status != ?" . $not_admin;
            $result = $GLOBALS["db"]->selectAll($sql, array(0));
            return $result;            
        }

        static public function selectRoles()
        {
            $whereAdmin = "";

            if($_SESSION['idUser'] != 1){
                $whereAdmin = " AND id_rol != 1 AND id_rol >= '".$_SESSION['data_user']['id_rol']."'";
            }
            
            $sql = "SELECT * FROM roles WHERE status = ?" . $whereAdmin;
            return $GLOBALS["db"]->selectAll($sql, array(1));
        }

        static public function insertUser($dni, $name, $surname, $phone, $email, $password, $list_rol, $status)
        {   
            $sql = "SELECT * FROM users WHERE dni = ? OR email = ?";
            $request = $GLOBALS["db"]->auto_array($sql, array($dni, $email));     

            if (empty($request)) {
                $arrData[] = array("dni" => $dni, "name_user" => ucfirst($name), "surname_user" => ucfirst($surname), "phone" => $phone, "email"  => $email, "password" => $password, "rolid" => $list_rol, "status" => $status); 
                $result = $GLOBALS["db"]->insert_multiple("users", $arrData);
            }else{
                $sql_exists = "SELECT  IF(con.joinDni LIKE '%".$dni."%',1,0) AS dnis,
                                            IF(con.joinEmail LIKE '%".$email."%',1,0) AS emails
                                            FROM (SELECT GROUP_CONCAT(dni) AS joinDni, 
                                                            GROUP_CONCAT(email) AS joinEmail FROM users 
                                                            WHERE dni = '".$dni."' OR email = '".$email."') AS con";
                $request_exists = $GLOBALS["db"]->selectAll($sql_exists, array());
                if(!empty($request_exists)){
                    if ($request_exists[0]['dnis'] && $request_exists[0]['emails']) {
                        $result = "both_exist";
                    }else if ($request_exists[0]['dnis']) {
                        $result = "dni_exist";
                    }else if($request_exists[0]['emails']){
                        $result = "email_exist";
                    }else{
                        $result = "";
                    }
                }
            }

            return $result;

        }
    }

?>