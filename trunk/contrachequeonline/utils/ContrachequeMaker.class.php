<?php /*@rot.fms#*/
	session_start();
	
	//include("fpdf16/fpdf.php");
	include_once("../beans/Variables.class.php");
	require_once("Connect.class.php");
	
	class ContrachequeMaker{
		private $date1;
		private $date2;
		private $month1;
		private $month2;
		private $xkey = "fmsfmsfms";
		
		function __construct(){
			ini_set('memory_limit','32M');
			$variables = new Variables();
			$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
			$result;
						
			$this->date1 = $connect->antiInjection(isset($_POST["tfDate1"]) ? $_POST["tfDate1"] : NULL);
			$this->date2 = $connect->antiInjection(isset($_POST["tfDate2"]) ? $_POST["tfDate2"] : NULL);
			$this->month1 = $connect->antiInjection(isset($_POST["slDate1"]) ? $_POST["slDate1"] : NULL);
			$this->month2 = $connect->antiInjection(isset($_POST["slDate2"]) ? $_POST["slDate2"] : NULL);
			
			$this->date1 = "01-".$this->month1."-".$this->date1;
			$this->date2 = "31-".$this->month2."-".$this->date2;
			
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
			
			echo('<table><tr><td><a href="../index.php">Clique aqui para gerar novos contracheques</a></td><td width="250"><p onclick="javascript: window.print();" align="center">Imprimir<br/><img src="../images/impressora.png" width="35" height="35" style="cursor:pointer";/></p></td><td><a href="../actions/Logout.class.php">Desconectar<img src="../images/desconectar.png" width="36" height="36" /></a></td></tr></table><br/>');
			
			$cont = 0;
			
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
				}else{
					$cont++;
				}
				
				$row = mysql_fetch_array($result);
				$infos["x"] 					= "***";
				$infos["nome"] 					= zkl($this->xkey, $row["nome"]);
				$infos["matricula"] 			= zkl($this->xkey, $row["matricula"]);
				$infos["lotacao"] 				= $row["lotacao"];
				$infos["descricao_secretaria"] 	= zkl($this->xkey, $row["descricao_lotacao"]);
				$infos["descricao_cargo"] 		= zkl($this->xkey, $row["descricao_cargo"]);
				$infos["nivel"] 				= $row["nivel"];
				$infos["CPF"] 					= zkl($this->xkey, $row["CPF"]);
				$infos["PIS_PASEP"] 			= zkl($this->xkey, $row["PIS_PASEP"]);
				$infos["data_nascimento"] 		= $row["data_nascimento"];
				$infos["data_admissao"] 		= $row["data_admissao"];
				$infos["dp_sal_fan"] 			= $row["dp_sal_fan"];
				$infos["dep_imp_re"] 			= $row["dep_imp_re"];
				$infos["proventos"] 			= 0;
				$infos["descontos"] 			= 0;
				$infos["liquido"] 				= 0;
				$infos[0]		 				= $row["eve_codigo"];
				$infos[1]		 				= zkl($this->xkey, $row["descricao_evento"]);
				$infos[2]		 				= $row["valor"];
				$today = getdate();
				$infos["date"] = $today["mday"]."/".$today["mon"]."/".$today["year"];
				
				$z = 3;
				$loop = 1;
				while($row = mysql_fetch_array($result)){
					$infos[$z++] = $row["eve_codigo"];
					$infos[$z++] = zkl($this->xkey, $row["descricao_evento"]);
					$infos[$z++] = $row["valor"];
					$loop++;
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
				
				$contP = $contD = $m = 0;
				for($y=0; $y<$loop; $y++){
					if($infos[$m] < 500){
						$contP++;
					}else{
						$contD++;
					}
					$m += 3;
				}
				
				
				if($contP > $contD){
					$loop = $contP + 1;
				}else if($contD > $contP){
					$loop = $contD + 1;
				}else{
					$loop = $contD + 1;
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
.style2 {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
	font-size: 14px;
}
.words3 {
	font-size: 9px;
	font-family: Georgia, "Times New Roman", Times, serif;
}
-->
</style>');
				// 595, 842
				echo('<table width="595" border="1" cellpadding="0" cellspacing="0" id="table">
  <tr>
    <td width="638" class="style1"><table width="586">
      <tr>
      <td width="73"><div align="center"><img src="../images/brasao_bw.png" width="59" height="71" /></div></td>
      <td width="375"><div align="center" class="style2">Prefeitura Municipal de Teresina<br />
    Secretaria Municipal de Administra&ccedil;&atilde;o<br />
      </div>
        <span class="style6"><br />
        <span class="words3">EMITIDO: '.$infos["date"].'</span></span></td>
      <td width="122"><div align="right"><img src="../images/fms_logo_bw.png" width="121" height="35" /></div></td>
    </tr></table>
    </td>
  </tr>
  <tr>
    <td><div align="right" class="style2">CONTRACHEQUE
    </div>
      <table width="100%" border="1" cellpadding="0" cellspacing="0" class="words3">
      <tr>
        <td width="8%" >EMPRESA<br />
FMSA</td>
        <td width="13%">MATR&Iacute;CULA<br />
'.$infos['matricula'].'</td>
        <td width="79%">NOME<br />
'.$infos['nome'].'</td>
      </tr>
    </table>
      <table width="100%" border="1" cellpadding="0" cellspacing="0" class="words3">
        <tr>
          <td width="57%">CARGO<br />
          '.$infos['descricao_cargo'].'</td>
          <td width="43%">LOTA&ccedil;&Atilde;O<br />
          '.$infos['descricao_secretaria'].'</td>
        </tr>
      </table>
      <table width="100%" border="1" cellpadding="0" cellspacing="0" class="words3">
        <tr>
          <td width="8%">N&Iacute;VEL<br />
          '.$infos['nivel'].'</td>
          <td width="30%">CPF<br />
          '.$infos['CPF'].'</td>
          <td width="26%">PIS/PASEP<br />
          '.$infos['PIS_PASEP'].'.</td>
          <td width="18%">ADMISS&Atilde;O<br />
          '.$infos['data_admissao'].'</td>
          <td width="18%">NASCIMENTO<br />
          '.$infos['data_nascimento'].'</td>
        </tr>
      </table>
      <table width="100%" border="1" cellpadding="0" cellspacing="0" class="words3">
        <tr>
          <td width="6%">DP SF<br />
          '.$infos['dp_sal_fan'].'.</td>
          <td width="6%">DP IR<br />
          '.$infos['dep_imp_re'].'.</td>
          <td width="7%">BANCO<br />
          '.$infos['x'].'</td>
          <td width="11%">AG&Ecirc;NCIA<br />
          '.$infos['x'].'</td>
          <td width="12%">OPERA&ccedil;&Atilde;O<br />
          '.$infos['x'].'</td>
          <td width="27%">CONTA CORRENTE<br />
          '.$infos['x'].'</td>
          <td width="31%">REFER&Ecirc;NCIA PAGAMENTO<br />
          '.$this->appDateMaker($date[0]."-".$date[1]."-".$date[2]).'</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="words3">
          <tr>
            <td width="16%">C&Oacute;DIGO</td>
            <td width="61%">DESCRIMINA&Ccedil;&Atilde;O</td>
            <td width="23%">VALOR EM R$ </td>
          </tr>
        </table>');
		$h = 0;
		for($y=0; $y<$loop; $y++){
			if(($y % 2) == 0){
				echo('<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="words3">');
			 }else{
			 echo('<table width="100%" border="0" cellpadding="0" cellspacing="0" class="words3">');
			 }
			 if($y >= $contP){
			 	echo('<tr><td width="16%">&nbsp;</td>
				<td width="61%">&nbsp;</td>
				<td width="23%">&nbsp;</td>
			  </tr>
			</table>');
			 }else{
			 	echo('<td width="16%">'.$infos[$h++].'</td>
				<td width="61%">'.$infos[$h++].'</td>
				<td width="23%" align="right">'.$this->formatValue($infos[$h++]).'</td>
			  </tr>
			</table>');
			}
		}
		echo('</td>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="words3">
          <tr>
            <td width="16%">C&Oacute;DIGO</td>
            <td width="61%">DESCRIMINA&Ccedil;&Atilde;O</td>
            <td width="23%">VALOR EM R$ </td>
          </tr>
        </table>');
		for($y=0; $y<$loop; $y++){
			if(($y % 2) == 0){
				echo('<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="words3">');
			 }else{
			 echo('<table width="100%" border="0" cellpadding="0" cellspacing="0" class="words3">');
			 }
			 if($y >= $contD){
			 	echo('<tr><td width="16%">&nbsp;</td>
				<td width="61%">&nbsp;</td>
				<td width="23%">&nbsp;</td>
			  </tr>
			</table>');
			 }else{
			 	echo('<td width="16%">'.$infos[$h++].'</td>
				<td width="61%">'.$infos[$h++].'</td>
				<td width="23%" align="right">'.$this->formatValue($infos[$h++]).'</td>
			  </tr>
			</table>');
			}
		}
		echo('</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  class="words3">&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0"  class="words3">
      <tr>
        <td>PROVENTOS<br />
          R$ '.$this->formatValue($infos['proventos']).'</td>
        <td>DESCONTOS<br />
          R$ '.$this->formatValue($infos['descontos']).'</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0"  class="words3">
      <tr>
        <td width="63%"><div align="right">L&Iacute;QUIDO:</div></td>
        <td width="37%">R$ '.$this->formatValue($infos['liquido']).'</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><div align="right"><br />
      <br />
      <br />
      <span class="style2">Gerado via WEB. </span></div></td>
  </tr>
</table></br></br>');
				if($date[1] == 12){
					$date[1] = "01";
					$date[2] += 1;
				}else{
					$date[1] += 1;
				}
			}
			
			if($cont == 0){
				header("Location: ../index.php?found=false");
				die();
			}
		}
		
		function formatValue($v){
			if(strlen($v) == 0){
				return $v;
			}
			$pos = strpos($v, ".");
			if($pos === false){
				return $v.",00";
			}else{
				$temp = explode(".",$v);
				if(strlen($temp[1]) == 1){
					$temp[1] .= "0";
				}
				return $temp[0].",".$temp[1];
			}
			return $v;
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
