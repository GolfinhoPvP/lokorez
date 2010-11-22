<?php
	session_start();
	class Logout{
		function __construct(){
			session_destroy();
			header("Location: ../index.php");
		}
	}
	
	new Logout();
?>