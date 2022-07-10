<?php

    class RolesModel extends Mysql{
        public $intIdrol;
        public $strRol;
        public $strDescripcion;
        public $intStatus;


        function __construct(){
            parent::__construct();
        }

        public function selectRoles()
        {
            $sql = "SELECT  * FROM project_cg.roles WHERE status != 0";
            $request = $this->selectAll($sql);
            return $request;
        }

        public function insertRol(string $nameRol, string $descripcion, int $status)
        {
            $return = "";
            $this->strRol = $nameRol;
            $this->strDescripcion = $descripcion;
            $this->intStatus = $status;

            $sql_exists_rol = "SELECT * FROM project_cg.roles WHERE nombrerol = '$this->strRol'";

            $request = $this->selectAll($sql_exists_rol);

            if (empty($request)) {
                $sql_insert_rol = "INSERT INTO project_cg.roles(nombrerol, descripcion, status) VALUES('$this->strRol', '$this->strDescripcion', $this->intStatus)";
                
                $request = $this->insert($sql_insert_rol);;
                $return = $request;
            }else{
                $return = "existe";
            }

            return $return;
        }

    }

?>