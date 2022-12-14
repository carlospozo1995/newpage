<?php

	class Controller_Logout{

		public function buildPage()
		{
			session_start();
          	session_unset();
          	session_destroy();

          	header('Location: '.BASE_URL.'login');
		}

	}

?>