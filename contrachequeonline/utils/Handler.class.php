<?php
	include_once("../beans/Variables.class.php");
	require_once("Connect.class.php");
	
	class Handler{
		private $path;
		private $tableId;
		private $DB;
		private $folhaType;
		
		function __construct($t, $path, $ft){
			$this->path = $path;
			$this->tableId = $t;
			$this->folhaType = $ft;
			$this->execute();
		}
		
		function execute(){
			$toFix = false;
			$archiveDBFname = $this->path;
			
			$variables = new Variables();
			$MySQLconnect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
			
			if(!($DFBconnect = dbase_open($archiveDBFname,0))) //only reading
				return false; //Connection to DBF error
				
			//get number of rows of dbf table
			$numRows = dbase_numrecords($DFBconnect);
			//get number of files of dbf table
			$numFields = dbase_numfields($DFBconnect);
			
			//the DBF registers begins with 1
			for($x=1; $x<=$numRows; $x++){
				$DBFrow = dbase_get_record($DFBconnect, $x); //Get DBF archive rows
				$this->DB[$x-1] = $DBFrow;
			}
			
			if(!$MySQLconnect->start())
				echo("Impossible to star connection in Handler.");
			
			if(strlen($this->folhaType) > 0){
				$row = mysql_fetch_assoc($MySQLconnect->execute("SELECT codigo_fol FROM Folhas where nome='$this->folhaType'"));
				$code = $row["codigo_fol"];
			}
			
			for($x=0; $x<$numRows; $x++){
			
				switch($this->tableId){
					case "dcr" : $aux = array("INSERT INTO Cargos (cargo, descricao_cargo , tipo, vencimento) VALUES ('".$this->DB[$x][0]."', '".$this->DB[$x][1]."', '".$this->DB[$x][2]."', ".$this->DB[$x][3].")");
								break;
								
					case "dlt" : $aux = array("INSERT INTO Lotacoes (lotacao, descricao_lotacao , secretaria) VALUES ('".$this->DB[$x][0]."', '".$this->DB[$x][1]."', '".$this->DB[$x][2]."')");
								break;
								
					case "especial" : $aux = array("INSERT INTO Especialidades (codigo_esp, descricao_especialidade , cargo) VALUES ('".$this->DB[$x][0]."', '".$this->DB[$x][1]."', '".$this->DB[$x][2]."')");
								break;
								
					case "eventos" : $aux = array("INSERT INTO Eventos (codigo_eve, descricao_evento, IRRF, IPMT, FAL, FIXO, TEMP, valor_eve, GRAT, FGTS, desconto, nivel_eve, INSS) VALUES ('".$this->DB[$x][0]."', '".$this->DB[$x][1]."',  '".$this->DB[$x][2]."',  '".$this->DB[$x][3]."',  '".$this->DB[$x][4]."',  '".$this->DB[$x][5]."',  '".$this->DB[$x][6]."',  ".$this->DB[$x][7].",  '".$this->DB[$x][8]."',  '".$this->DB[$x][9]."',  ".$this->DB[$x][10].", '".$this->DB[$x][11]."', '".$this->DB[$x][12]."')");
								break;
								
					case "cadastro" :	$aux = array("INSERT INTO Cadastros (matricula, cargo, lotacao, data_admissao, vinculo, previdencia, nivel, dep_imp_re, hora_sem, instrucao, data_afastamento, sindical, dp_sal_fam, hora_ponto, vale_transporte, data_promocao, tipo, situacao, descontar, receber, funcao, maior_360, prof_40h, vlt_ver, val_niv, data_FGTS, permanente, remuneracao_bruto, vencimento, flag, entrada, liquido, sobregrat, assistencia, medico, senha, codigo_fol) VALUES ('".$this->DB[$x][0]."', '".$this->DB[$x][8]."', '".$this->DB[$x][1]."', '".$this->dateFormater($this->DB[$x][4])."', '".$this->DB[$x][5]."', '".$this->DB[$x][7]."', '".$this->DB[$x][9]."', '".$this->DB[$x][11]."', '".$this->DB[$x][13]."', '".$this->DB[$x][14]."', '".$this->dateFormater($this->DB[$x][18])."', '".$this->DB[$x][19]."', '".$this->DB[$x][20]."', '".$this->DB[$x][21]."', '".$this->DB[$x][22]."', '".$this->dateFormater($this->DB[$x][24])."', '".$this->DB[$x][27]."', '".$this->DB[$x][28]."', '".$this->DB[$x][29]."', '".$this->DB[$x][30]."', '".$this->DB[$x][31]."', '".$this->DB[$x][33]."', '".$this->DB[$x][34]."', '".$this->DB[$x][35]."', ".$this->valueFormater($this->DB[$x][36]).", '".$this->dateFormater($this->DB[$x][37])."', '".$this->DB[$x][38]."', ".$this->valueFormater($this->DB[$x][39]).", ".$this->valueFormater($this->DB[$x][40]).", '".$this->DB[$x][41]."', '".$this->DB[$x][42]."', ".$this->valueFormater($this->DB[$x][45]).", '".$this->DB[$x][46]."', '".$this->DB[$x][47]."', '".$this->DB[$x][48]."', '".$this->passwordMaker()."', ".$code.")", "INSERT INTO Pessoal (matricula, nome, sexo, CPF, PIS_PASEP, data_nascimento, ultimo_nome, codigo_fol) VALUES ('".$this->DB[$x][0]."', '".$this->DB[$x][3]."', '".$this->DB[$x][12]."', '".$this->DB[$x][15]."', '".$this->DB[$x][16]."',  '".$this->dateFormater($this->DB[$x][17])."', '".$this->DB[$x][32]."', ".$code.")", "INSERT INTO RG (matricula, identidade, orgao_expedidor, codigo_fol) VALUES ('".$this->DB[$x][0]."', '".$this->DB[$x][25]."', '".$this->DB[$x][26]."', ".$code.")", "INSERT INTO Inf_Bancaria (matricula, conta, banco, numero, codigo_fol) VALUES ('".$this->DB[$x][0]."', '".$this->DB[$x][6]."', '".$this->DB[$x][43]."',  '".$this->DB[$x][44]."', ".$code.")");
										break;
										
					case "calculo" : $date = explode("-",$_SESSION["day"]);
					
									$query = "SELECT * FROM Calculos WHERE matricula='".$this->DB[$x][0]."' AND fol_codigo=".$code." AND data BETWEEN '".$date[2]."-".$date[1]."-01' and '".$date[2]."-".$date[1]."-31'";
									
									$result = $MySQLconnect->execute($query);
									if($MySQLconnect->counterResult($result) > 0){
										$aux = array("UPDATE Calculos SET valor=".$this->valueFormater($this->DB[$x][2])." WHERE matricula='".$this->DB[$x][0]."' AND fol_codigo=".$code." AND eve_codigo='".$this->DB[$x][1]."' AND data BETWEEN '".$date[2]."-".$date[1]."-01' and '".$date[2]."-".$date[1]."-31'");
									}else{
										$aux = array("INSERT INTO Calculos (valor, fol_codigo, eve_codigo, matricula, data) VALUES (".$this->valueFormater($this->DB[$x][2]).", ".$code.", '".$this->DB[$x][1]."', '".$this->DB[$x][0]."', '".$this->dateFormater2($_SESSION["day"])."')");
									}
									break;

				}
				/*foreach($aux as $query){
					echo $query."<br>";
				}*/
				
				foreach($aux as $query){
					if(!$MySQLconnect->execute($query)){
						/*echo $query."<br>";
						die();*/
						$toFix = true;
						$this->DB[$x][$numFields] = "true";
					}else{
						$this->DB[$x][$numFields] = "false";
					}
				}
			}
			
			$MySQLconnect->close();
			dbase_close($DFBconnect);
			
			if($toFix){
				$this->fixProblems($numFields, $numRows);
			}else{
				header("Location: ../importDocuments.php?upl=true&tab=$this->tableId");
			}
		}
		
		function dateFormater($d){
			if(!is_numeric($d) || (strlen($d) < 8))
				return "0000-00-00";
			
			$date = NULL;
			/*
			echo($d."<br>");
			$date = substr($d,-4)."-";
			echo($date."<br>");
			$date .= substr($d,strpos($d,"/")+1, (strrpos($d,"/")-(strpos($d,"/")+1)))."-";
			echo($date."<br>");
			$date .= substr($d,0,strpos($d,"/"));
			die($date);
			*/
			$date = substr($d, 0, 4)."-";
			$date .= substr($d, 4, 2)."-";
			$date .= substr($d,6,2);
			
			return $date;
		}
		
		function dateFormater2($d){
			$date = NULL;
			$date = substr($d,-4)."-";
			$date .= substr($d,strpos($d,"-")+1, (strrpos($d,"-")-(strpos($d,"-")+1)))."-";
			$date .= substr($d,0,strpos($d,"-"));
			
			return $date;
		}
		
		function valueFormater($v){
			if($v == "" || $v == NULL)
				$v = 0;
			return $v;
		}
		
		function passwordMaker(){
			$password = "xxxxx";
			$password[0] = chr(rand(65,90)); //Upcase word
			$password[1] = chr(rand(97,122)); //Lowcase word
			$password[2] = chr(rand(97,122)); //Lowcase word
			$password[3] = chr(rand(48,57)); //number
			$password[4] = chr(rand(48,57)); //number
			return base64_encode($password); //return an encoded password in base64
			//echo base64_decode($texto1);
		}
		
		function fixProblems($numFields, $numRows){
			$variables = new Variables();
			$nR = 0;
			$MySQLconnect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
			
			if($this->tableId == "cadstro"){
				for($x=0; $x<$numRows; $x++){
					$aux = array("UPDATE Cadastros SET cargo='".$this->DB[$x][8]."', lotacao='".$this->DB[$x][1]."', data_admissao='".$this->dateFormater($this->DB[$x][4])."', vinculo='".$this->DB[$x][5]."', previdencia'".$this->DB[$x][7]."', nivel='".$this->DB[$x][9]."', dep_imp_re='".$this->DB[$x][11]."', hora_sem='".$this->DB[$x][13]."', instrucao='".$this->DB[$x][14]."', data_afastamento='".$this->dateFormater($this->DB[$x][18])."', sindical='".$this->DB[$x][19]."', dp_sal_fam='".$this->DB[$x][20]."', hora_ponto='".$this->DB[$x][21]."', vale_transporte='".$this->DB[$x][22]."', data_promocao='".$this->dateFormater($this->DB[$x][24])."', tipo='".$this->DB[$x][27]."', situacao='".$this->DB[$x][28]."', descontar='".$this->DB[$x][29]."', receber='".$this->DB[$x][30]."', funcao='".$this->DB[$x][31]."', maior_360='".$this->DB[$x][33]."', prof_40h='".$this->DB[$x][34]."', vlt_ver='".$this->DB[$x][35]."', val_niv=".$this->valueFormater($this->DB[$x][36]).", data_FGTS='".$this->dateFormater($this->DB[$x][37])."', permanente='".$this->DB[$x][38]."', remuneracao_bruto=".$this->valueFormater($this->DB[$x][39]).", vencimento=".$this->valueFormater($this->DB[$x][40]).", flag='".$this->DB[$x][41]."', entrada='".$this->DB[$x][42]."', liquido=".$this->valueFormater($this->DB[$x][45]).", sobregrat='".$this->DB[$x][46]."', assistencia='".$this->DB[$x][47]."', medico='".$this->DB[$x][48]."', codigo_fol=".$code." WHERE matricula='".$this->DB[$x][0]."'", "UPDATE Pessoal SET nome='".$this->DB[$x][3]."', sexo='".$this->DB[$x][12]."', CPF='".$this->DB[$x][15]."', PIS_PASEP='".$this->DB[$x][16]."',  data_nascimento='".$this->dateFormater($this->DB[$x][17])."', ultimo_nome='".$this->DB[$x][32]."', codigo_fol=".$code." WHERE matricula='".$this->DB[$x][0]."'", "UPDATE RG SET identidade='".$this->DB[$x][25]."', orgao_expedidor='".$this->DB[$x][26]."', codigo_fol=".$code." WHERE matricula='".$this->DB[$x][0]."'", "UPDATE Inf_Bancaria SET conta='".$this->DB[$x][6]."', banco='".$this->DB[$x][43]."',  numero='".$this->DB[$x][44]."', codigo_fol=".$code." WHERE matricula='".$this->DB[$x][0]."'");
					foreach($aux as $temp){
						$MySQLconnect->execute($temp);
					}
				}
			}
			
			if(!$MySQLconnect->start())
				echo("Impossible to star connection in Handler.");
				
			echo('<script language="javascript" type="text/javascript">
					function setField(param, cont){
						for(x=0; x<cont; x++){
							eval("if(document.form."+param+x+".disabled == true){document.form."+param+x+".disabled = false;}else{ document.form."+param+x+".disabled = true;}");
						}
						return true;
					}
				</script>
				<form id="form" name="form" method="post" action="Updater.class.php">');
			for($x=0; $x<$numRows; $x++){
				if($this->DB[$x][$numFields] == "true"){
					echo('<table width="100%" border="1"><tr><td width="62">Modificar:</td><td width="586"><table width="100%" border="1"><tr><td width="43">Antigo:</td>');
					switch($this->tableId){
						case "dcr" : 	$aux = "SELECT * FROM Cargos WHERE cargo='".$this->DB[$x][0]."'";
										$columnNames = array("Cargo","Descicao","Tipo","Vencimento");
										break;
										
						case "dlt" : $aux = "SELECT * FROM Lotacoes WHERE lotacao='".$this->DB[$x][0]."'";
									$columnNames = array("Lotação","Descicao","Secretaria");
									break;
									
						case "especial" : $aux = "SELECT * FROM Especialidades WHERE codigo_esp ='".$this->DB[$x][0]."'";
									$columnNames = array("Código","Descicao","Cargo");
									break;
									
						case "eventos" : $aux = "SELECT * FROM Eventos WHERE codigo_eve ='".$this->DB[$x][0]."'";
									$columnNames = array("Código", "Descrição", "IRRF", "IPMT", "FAL", "FIXO", "TEMP", "Valor", "Gratifição", "FGTS", "Desconto", "Nível", "INSS");
									break;
									
						/*case "cadastro" : $aux = "SELECT * FROM Pessoal p INNER JOIN Cadastros c ON p.matricula = c.matricula INNER JOIN inf_bancaria ib ON c.matricula = ib.matricula INNER JOIN rg ON c.matricula = rg.matricula WHERE c.matricula='".$this->DB[$x][0]."'";
									$columnNames = array("matricula", "nome", "sexo", "CPF", "PIS_PASEP", "data_nascimento","ultimo_nome","Codigo", "Matricula", "Cargo", "Lotacao", "Data admissão", "Vínculo", "Previdência", "Nível", "dep_imp_re", "hora_sem", "instrução", "data_afastamento", "sindical", "dp_sal_fam", "hora_ponto", "vale_transporte", "data_promocao", "tipo", "situação", "descontar", "receber", "funcao", "maior_360", "prof_40h", "vlt_ver", "val_niv", "data_FGTS", "permanente", "remuneracao_bruto", "vencimento", "flag", "entrada", "liquido", "sobregrat", "assistencia","medico", "senha", "Código", "Matricula", "conta", "banco", "numero", "código", "matricula", "identidade", "orgão_expedidor", "código");*/
									/*matricula, cargo, lotacao, data_admissao, vinculo, previdencia, nivel, dep_imp_re, hora_sem, instrucao, data_afastamento, sindical, dp_sal_fam, hora_ponto, vale_transporte, data_promocao, tipo, situacao, descontar, receber, funcao, maior_360, prof_40h, vlt_ver, val_niv, data_FGTS, permanente, remuneracao_bruto, vencimento, flag, entrada, liquido, sobregrat, assistencia, medico, senha, codigo, matricula, nome, sexo, CPF, PIS_PASEP, data_nascimento, ultimo_nome, codigo, matricula, identidade, orgao_expedidor, codigo, matricula, conta, banco, numero, codigo*/
									/*$ar = array(0, 3, 12, 15, 16, 17, 32, "x", 0, 8, 1, 4, 5, 7, 9, 11, 13, 14, 18, 19, 20, 21, 22, 24, 27, 28, 29, 30, 31, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 45, 46, 47, 48, "x", "x", 0, 6, 43, 44, "x", 0, 25, 26, "x");
									break;*/
						default : $aux = "autoUp";
					}
					
					$row = mysql_fetch_array($MySQLconnect->execute($aux));
					for($y=0; $y<$numFields; $y++){
						echo('<td>'.$columnNames[$y].': '.$row[$y].'</td>');
					}
					echo('</tr><tr><td>Novo:</td>');
					for($y=0; $y<$numFields; $y++){
						echo('<td>'.$columnNames[$y].': <input name="tf'.$x.$y.'" disabled="disabled" type="text" id="tf'.$x.$y.'" value="'.$this->DB[$x][$y].'"/></td>');
					}
					echo('</tr></table></td><td width="96">Marcar: <input type="checkbox" name="checkbox'.$x.'" value="checkbox'.$x.'" onchange="javascript: return setField('."'".'tf'.$x."'".', '.$numFields.');"/></td></tr></table>');
				}
			}
			echo('<input name="tableId" type="text" id="tableId" style="visibility:hidden" value="'.$this->tableId.'"/><input name="numFields" type="text" id="numFields" style="visibility:hidden" value="'.$numFields.'"/><input name="numRows" type="text" id="numRows" style="visibility:hidden" value="'.$nR.'"/><input name="update" type="submit" id="update" value="Atualizar" /></form>');
			$MySQLconnect->close();
		}
	}
?>

<!-- <form id="form1" name="form1" method="post" action="">
    
  <table width="100%" border="1">
    <tr>
      <td width="62">Modificar:</td>
      <td width="586"><table width="100%" border="1">
        <tr>
          <td width="43">Novo:</td>
          <td width="527">x</td>
        </tr>
        <tr>
          <td>Antigo:</td>
          <td>
            <input name="tf" type="text" disabled="disabled" id="tf" value="err" />
          </td>
        </tr>
      </table></td>
      <td width="96">
        Marcar:
        <input type="checkbox" name="checkbox" value="checkbox" />
      </td>
    </tr>
  </table>
  
  <input name="query" type="text" id="query" style="visibility:hidden" value=""/>
  <input name="update" type="submit" id="update" value="Atualizar" />
  
</form> -->
