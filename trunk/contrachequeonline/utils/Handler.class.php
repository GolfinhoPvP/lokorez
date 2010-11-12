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
				$row = mysql_fetch_assoc($MySQLconnect->execute("SELECT codigo FROM Folhas where nome='$this->folhaType'"));
				$code = $row["codigo"];
			}
			
			for($x=0; $x<$numRows; $x++){
			
				switch($this->tableId){
					case "dcr" : $aux = array("INSERT INTO Cargos (cargo, descricao , tipo, vencimento) VALUES ('".$this->DB[$x][0]."', '".$this->DB[$x][1]."', '".$this->DB[$x][2]."', ".$this->DB[$x][3].")");
								break;
								
					case "dlt" : $aux = array("INSERT INTO Lotacoes (lotacao, descricao_lotacao , secretaria) VALUES ('".$this->DB[$x][0]."', '".$this->DB[$x][1]."', '".$this->DB[$x][2]."')");
								break;
								
					case "especial" : $aux = array("INSERT INTO Especialidades (codigo, descricao , cargo) VALUES ('".$this->DB[$x][0]."', '".$this->DB[$x][1]."', '".$this->DB[$x][2]."')");
								break;
								
					case "eventos" : $aux = array("INSERT INTO Eventos (codigo, descricao, IRRF, IPMT, FAL, FIXO, TEMP, valor, GRAT, FGTS, desconto, nivel, INSS) VALUES ('".$this->DB[$x][0]."', '".$this->DB[$x][1]."',  '".$this->DB[$x][2]."',  '".$this->DB[$x][3]."',  '".$this->DB[$x][4]."',  '".$this->DB[$x][5]."',  '".$this->DB[$x][6]."',  ".$this->DB[$x][7].",  '".$this->DB[$x][8]."',  '".$this->DB[$x][9]."',  ".$this->DB[$x][10].", '".$this->DB[$x][11]."', '".$this->DB[$x][12]."')");
								break;
								
					case "cadastro" :	$aux = array("INSERT INTO Cadastros (matricula, cargo, lotacao, data_admissao, vinculo, previdencia, nivel, dep_imp_re, hora_sem, instrucao, data_afastamento, sindical, dp_sal_fam, hora_ponto, vale_transporte, data_promocao, tipo, situacao, descontar, receber, funcao, maior_360, prof_40hs, vlt_ver, val_niv, data_FGTS, permanente, remuneracao_bruto, vencimento, flag, entrada, liquido, sobregrat, assistencia, medico, senha, codigo) VALUES ('".$this->DB[$x][0]."', '".$this->DB[$x][8]."',  '".$this->DB[$x][1]."',  '".$this->DB[$x][4]."',  '".$this->DB[$x][5]."',  '".$this->DB[$x][7]."',  '".$this->DB[$x][9]."',  '".$this->DB[$x][11]."',  '".$this->DB[$x][13]."',  '".$this->DB[$x][14]."',  '".$this->DB[$x][18]."', '".$this->DB[$x][19]."', '".$this->DB[$x][20]."', '".$this->DB[$x][21]."', '".$this->DB[$x][22]."', '".$this->DB[$x][24]."', '".$this->DB[$x][27]."', '".$this->DB[$x][28]."', '".$this->DB[$x][29]."', '".$this->DB[$x][30]."', '".$this->DB[$x][31]."', '".$this->DB[$x][33]."', '".$this->DB[$x][34]."', '".$this->DB[$x][35]."', ".$this->DB[$x][36].", '".$this->DB[$x][37]."', '".$this->DB[$x][38]."', ".$this->DB[$x][39].", ".$this->DB[$x][40].", '".$this->DB[$x][41]."', '".$this->DB[$x][42]."', ".$this->DB[$x][45].", '".$this->DB[$x][46]."', '".$this->DB[$x][47]."', '".$this->DB[$x][48]."', '".$this->passwordMaker()."', ".$code.")", "INSERT INTO Pessoal (matricula, nome, sexo, CPF, PIS_PASEP, data_nascimento, ultimo_nome, codigo) VALUES ('".$this->DB[$x][0]."', '".$this->DB[$x][1]."',  '".$this->DB[$x][3]."',  '".$this->DB[$x][12]."',  '".$this->DB[$x][15]."',  '".$this->DB[$x][16]."',  '".$this->DB[$x][17]."',  ".$this->DB[$x][32].",  ".$code.")", "INSERT INTO RG (matricula, identidade, org�o_expedidor, codigo) VALUES ('".$this->DB[$x][0]."', '".$this->DB[$x][25]."',  '".$this->DB[$x][26]."', ".$code.")", "INSERT INTO Inf_Bancaria (matricula, conta, banco, numero, codigo) VALUES ('".$this->DB[$x][0]."', '".$this->DB[$x][6]."', '".$this->DB[$x][43]."',  '".$this->DB[$x][44]."', ".$code.")");
										break;

				}
				foreach($aux as $query){
					echo $query;
				}
				die($this->tableId);
				foreach($aux as $query){
					if(!$MySQLconnect->execute($query)){
						$toFix = true;
						$this->DB[$x][$numFields] = "true";
					}else{
						$this->DB[$x][$numFields] = "false";
					}
				}
			}
			
			$MySQLconnect->close();
			dbase_close($DFBconnect);
			die();
			if($toFix){
				$this->fixProblems($numFields, $numRows);
			}else{
				header("Location: ../importDocuments.php?upl=true&tab=$this->tableId");
			}
		}
		
		function passwordMaker(){
			$password = "xxxxx";
			$password[0] = rand(65,90); //Upcase word
			$password[1] = rand(97,122); //Lowcase word
			$password[2] = rand(97,122); //Lowcase word
			$password[3] = rand(48,57); //number
			$password[4] = rand(48,57); //number
			
			return base64_encode($password); //return an encoded password in base64
			//echo base64_decode($texto1);
		}
		
		function fixProblems($numFields, $numRows){
			$variables = new Variables();
			$nR = 0;
			$MySQLconnect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
			
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
									$columnNames = array("Lota��o","Descicao","Secretaria");
									break;
									
						case "especial" : $aux = "SELECT * FROM Especialidades WHERE codigo='".$this->DB[$x][0]."'";
									$columnNames = array("C�digo","Descicao","Cargo");
									break;
									
						case "eventos" : $aux = "SELECT * FROM Eventos WHERE codigo='".$this->DB[$x][0]."'";
									$columnNames = array("C�digo", "Descri��o", "IRRF", "IPMT", "FAL", "FIXO", "TEMP", "Valor", "Gratifi��o", "FGTS", "Desconto", "N�vel", "INSS");
									break;
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
					$nR++;
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
