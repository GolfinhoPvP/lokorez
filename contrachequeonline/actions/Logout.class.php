<?php
	class Logout{
		function __construct(){
			session_destroy();
			header("Location: ../admin.php");
		}
	}
	
	new Logout();
?>