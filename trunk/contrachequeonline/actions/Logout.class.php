<?php
	session_start();
	class Logout{
		function __construct(){
			if(isset($_SESSION["path"])){
				rmdir("../uploads/".$_SESSION["path"]);
			}
			session_destroy();
			header("Location: ../index.php");
		}
	}
	
	new Logout();
?>