<?php
	session_start();
	
	if((isset($_SESSION["usuario"]) == NULL) && (isset($_SESSION["senha"]) == NULL)){
		header("Location: admin.php");
		die();
	}
	
	include_once("beans/Variables.class.php");
	require_once("utils/Connect.class.php");
	
	class Show{
		//Variables
		
		function __construct(){
			$variables = new Variables();
			$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
			$result;
			
			if(!$connect->start())
				echo("Impossible to star connection in Sigin.");
			
			if(!($result = $connect->execute("SELECT matricula, senha, codigo_fol FROM Cadastros ORDER BY matricula")))
				echo("Impossible to execute MySQL query.");
			
			while ($row = mysql_fetch_array($result)){
			   echo("Matricula: ".$row["matricula"].", senha: ".base64_decode($row["senha"]).", folha: ".$row["codigo_fol"]."<br/>");
			}
			
			//$connect->close();
		}
	}
	
	new Show();
?>