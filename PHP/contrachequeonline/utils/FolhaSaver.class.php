<?php
	include_once("../beans/Variables.class.php");
	require_once("Connect.class.php");
		
	class FolhaSaver{
		//Variables
		private $name;
		private $description;
		
		function __construct(){
		 	$variables = new Variables();
			$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);

			//receinving and striping the variables
			$this->name = $connect->antiInjection(isset($_POST["tfNome"]) ? $_POST["tfNome"] : NULL);
			$this->description = $connect->antiInjection(isset($_POST["tdDescricao"]) ? $_POST["tdDescricao"] : NULL);
			
			if(strlen($this->name) == 0){
				header("Location: ../importDocuments.php?upl=false&tab=folha");
				die();
			}
			
			if(!$connect->start())
				echo("Impossible to star connection in Sigin.");
			
			if(!$connect->execute("INSERT INTO Folhas (nome, descricao) VALUES ('$this->name', '$this->description')"))
				echo("Impossible to execute MySQL query.");
			
			if($connect->counterAffected() > 0){
				header("Location: ../importDocuments.php?upl=true&tab=folha");
			}else{
				header("Location: ../importDocuments.php?upl=false&tab=folha");
			}
			
			$connect->close();
			die();
		}
	}
	
	new FolhaSaver();
?>