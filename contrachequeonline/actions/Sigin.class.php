<?php
	include_once("../beans/Variables.class.php");
	require_once("../utils/Connect.class.php");
		
	class Sigin{
		//Variables
		private $userName;
		private $password;
		private $password2;
		
		function __construct(){
		 	$variables = new Variables();
			$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);

			//receinving and striping the variables
			$this->userName = $connect->antiInjection(isset($_POST["tfUserName"]) ? $_POST["tfUserName"] : NULL);
			$this->password = $connect->antiInjection(isset($_POST["tfPassword"]) ? $_POST["tfPassword"] : NULL);
			$this->password2 = $connect->antiInjection(isset($_POST["tfPassword2"]) ? $_POST["tfPassword2"] : NULL);
			
			if($this->password != $this->password2){
				header("Location: ../importDocuments.php?sigin=false");
				die();
			}
			
			if(!$connect->start())
				echo("Impossible to star connection in Sigin.");
			
			//encoding to md5 hash
			$this->password = md5($this->password);
			
			if(!$connect->execute("INSERT INTO Administradores (usuario, senha) VALUES ('$this->userName', '$this->password')"))
				echo("Impossible to execute MySQL query.");
			
			if($connect->counterAffected() > 0){
				header("Location: ../importDocuments.php?sigin=true");
			}else{
				header("Location: ../importDocuments.php?sigin=false");
			}
			
			$connect->close();
			die();
		}
	}
	
	new Sigin();
?>