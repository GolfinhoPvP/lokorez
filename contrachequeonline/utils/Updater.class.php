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
			
			//seting up the matrix of datas
			for($x=0; $x<$numRows; $x++){
				for($y=0; $y<$numFields; $y++){
					$str = "tf$x$y";
					eval("\$aux = \"$$str\";");
					$DB[$x][$y] = $aux;
				}
			}
			
			//by security, it conts the amount of rows to update
			$loopForUpdate = 0;
			for($x=0; $x<$numRows; $x++){
				if($DB[$x][0] == NULL)
					continue;
				$loopForUpdate++;
			}
			
			//starting the data base
			$variables = new Variables();
			$MySQLconnect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
			
			//it conts the amount of rows it was updated
			$uptCont = 0;
			if(!$MySQLconnect->start())
				echo("Impossible to star connection in Handler.");
			
			for($x=0; $x<$numRows; $x++){
				if($DB[$x][0] == NULL)
					continue;
				switch($tableId){
					case "dcr" : 	$aux = "UPDATE Cargos SET descricao = '".$DB[$x][1]."', tipo='".$DB[$x][2]."', vencimento=".$DB[$x][3]." WHERE cargo='".$DB[$x][0]."'";
									break;
									
					case "dlt" : $aux = "UPDATE Lotacoes SET descricao = '".$this->DB[$x][1]."', secretaria = '".$this->DB[$x][2]."' WHERE lotacao='".$this->DB[$x][0]."'";
								break;
								
					case "especial" : $aux = "UPDATE Especialidades SET descricao = '".$this->DB[$x][1]."', cargo = '".$this->DB[$x][2]."' WHERE codigo='".$this->DB[$x][0]."'";
								break;
								
					case "eventos" : $aux = "UPDATE Eventos SET descricao='".$this->DB[$x][1]."', IRRF='".$this->DB[$x][2]."', IPMT='".$this->DB[$x][3]."', FAL='".$this->DB[$x][4]."', FIXO='".$this->DB[$x][5]."', TEMP='".$this->DB[$x][6]."', valor=".$this->DB[$x][7].", GRAT='".$this->DB[$x][8]."', FGTS='".$this->DB[$x][9]."', desconto=".$this->DB[$x][10].", nivel='".$this->DB[$x][11]."', INSS='".$this->DB[$x][12]."' WHERE codigo='".$this->DB[$x][0]."'";
								break;
				}
				if($MySQLconnect->execute($aux))
					$uptCont++;
			}
			
			$MySQLconnect->close();
			
			if($uptCont == $loopForUpdate)
				header("Location: ../importDocuments.php?upl=true&tab=$tableId");
			else
				header("Location: ../importDocuments.php?upl=false&tab=$tableId");
				
		}
	}
	
	new Updater();
?>