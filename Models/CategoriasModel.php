<?php

    class CategoriasModel extends Mysql{

        public $intIdCategoria;
        public $strCategoria;
        public $intCategoria;
        public $strImgPortada;
        public $strIcono;
        public $intStatus;

        function __construct(){
            parent::__construct();
        }

        public function sqlCategorias($idCategoria)
        {   
            $this->intCategoria = $idCategoria;
            $retutnId = "";
            if (!empty($this->intCategoria)){
                $retutnId = " AND idcategoria != $this->intCategoria";
            }

            $sql = "SELECT * FROM categorias WHERE status != 0" .$retutnId;
            $request = $this->selectAll($sql);
            return $request;
        }

        public function allCategorias()
        {
            $sql_categorias = "SELECT ca1.*, ca2.nombre AS fathercatname FROM categorias ca1 LEFT JOIN categorias ca2 ON ca1.categoria_father_id = ca2.idcategoria WHERE ca1.status != 0";
            $request = $this->selectAll($sql_categorias);
            return $request;
        }

        public function insertCategoria(string $titulo, string $imgPortada, string $iconoCtg, $fatherCategoria, int $status )
        {
            $return = "";
            $data_img = "";
            $data_icon = "";
            $this->strCategoria = $titulo;
            $this->strImgPortada = $imgPortada;
            $this->strIcono = $iconoCtg;
            $this->intCategoria = $fatherCategoria;
            $this->intStatus = $status;
            
            if ($this->strImgPortada == 'NULL') {
                $data_img = $this->strImgPortada;
            }else{
                $data_img = "'$this->strImgPortada'";
            }

            if ($this->strIcono == 'NULL') {
                $data_icon = $this->strIcono;
            }else{
                $data_icon = "'$this->strIcono'";
            }

            $sql_exists_categoria = "SELECT * FROM categorias WHERE nombre = '$this->strCategoria' AND categoria_father_id is null";

            $request = $this->selectAll($sql_exists_categoria);

            if(empty($request)){
                $sql_insert_categoria = "INSERT INTO categorias(nombre, imgCategoria, icon_category_father, categoria_father_id, status) VALUES('$this->strCategoria', $data_img, $data_icon, $this->intCategoria, $this->intStatus)";
                $request = $this->insert($sql_insert_categoria);
                $return = $request;
            }else{
                $return = "existe";
            }
            return $return;
        }

        public function selectCategoria(int $idcategoria)
        {
            $this->intIdCategoria = $idcategoria;
            
            $sql_select_categoria = "SELECT ca1.*, ca2.nombre AS fathercatname FROM categorias ca1 LEFT JOIN categorias ca2 ON ca1.categoria_father_id = ca2.idcategoria WHERE ca1.idcategoria = $this->intIdCategoria";
            $request = $this->select( $sql_select_categoria);
            return $request;
        }

        public function updateCategoria(int $idcategoria, string $titulo, string $imgPortada, string $iconoCtg, $fatherCategoria, int $status)
        {
            $this->intIdCategoria = $idcategoria;
            $this->strCategoria = $titulo;
            $this->strImgPortada = $imgPortada;
            $this->strIcono = $iconoCtg;
            $this->intCategoria = $fatherCategoria;
            $this->intStatus = $status;

            if ($this->strImgPortada == 'NULL') {
                $data_img = $this->strImgPortada;
            }else{
                $data_img = "'$this->strImgPortada'";
            }

            if ($this->strIcono == 'NULL') {
                $data_icon = $this->strIcono;
            }else{
                $data_icon = "'$this->strIcono'";
            }

            $sql_exists_categoria = "SELECT * FROM categorias WHERE nombre = '{$this-> strCategoria}' AND idcategoria != $this->intIdCategoria AND categoria_father_id is null";
            $request = $this->selectAll($sql_exists_categoria);

            if (empty($request)) {
                $sql_update_categoria = "UPDATE categorias SET nombre = '$this->strCategoria',  imgcategoria = $data_img, icon_category_father = $data_icon, categoria_father_id = $this->intCategoria, status = $this->intStatus WHERE idcategoria = $this->intIdCategoria";
                $request = $this->update($sql_update_categoria);
                
                if ($request) {
                    $childrensIds = array();
                    $recursiveData = self::recursiveChildren($this->intIdCategoria, $childrensIds);
                    $arrImplode = implode(',', $recursiveData);
                    $update_status = "UPDATE categorias set status = $this->intStatus WHERE idcategoria in ($arrImplode)";
                    $this->update($update_status);
                }
            }else{
                $request = 'existe';
            }
            return $request;
        }

        public function recursiveChildren($idFather, &$arrayIds)
        {
            $sql = "SELECT idcategoria FROM categorias WHERE categoria_father_id = $idFather";
            $request = $this->selectAll($sql);
            foreach ($request as $key => $value) {
                $idData = $value['idcategoria'];
                $arrayIds[] = $idData;
                self::recursiveChildren($idData, $arrayIds);
            }
            return $arrayIds;
        }

        public function deleteCategoria(int $idcategoria)
        {
            $this->intIdCategoria = $idcategoria;
            $sql_exists_productos = "SELECT * FROM productos WHERE categoriaid = $this->intIdCategoria";
            $request = $this->selectAll($sql_exists_productos);
            

            if (empty($request)) {
                $sql_update_status_categoria = "UPDATE categorias SET status = 0 WHERE idcategoria = $this->intIdCategoria";
                
                $request = $this->update($sql_update_status_categoria);

                if ($request) {
                    $request = "ok";
                }
                else{
                    $request = "error";
                }
            }else{
                $request = "productExist";
            }
            return $request;
        }
    }
    
?>
