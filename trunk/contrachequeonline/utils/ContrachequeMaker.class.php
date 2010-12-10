<?php /*@rot.fms#*/
	session_start();
	
	//include("fpdf16/fpdf.php");
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
			
			$temp1 	= explode("-",$this->date1);
			$temp2 	= explode("-",$this->date2);
			$diff 	= $this->dateCounterDiff($this->date1,$this->date2);
			if(!checkdate($temp1[1],$temp1[0],$temp1[2]) or !checkdate($temp2[1],$temp2[0],$temp2[2]) or ($diff > 1200) or ($diff < 0)){
				header("Location: ../index.php?date=false");
				die();
			}
			
			if(!$connect->start())
				echo("Impossible to star connection in Sigin.");
				
			$this->printCC($connect);
				
			//$connect->close();
		}
		
		function printCC($connect){
			$c = $this->dateCounterDiff($this->date1, $this->date2);
			$date = explode("-",$this->date1);
			
			echo('<table><tr><td><a href="../index.php">Clique aqui para gerar novos contracheques</a></td><td width="250"><p onclick="javascript: window.print();" align="center">Imprimir<br/><img src="../images/impressora.png" width="35" height="35" style="cursor:pointer";/></p></td><td><a href="../actions/Logout.class.php">Desconectar</a></td></tr></table><br/>');
			
			die($this->date1." ".$this->date2." ".$diff);
			
			for($x=0; $x < $c; $x++){
				if(!($result = $connect->execute("SELECT * FROM Calculos cl INNER JOIN Cadastros cd ON cl.matricula = cd.matricula INNER JOIN Lotacoes lo ON cd.lotacao = lo.lotacao INNER JOIN Cargos cg ON cd.cargo = cg.cargo INNER JOIN Pessoal ps	ON cd.matricula = ps.matricula INNER JOIN Eventos ev ON cl.eve_codigo = ev.codigo_eve WHERE cl.matricula = '".$_SESSION["user"]."' AND cl.data BETWEEN '".$date[2]."-".$date[1]."-01' and '".$date[2]."-".$date[1]."-31' ORDER BY cl.eve_codigo")))
					echo("Impossible to execute MySQL query.");
					
				if($connect->counterResult($result) < 1){
					if($date[1] == 12){
						$date[1] = "01";
						$date[2] += 1;
					}else{
						$date[1] += 1;
					}
					continue;
				}
				
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
				
				echo('<style type="text/css">
<!--
#table{
	border-top-style: ridge;
	border-right-style: ridge;
	border-bottom-style: ridge;
	border-left-style: ridge;
	border-top-width: medium;
	border-right-width: medium;
	border-bottom-width: medium;
	border-left-width: medium;
}
.style1 {font-family: Arial, Helvetica, sans-serif}
.style2 {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
	font-size: 14px;
}
.style3 {font-size: 12px}
.style4 {font-family: Georgia, "Times New Roman", Times, serif}
.style5 {font-size: 13px; font-family: Georgia, "Times New Roman", Times, serif; }
.style6 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
-->
</style>');
				// 595, 842
				echo('<table width="595" border="1" cellpadding="0" cellspacing="0" id="table">
  <tr>
    <td width="638" class="style1"><table width="586">
      <tr>
      <td width="73"><div align="center"><img src="../images/brasao_bw.png" width="59" height="71" /></div></td>
      <td width="375"><div align="center" class="style2">Prefeitura Municipal de Teresina<br />
    Secretaria Municipal de Administra&ccedil;&atilde;o</div></td><td width="122"><div align="right"><img src="../images/fms_logo_bw.png" width="121" height="35" /></div></td>
    </tr></table>
    </td>
  </tr>
  <tr>
    <td><div align="center"><br />
        <span class="style5">Divis&atilde;o de folha de Pagameto - Nucleo de Informatica<br />
        Espelho do Contra-cheque referente ao mes de '.$this->appDateMaker($date[0]."-".$date[1]."-".$date[2]).'</span></div></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
        <tr>
          <td width="43" class="style5"><div align="right" class="style3">Nome </div></td>
          <td width="10" class="style5"><div align="center" class="style3">:</div></td>
          <td colspan="3" class="style5"><span class="style3">'.$infos["nome"].'</span></td>
          <td width="62" class="style5"><div align="right" class="style3">Matr&iacute;cula:</div></td>
          <td width="125" class="style5"><span class="style3">'.$infos["matricula"].'</span></td>
        </tr>
        <tr>
          <td class="style5"><div align="right" class="style3">'.$infos["lotacao"].'</div></td>
          <td class="style5"><div align="center" class="style3">-</div></td>
          <td width="248" class="style5"><span class="style3">'.$infos["secretaria"].'</span></td>
          <td width="7" class="style5"><span class="style3">-</span></td>
          <td colspan="3" class="style5"><span class="style3">'.$infos["descricao_secretaria"].'</span></td>
        </tr>
        <tr>
          <td class="style5"><div align="right" class="style3">Cargo </div></td>
          <td class="style5"><div align="center" class="style3">:</div></td>
          <td colspan="3" class="style5"><span class="style3">'.$infos["descricao_cargo"].'</span></td>
          <td class="style5"><div align="right" class="style3">N&iacute;vel:</div></td>
          <td class="style5"><span class="style3">'.$infos["nivel"].'</span></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>');
	$h = 0;
	while($h<$z){
	echo('<table width="100%">
      <tr>
        <td width="12%" class="style4"><div align="right" class="style6">'.$infos[$h++].'</div></td>
        <td width="2%" class="style4"> <div align="center" class="style6">-</div></td>
        <td width="54%" class="style6">'.$infos[$h++].'</td>
        <td width="32%" class="style6">R$ '.$infos[$h++].'</td>
      </tr>
    </table>');
	}
	echo('</td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="63%" class="style6"><div align="right">Proventos:</div></td>
        <td width="37%" class="style6">R$ '.$infos["proventos"].'</td>
      </tr>
      <tr>
        <td class="style6"><div align="right">Descontos:</div></td>
        <td class="style6">R$ '.$infos["descontos"].'</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="63%" class="style6"><div align="right">L&iacute;quido:</div></td>
        <td width="37%" class="style6">R$ '.$infos["liquido"].'</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><div align="right"><br />
      <br />
      <br />
      <span class="style2">Gerado via WEB. </span></div></td>
  </tr>
</table><br><br>');
				
/*				echo("------------------------------------------------------------------------------------------------------<br>");
				echo("| Prefeitura Municipal de Teresina<br>");
				echo("| Secretaria Municipal de Administração<br>");
				echo("------------------------------------------------------------------------------------------------------<br>");
				echo("| Divisão de folha de Pagameto - Nucleo de Informatica<br>");
				echo("| Espelho do Contra-cheque referente ao mes de ".$this->appDateMaker($this->date1)."<br>");
				echo("------------------------------------------------------------------------------------------------------<br>");
				echo("| Nome: ".$infos["nome"]."   Matricula: ".$infos["matricula"]."<br>");
				echo("| ".$infos["lotacao"]." - ".$infos["secretaria"]." - ".$infos["descricao_secretaria"]."<br>");
				echo("| Cargo: ".$infos["descricao_cargo"]."     Nível: ".$infos["nivel"]."<br>");
				echo("------------------------------------------------------------------------------------------------------<br>");
				$h = 0;
				while($h<$z){
					echo("| ".$infos[$h++]." - ".$infos[$h++]."     ".$infos[$h++]."<br>");
				}
				echo("------------------------------------------------------------------------------------------------------<br>");
				echo("| Proventos: ".$infos["proventos"]."<br>");
				echo("| Descontos: ".$infos["descontos"]."<br>");
				echo("------------------------------------------------------------------------------------------------------<br>");
				echo("| Liquido: ".$infos["liquido"]."<br>");
				echo("------------------------------------------------------------------------------------------------------<br>");
				echo("|<br>");
				echo("|<br>");
				echo("------------------------------------------------------------------------------------------------------<br>");*/
/*				foreach($infos as $temp){
					echo("#".$temp."#<br>");
				}*/
				if($date[1] == 12){
					$date[1] = "01";
					$date[2] += 1;
				}else{
					$date[1] += 1;
				}
			}
		}
		
		function appDateMaker($d){
			$d = explode("-",$d);
			switch($d[1]){
				case 1 : 	return "JAN/".$d[2];
							break;
				case 2 : 	return "FEV/".$d[2];
							break;
				case 3 : 	return "MAR/".$d[2];
							break;
				case 4 : 	return "ABR/".$d[2];
							break;
				case 5 : 	return "MAI/".$d[2];
							break;
				case 6 : 	return "JUN/".$d[2];
							break;
				case 7 : 	return "JUL/".$d[2];
							break;
				case 8 : 	return "AGO/".$d[2];
							break;
				case 9 : 	return "SET/".$d[2];
							break;
				case 10 : 	return "OUT/".$d[2];
							break;
				case 11 : 	return "NOV/".$d[2];
							break;
				case 12 : 	return "DEZ/".$d[2];
							break;
							
				default : "ERRO";
			}
		}
		
		function dateCounterDiff($d1, $d2){
			$d1 = explode("-", $d1);
			$d2 = explode("-", $d2);
			
			return (int) (((($d2[2] - $d1[2]) * 12) + ($d2[1] - $d1[1])) + 1);
		}
	}
	
	new ContrachequeMaker();
?>
