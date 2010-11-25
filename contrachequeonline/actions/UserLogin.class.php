<?php
	session_start();
	
	include_once("../beans/Variables.class.php");
	require_once("../utils/Connect.class.php");
	
	class UserLogin{
		//Variables
		private $userMatricula;
		private $password;
		private $select;
		
		function __construct(){
			$variables = new Variables();
			$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
			$result;
			
			//receinving and striping the variables
			$this->userMatricula = $connect->antiInjection(isset($_POST["tfMatricula"]) ? $_POST["tfMatricula"] : NULL);
			$this->password = $connect->antiInjection(isset($_POST["tfPassword"]) ? $_POST["tfPassword"] : NULL);
			$this->select = $connect->antiInjection(isset($_POST["slSelect"]) ? $_POST["slSelect"] : NULL);
			if(!$connect->start())
				echo("Impossible to star connection in Sigin.");
			
			//encoding to md5 hash
			$this->password = base64_encode($this->password);
			
			if(!($result = $connect->execute("SELECT * FROM Cadastros c INNER JOIN Folhas f ON c.codigo_fol = f.codigo_fol WHERE c.matricula = '$this->userMatricula' AND c.senha = '$this->password' AND f.descricao = '$this->select'")))
				echo("Impossible to execute MySQL query.");
		
			if($connect->counterResult($result) > 0){
				$result = $connect->execute("SELECT * FROM Pessoal WHERE matricula = '$this->userMatricula'");
				$row = mysql_fetch_assoc($result);
				$_SESSION["user"] 		= $this->userMatricula;
				$_SESSION["userPass"] 	= $this->password;
				$_SESSION["nome"] 		= $row["nome"];
				$connect->close();
				header("Location: ../index.php?ok=true");
				die();
			}
			
			$connect->close();
			
			header("Location: ../index.php?ok=false");
			die();
		}
	}
	
	new UserLogin();
?>