<?php

	require_once 'constants.php';
	require_once 'init.php';

	showPage();

	function showPage(){
		$page = Utils::getParam('show', '');
		$name_controller = getController($page);
		$class = 'Controller_' . $name_controller;

		if (class_exists($class)) {
		 	$controller = new $class;
		 	return $controller->buildPage();
		}
	}

	function getController($name){
		switch ($name) {
			case 'index':
				return "Index";
			break;

			case 'login':
				return "Login";
			break;

			case 'resetPassword':
				return "ResetPassword";
			break;

			case 'logout':
				return "Logout";
			break;

			case 'dashboard':
				return "Dashboard";
			break;

			case 'roles':
				return "Roles";
			break;

			case 'permissions':
				return "Permissions";
			break;

			case 'users':
				return "Users";
			break;

			case 'categories':
				return "Categories";
			break;

			case 'products':
				return "Products";
			break;

			case 'banners':
				return "Banners";
			break;

			// PAGES-STORE
			case 'test':
				return "Test";
			break;

			case 'categoria':
				return "Categoria";
			break;

			case 'producto':
				return "Producto";
			break;

			case 'carrito':
				return "Carrito";
			break;

			case 'resultado':
				return "Resultado";
			break;

			case 'confirmarcompra':
				return "Confirmarcompra";
			break;

			case 'cancelacion':
				return "Cancelacion";
			break;

			case 'confirmarpedido':
				return "Confirmarpedido";
			break;
		}

		return ucfirst($name);
	}

?>