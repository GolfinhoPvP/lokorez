<?php
	include_once("../beans/Variables.class.php");
	require_once("../utils/Connect.class.php");
	
	class Login{
		//Variables
		private string $userName;
		private string $password;
		
		function __construct(){
			$variables = new Variables();
			$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
			private $result;
			
			//receinving and striping the variables
			$userName 	= $connect->antiInjection(isset($_POST["tfUserName"]) ? $_POST["tfUserName"] : NULL);
			$password 	= $connect->antiInjection(isset($_POST["tfPassword"]) ? $_POST["tfPassword"] : NULL);
			if(!$connect->start())
				echo("Impossible to star connection in Sigin.");
			$result = $connect->execute("SELECT * FROM Administradores WHERE usuario = ".$userName." and senha = ".$password);
			$connect->close();
			if(counterResult($result) == 1){
				$_SESSION["usuario"] = $userName;
				$_SESSION["password"] = $password;
				header("Location: ../importDocuments.php");
				die();
			}			
		}
	} 
?>