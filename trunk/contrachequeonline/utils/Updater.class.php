<?php
	include_once("../beans/Variables.class.php");
	require_once("Connect.class.php");
	
	class Updater{
	
		function __construct(){
			foreach($_POST as $fieldName => $value){
   				$comand = "\$".$fieldName."='".$value."';";
   				eval($comand);
			}
			
			$DB;
			
			for($x=0; $x<$numRows; $x++){
				for($y=0; $y<$numFields; $y++){
					$str = "tf$x$y";
					eval("\$aux = \"$$str\";");
					$DB[$x][$y] = $aux;
				}
			}
			$loopForUpdate = 0;
			for($x=0; $x<$numRows; $x++){
				if($DB[$x][0] == NULL)
					continue;
				$loopForUpdate++;
			}
			
			$variables = new Variables();
			$MySQLconnect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
			$uptCont = 0;
			if(!$MySQLconnect->start())
				echo("Impossible to star connection in Handler.");
			
			for($x=0; $x<$loopForUpdate; $x++){
				switch($tableId){
					case "dcr" : 	$aux = "UPDATE INTO Cargos SET descricao = '".$tDB[$x][1]."', tipo='".$DB[$x][2]."', vencimento=".$DB[$x][3]." WHERE codigo='".$DB[$x][0]."'";
									break;
				}
				if($MySQLconnect->execute($aux))
					$uptCont++;
			}
			
			$MySQLconnect->close();
			
			echo($uptCont." - ".$loopForUpdate);
			die();
			if($uptCont == $loopForUpdate)
				header("Location: ../importDocuments.php?upl=true");
			else
				header("Location: ../importDocuments.php?upl=false");
				
		}
	}
	
	new Updater();
?>