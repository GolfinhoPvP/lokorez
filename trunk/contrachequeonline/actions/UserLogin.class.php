<?php
	session_start();
	
	include_once("../beans/Variables.class.php");
	require_once("../utils/Connect.class.php");
	
	class UserLogin{
		//Variables
		private $userMatricula;
		private $password;
		
		function __construct(){
			$variables = new Variables();
			$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
			$result;
			
			//receinving and striping the variables
			$this->userMatricula = $connect->antiInjection(isset($_POST["tfMatricula"]) ? $_POST["tfMatricula"] : NULL);
			$this->password = $connect->antiInjection(isset($_POST["tfPassword"]) ? $_POST["tfPassword"] : NULL);
			if(!$connect->start())
				echo("Impossible to star connection in Sigin.");
			
			//encoding to md5 hash
			$this->password = base64_encode($this->password);
			
			if(!($result = $connect->execute("SELECT * FROM Cadastros WHERE matricula = '$this->userMatricula' and senha = '$this->password'")))
				echo("Impossible to execute MySQL query.");
			
			if($connect->counterResult($result) > 0){
				$_SESSION["user"] 		= $this->userMatricula;
				$_SESSION["userPass"] 	= $this->password;
				$connect->close();
				header("Location: ../user.php?ok=true");
				die();
			}
			
			$connect->close();
			
			header("Location: ../user.php?ok=false");
			die();
		}
	}
	
	new UserLogin();
?>