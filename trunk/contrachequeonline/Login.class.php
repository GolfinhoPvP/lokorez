<?php
	include("variables.php");
	
	class Login{
		//Variables
		private $userName;
		private $password;
		
		function __construct(){
			$userName 	= isset($_POST["tfUserName"]) ? $_POST["tfUserName"] : NULL;
			$password 	= isset($_POST["tfPassword"]) ? $_POST["tfPassword"] : NULL;
			$connection = new Connect();
		}
		
		function private (){
		}
		
		function private antiInjection($param){
			$param = strip_tags($param); //  retirar as tags html
			$param = mysql_escape_string($param); //Retirar todas tags referentes do mysql ex: select, insert, update drop etc...
			return $param;
		}
	} 
?>