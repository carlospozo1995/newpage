<?php

	class Controller_Logout{

		public function buildPage()
		{
			session_start();
			$session_shopping = $_SESSION['dataCart'];
          	session_unset();
          	// session_destroy();
          	$_SESSION['dataCart'] = $session_shopping;
          	header('Location: '.BASE_URL.'login');
		}

	}

?>