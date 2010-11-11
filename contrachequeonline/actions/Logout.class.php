<?php
	session_start();
	class Logout{
		function __construct(){
			session_destroy();
			header("Location: ../admin.php");
		}
	}
	
	new Logout();
?>