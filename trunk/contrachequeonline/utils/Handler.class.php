<?php
	include_once("../beans/Variables.class.php");
	require_once("Connect.class.php");
	
	class Handler{
		private $path;
		private $tableId;
		private $DB;
		
		function __construct($t, $path){
			$this->path = $path;
			$this->tableId = $t;
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
			
			for($x=0; $x<$numRows; $x++){
			
				switch($this->tableId){
					case "dcr" : $aux = "INSERT INTO Cargos VALUES ('".$this->DB[$x][0]."', '".$this->DB[$x][1]."', '".$this->DB[$x][2]."', ".$this->DB[$x][3].")";
								break;
				}
				
				if(!$MySQLconnect->execute($aux)){
					$toFix = true;
					$this->DB[$x][$numFields] = "true";
				}else{
					$this->DB[$x][$numFields] = "false";
				}
			}
			
			$MySQLconnect->close();
			dbase_close($DFBconnect);
			
			if($toFix){
				$this->fixProblems($numFields, $numRows);
			}else{
				header("Location: ../importDocuments.php?upl=true");
			}
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
