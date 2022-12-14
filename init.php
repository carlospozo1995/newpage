<?php
	// FRONTEND->VIEW FILE
	spl_autoload_register(function ($nameClass)
	{	
		$nameFile = RUTA_FRONTEND . str_replace('_', '/', $nameClass) . '.php';
		if (file_exists($nameFile)) {
			// print_r($nameFile);
			require_once($nameFile);
		}
	}, false);


	//---------------------------------------------------


	// INCLUDE->VARIUS FILES
	spl_autoload_register(function ($nameClass)
	{	
		$nameFile = RUTA_INCLUDE . str_replace('_', '/', $nameClass) . '.php';
		if (file_exists($nameFile)) {
			require_once($nameFile);
		}
	}, false);

	$GLOBALS['db'] = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_CHARSET);
	$GLOBALS['db']->connectDb();

	$_SUBMIT = array_merge($_POST, $_GET);
?>