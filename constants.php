<?php

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
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASSWORD", "");
    define("DB_NAME", "newproject");
    // define("DB_PORT", 3306);
    define("DB_CHARSET", "utf8");

    
    // DATA EMPRESA
    define("NAME_EMPRESA", "EMPRESA");

    // VARIABLES SEND EMAIL - PHP MAILER
    define("MAIL_HOST", "smtp.gmail.com");
    define("MAIL_USERNAME", "pruebaempresa95@gmail.com");
    define("MAIL_PASSWORD", "tzmjvdejuyimmwlb");

    // MODULES PERMISSIONS
    define("MDASHBOARD", 1);
    define("MUSUARIOS", 2);

?>