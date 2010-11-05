<?php
	session_start();
	
	include_once("../beans/Variables.class.php");
	require_once("../utils/Connect.class.php");
	
	class Login{
		//Variables
		private $userName;
		private $password;
		
		function __construct(){
			$variables = new Variables();
			$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
			$result;
			
			//receinving and striping the variables
			$this->userName = $connect->antiInjection(isset($_POST["tfUserName"]) ? $_POST["tfUserName"] : NULL);
			$this->password = $connect->antiInjection(isset($_POST["tfPassword"]) ? $_POST["tfPassword"] : NULL);
			if(!$connect->start())
				echo("Impossible to star connection in Sigin.");
			
			//encoding to md5 hash
			$this->password = md5($this->password);
			
			if(!($result = $connect->execute("SELECT * FROM Administradores WHERE usuario = '$this->userName' and senha = '$this->password'")))
				echo("Impossible to execute MySQL query.");
				
			$connect->close();
			
			if($connect->counterResult($result) > 0){
				$_SESSION["usuario"] 	= $this->userName;
				$_SESSION["senha"] 		= $this->password;
				header("Location: ../importDocuments.php");
				die();
			}
			
			header("Location: ../admin.php?login=false");
			die();
		}
	}
	
	new Login();
?>