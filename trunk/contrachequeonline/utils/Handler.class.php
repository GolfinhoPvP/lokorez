<?php
	include_once("../beans/Variables.class.php");
	require_once("Connect.class.php");
	
	class Handler{
		private $path;
		private $tableId;
		private $columnNames;
		
		function __construct($path, $tableId){
			$this->path = $path;
			$this->tableId = $tableId;
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
			
			for($x=0; $x<$numRows; $x++){
				$DBFrow = dbase_get_record($DFBconnect, $x); //Get DBF archive rows
				for($y=0; $y<$numFields; $y++){
					$matrizRow[$x] = $DBFrow[$y];
				}
				$DB[$x] = $matrizRow;
			}
			
			for($x=0; $x<$numRows; $x++){
				if(!$MySQLconnect->execute($this->getQueryInsert())){
					$toFix = true;
					$DB[$x][$numFields+1] = false;
				}else{
					$DB[$x][$numFields+1] = true;
				}
			}
			$MySQLconnect->close();
			dbase_close($DFBconnect);
			if($toFix){
				$this->fixProblems($DB, $numFields, $numRows);
			}
		}
		
		function getQueryInsert(){
			switch($this->tableId){
				case "dcr" : return "INSERT INTO Cargos VALUES ('$DB[$x][0]', '$DB[$x][1]', '$DB[$x][2]', '$DB[$x][3]')";
								break;
			}
		}
		
		function getQuerySelect(){
			switch($this->tableId){
				case "dcr" : return "SELECT * FROM Cargos WHERE codigo='$DB[$x][0]";
								$this->columnNames = array("Codigo","Descicao","Tipo","Vencimento");
								break;
			}
		}
		
		function getQueryUpdate(){
			switch($this->tableId){
				case "dcr" : 	return "UPDATE INTO Cargos SET descicao = '$DB[$x][1]', tipo='$DB[$x][2]', vencimento='$DB[$x][3]' WHERE codigo='$DB[$x][0]'";
								break;
			}
		}
		
		function fixProblems($DB, $numFields, $numRows){
			$variables = new Variables();
			$nR = 0;
			$MySQLconnect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
			echo('<form id="form1" name="form1" method="post" action="Updater.class.php"><label></label>');
			for($x=0; $x<$numRows; $x++){
				if($DB[$x][$numFields+1] == false){
					echo('<table width="100%" border="1"><tr><td width="62">Modificar:</td><td width="586"><table width="100%" border="1"><tr><td width="43">Antigo:</td>');
					$result = $MySQLconnect->execute($this->getQuerySelect());
					for($y=0; $y<$numFields; $y++){
						echo('<td>'.$this->columnNames[$y].': '.$result[$y].'</td>');
					}
					echo('</tr><tr><td>Novo:</td>');
					for($y=0; $y<$numFields; $y++){
						echo('<td><label>'.$this->columnNames[$y].': <input name="tf'.$x.$y.'" type="text" disabled="disabled" id="tf'.$x.$y.'" value="'.$DB[$x][$y].'"/></label></td>');
					}
					echo('</tr></table></td><td width="96"><label>Marcar: <input type="checkbox" name="checkbox'.$x.'" value="checkbox'.$x.'" /></label></td></tr></table>');
					$nR++;
				}
			}
			echo('<label><input name="query" type="text" id="query" style="visibility:hidden" value="'.$this->getQueryUpdate().'"/><label><input name="numFields" type="text" id="numFields" style="visibility:hidden" value="'.$numFields.'"/><label><input name="numRows" type="text" id="numRows" style="visibility:hidden" value="'.$nR.'"/><input name="update" type="submit" id="update" value="Atualizar" /></label></form>');
		}
	}
?>

<!-- <form id="form1" name="form1" method="post" action="">
  <label>  </label>
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
          <td><label>
            <input name="tf" type="text" disabled="disabled" id="tf" value="err" />
          </label></td>
        </tr>
      </table></td>
      <td width="96"><label>
        Marcar:
        <input type="checkbox" name="checkbox" value="checkbox" />
      </label></td>
    </tr>
  </table>
  <label>
  <input name="query" type="text" id="query" style="visibility:hidden" value=""/>
  <input name="update" type="submit" id="update" value="Atualizar" />
  </label>
</form> -->
