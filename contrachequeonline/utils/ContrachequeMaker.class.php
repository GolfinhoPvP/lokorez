<?php
	session_start();
	
	include("fpdf16/fpdf.php");
	include_once("../beans/Variables.class.php");
	require_once("Connect.class.php");
	
	class ContrachequeMaker{
		private $date1;
		private $date2;
		function __construct(){
			$variables = new Variables();
			$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
			$result;
			
			$this->date1 = $connect->antiInjection(isset($_POST["tfDate1"]) ? $_POST["tfDate1"] : NULL);
			$this->date2 = $connect->antiInjection(isset($_POST["tfDate2"]) ? $_POST["tfDate2"] : NULL);
			
			if(!$connect->start())
				echo("Impossible to star connection in Sigin.");
				
			$this->printCC($connect);
				
			$connect->close();
		}
		
		function printCC($connect){
			$c = $this->dateCounterDiff($this->date1, $this->date2);
			$date = explode("-",$this->date1);
			for($x=0; $x < $c; $x++){
				if(!($result = $connect->execute("SELECT * FROM Calculos cl INNER JOIN Cadastros cd ON cl.matricula = cd.matricula INNER JOIN Lotacoes lo ON cd.lotacao = lo.lotacao INNER JOIN Cargos cg ON cd.cargo = cg.cargo INNER JOIN Pessoal ps	ON cd.matricula = ps.matricula INNER JOIN Eventos ev ON cl.eve_codigo = ev.codigo_eve WHERE cl.matricula = '".$_SESSION["user"]."' AND cl.data BETWEEN '".$date[2]."-".$date[1]."-01' and '".$date[2]."-".$date[1]."-31'")))
					echo("Impossible to execute MySQL query.");
				
				$row = mysql_fetch_array($result);
				$infos["nome"] 					= $row["nome"];
				$infos["matricula"] 			= $row["matricula"];
				$infos["lotacao"] 				= $row["lotacao"];
				$infos["secretaria"] 			= $row["secretaria"];
				$infos["descricao_secretaria"] 	= $row["descricao_lotacao"];
				$infos["descricao_cargo"] 		= $row["descricao_cargo"];
				$infos["nivel"] 				= $row["nivel"];
				$infos["proventos"] 			= 0;
				$infos["descontos"] 			= 0;
				$infos["liquido"] 				= 0;
				$infos[0]		 				= $row["eve_codigo"];
				$infos[1]		 				= $row["descricao_evento"];
				$infos[2]		 				= $row["valor"];
				
				$z = 3;
				while($row = mysql_fetch_array($result)){
					$infos[$z++] = $row["eve_codigo"];
					$infos[$z++] = $row["descricao_evento"];
					$infos[$z++] = $row["valor"];
				}
				
				$w = 0;
				for($y=0; $y<(($z+1)/3); $y++){
					if($infos[$w+($y*2)] < 500){
						$infos["proventos"] += $infos[$w+($y*2)+2];
					}else{
						$infos["descontos"] += $infos[$w+($y*2)+2];
					}
					$w++;
				}
				
				$infos["liquido"] = $infos["proventos"] - $infos["descontos"];
				
				foreach($infos as $temp){
					echo("#".$temp."#<br>");
				}
				
				if(strcmp($date[1],"12")){
					$date[1] = "01";
					$date[2] += 1;
				}
			}
		}
		
		function dateCounterDiff($d1, $d2){
			$d1 = explode("-", $d1);
			$d2 = explode("-", $d2);
			
			return (((($d2[2] - $d1[2]) * 12) + ($d2[1] - $d1[1])) + 1);
		}
	}
	
	new ContrachequeMaker();
?>
