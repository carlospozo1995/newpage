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
    }

?>