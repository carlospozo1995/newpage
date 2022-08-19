<?php

    class CategoriasModel extends Mysql{
        public $intIdCategoria;
        public $strCategoria;
        public $strDescripcion;
        public $strImgPortada;
        public $intStatus;

        function __construct(){
            parent::__construct();
        }

        public function insertCategoria(string $nameCategoria, string $descripcion, string $imgPortada, int $status)
        {
            $return = "";
            $this->strCategoria = $nameCategoria;
            $this->strDescripcion = $descripcion;
            $this->strImgPortada = $imgPortada;
            $this->intStatus = $status;

            $sql_exists_categoria = "SELECT * FROM project_cg.categoria WHERE nombre = '$this->strCategoria'";

            $request = $this->selectAll($sql_exists_categoria);

            if (empty($request)) {
                $sql_insert_categoria = "INSERT INTO project_cg.categoria(nombre, descripcion, portada, status) VALUES('$this->strCategoria', '$this->strDescripcion', '$this->strImgPortada', $this->intStatus)";
                
                $request = $this->insert($sql_insert_categoria);
                $return = $request;
            }else{
                $return = "existe";
            }

            return $return;
        }

        public function selectCategorias()
        {
            $sql_all_categorias = "SELECT  * FROM project_cg.categoria WHERE status != 0";
            $request = $this->selectAll($sql_all_categorias);
            return $request;
        }

        public function selectCategoria(int $idcategoria)
        {
            $this->intIdCategoria = $idcategoria;
            
            $sql_select_categoria = "SELECT * FROM project_cg.categoria WHERE idcategoria = $this->intIdCategoria";
            $request = $this->select( $sql_select_categoria);
            return $request;
        }
    }

?>