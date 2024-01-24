<?php

    require __DIR__ . '/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();


	define("BASE_URL", "http://localhost/carlos/page/");
	define("URL_LOCAL", "C:/laragon/www/carlos/page/");
	define("RUTA_FRONTEND", URL_LOCAL."frontend/");
	define("RUTA_INCLUDE", URL_LOCAL."include/");
	define("RUTA_VIEW", URL_LOCAL."frontend/Views/");
	define("MEDIA", BASE_URL."Assets/");
	define("MEDIA_ADMIN", BASE_URL."Assets/admin/");
	define("MEDIA_STORE", BASE_URL."Assets/store/");
	define("TIMEZONE","America/Guayaquil");
	define("KEY_ENCRIPTAR","carlos1995101010");

	// VARIABLES A CONEXION BD
    define("DB_HOST", $_ENV['HOST']);
    define("DB_USER", $_ENV['USER']);
    define("DB_PASSWORD", $_ENV['PASSWORD']);
    define("DB_NAME", $_ENV['DATABASE']);
    // define("DB_PORT", 3306);
    define("DB_CHARSET", $_ENV['CHARSET']);

    
    // DATA EMPRESA
    define("NAME_EMPRESA", "EMPRESA");

    // VARIABLES SEND EMAIL - PHP MAILER
    define("MAIL_HOST", $_ENV['MAIL_HOST']);
    define("MAIL_USERNAME", $_ENV['MAIL_USER']);
    define("MAIL_PASSWORD", $_ENV['MAIL_PASSWORD']);

    // MODULES PERMISSIONS
    define("MDASHBOARD", 1);
    define("MUSUARIOS", 2);
    define("MCATEGORIAS", 3);
    define("MPRODUCTOS", 4);
    define("MBANNERS", 5);
    define("MPEDIDOS", 6);

    // DECIMAL AND THOUSAND DELIMITERS
    define("SPD", ",");
    define("SPM", ".");

    // CURRENCY SYMBOL
    define("SMONEY", "$");

?>