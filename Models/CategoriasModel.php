<?php

    class CategoriasModel extends Mysql{
        public $intIdCategoria;
        public $strCategoria;
        public $intCategoria;
        public $strImgPortada;
        public $intStatus;

        function __construct(){
            parent::__construct();
        }

        public function insertCategoria(string $titulo, $fatherCategoria, int $status, string $imgPortada){
            $return = "";
            $this->strCategoria = $titulo;
            $this->intCategoria = $fatherCategoria;
            $this->intStatus = $status;
            $this->strImgPortada = $imgPortada;

            $sql_exists_categoria = "SELECT * FROM project_cg.categorias WHERE nombre = '$this->strCategoria'";

            $request = $this->selectAll($sql_exists_categoria);

            if(empty($request)){
                $sql_insert_categoria = "INSERT INTO project_cg.categorias(nombre, imgcategoria, categoria_father_id, status) VALUES('$this->strCategoria', '$this->strImgPortada', $this->intCategoria, $this->intStatus)";
                echo $sql_insert_categoria;
                $request = $this->insert($sql_insert_categoria);
                $return = $request;
            }else{
                $return = "existe";
            }
            return $return;
        }

        public function selectCategorias()
        {
            $sql_all_categorias = "SELECT  * FROM project_cg.categorias WHERE status != 0";
            $request = $this->selectAll($sql_all_categorias);
            return $request;
        }
    }

?>