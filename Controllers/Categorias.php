<?php

    
    class Categorias extends Controller {
            
        public function __construct()
        {
            sessionStart();
            parent::__construct();
            if (empty($_SESSION['login'])){
                header("Location: ".base_url()."login");
            }
            getPermisos(5);
        }

        public function categorias()
        {   
            if(empty($_SESSION['permisos'][5]['ver'])){
                header('Location: '.base_url().'sistema');
            }

            $data['page_tag'] = 'Categorias';
            $data['page_title'] = 'Empresa - Categorias';
            // $data['page_title'] = 'Créditos GUAMAN - Categorias';
            $data['page_name'] = 'Categorias';
            $data['page_functions_js'] = 'functions_categorias.js';
            $this->views->getView($this, "categorias", $data);
        }

        public function setCategoria()
        {
            if ($_POST) {
                if ($_POST['txtNombre'] == '' || $_POST['txtDescripcion'] == '' || $_POST['listStatus'] == '') {
                    $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos.');
                }else{
                    $intIdCategoria = intval($_POST['idCategoria']);
                    $strCategoria = strClean($_POST['txtNombre']);
                    $strDescripcion = strClean($_POST['txtDescripcion']);
                    $intStatus = intval($_POST['listStatus']);
                    $request_categoria = "";
                    
                    $foto = $_FILES['foto'];
                    $name_foto = $foto['name'];
                    $type = $foto['type'];
                    $url_temp = $foto['tmp_name'];
                    $imgPortada = 'imgCategoria.png';

                    if (!empty($name_foto)) {
                        $imgPortada = 'img_'.md5(date('d-m-Y H:m:s')).'.jpg';
                        // dep($imgPortada);
                    }
                    
                    if (empty($intIdCategoria)) {
                        $option = 1;
                        if($_SESSION['permisosMod']['crear']){
                            $request_categoria = $this->model->insertCategoria($strCategoria, $strDescripcion, $imgPortada, $intStatus);
                            if ($name_foto != '') {uploadImage($foto, $imgPortada);}
                        }
                    }
                    // else{
                        // $option=2;
                        // if($_SESSION['permisosMod']['actualizar']){
                        //     $request_categoria = $this->model->updateCategoria($intIdCategoria, $strCategoria, $strDescripcion, $intStatus, $imgPortada);
                        // }
                    // }
        
                    if ($request_categoria > 0) {
                        if ($option == 1) {
                            $arrResponse = array('status' => true, 'msg' => 'Datos ingresados correctamente.');
                        }
                        // else{
                        //     $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                        // }
                    }else if($request_categoria == "existe"){
                        $arrResponse = array('status' => false, 'msg' => 'La categoria a ingresar ya existe.');
                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'No se ha podido ingresar los datos.');
                    }  
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                die();
            }
        }

        public function getCategorias()
        {   
            if($_SESSION['permisosMod']['ver']){
                $arrCategorias = $this->model->selectCategorias();

                for ($i=0; $i < count($arrCategorias); $i++) { 
                    $btnViewCategoria = '';
                    $btnUpdateCategoria = '';
                    $btnDeleteCategoria = '';

                    if ($_SESSION['permisosMod']['ver']) {
                        $btnViewCategoria = '<button type="button" class=" btnViewCategory btn btn-secondary btn-sm" onclick="viewCategoria('.$arrCategorias[$i]['idcategoria'].')" tilte="Ver"><i class="fas fa-eye"></i></button>';
                    }
                    if (!empty($_SESSION['permisosMod']['actualizar']) && $_SESSION['idUser'] == 1) {
                        $btnUpdateCategoria = '<button type="button" class="btnEditCategoria btn btn-primary btn-sm" onclick="editCategoria('.$arrCategorias[$i]['idcategoria'].')" tilte="Editar"><i class="fas fa-pencil-alt"></i></button>';
                    }
                    if (!empty($_SESSION['permisosMod']['eliminar']) && $_SESSION['idUser'] == 1){
                        $btnDeleteCategoria = ' <button type="button" class="btnDeleteCategoria btn btn-danger btn-sm" onclick="deleteCategoria('.$arrCategorias[$i]['idcategoria'].')" tilte="Eliminar"><i class="fas fa-trash"></i></button>';
                    }

                    if ($arrCategorias[$i]['status'] == 1) {
                        $arrCategorias[$i]['status'] = '<div class="text-center"><span class="bg-success p-1 rounded"><i class="fas fa-user"></i> Activo</span></div>';
                    }else{
                        $arrCategorias[$i]['status'] = '<div class="text-center"><span class="bg-danger p-1 rounded"><i class="fas fa-user-slash"></i> Inactivo</span></div>';
                    }

                    // BTN PERMISOS DELETE EDIT
                    $arrCategorias[$i]['actions']=   '<div class="text-center">'.$btnViewCategoria.' '.$btnUpdateCategoria.' '.$btnDeleteCategoria.'</div>' ;
                }
                echo json_encode($arrCategorias, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function viewCategoria($idCategoria)
        {   
            if($_SESSION['permisosMod']['ver']){
                $idcategoria = intval($idCategoria);
                if ($idcategoria > 0) {
                    $arrCategoria = $this->model->selectCategoria($idCategoria);
                    if (empty($arrCategoria)) {
                        $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                    }else{
                        $arrResponse = array('status' => true, 'data' => $arrCategoria);
                    }
                    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }

    }   

?>