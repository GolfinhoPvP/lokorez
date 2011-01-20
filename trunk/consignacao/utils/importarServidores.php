<?php
	session_start();
	$nivelAcesso = "../:2:3:4";
	include_once("controladorAcesso.php");
	$ffImpSer = isset($_FILES["ffImpSer"]) ? $_FILES["ffImpSer"] : NULL;
	
	if($ffImpSer != NULL){
		$arquivo = $ffImpSer;
		$matriz = NULL;
		include_once("importadorDBF.php");
		include_once("ConectarMySQL.class.php");
		include_once("../dao/DAOPessoa.class.php");
		include_once("../dao/DAOServidor.class.php");
		include_once("../dao/DAOLog.class.php");
		$conexao = new ConectarMySQL();
		$comitar = true;
		for($x=0; $x < $nLinhas; $x++){
			$tempx = $matriz[$x];
			foreach($tempx as $campo){
				echo("-".$campo."-");
				/*$dao = new DAOPessoa($campo[1], $campo[1], "S", "../", $conexao);
				$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 5, "nome=\'".$campo[1]."\'", "../", $conexao);
				if(!$dao->cadastrar() || !$log->cadastrar()){
					$comitar = false;
					echo($campo[1]);
				}
				$linha = mysqli_fetch_array($dao->pesquisar($campo[1].":%:P"));
				
				$pesCod = $linha["pes_codigo"];
				
				$dao = new DAOServidor($campo[0], $codPEs, $campo[3], $campo[4], $campo[5], $campo[6], $campo[7], 0, 0, "../", $conexao);
				$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 10, "nome=\'".$campo[3]."\'", "../", $conexao);
				if(!$dao->cadastrar() || !$log->cadastrar()){
					$comitar = false;
					echo($campo[3]);
				}*/
			}
			echo("<br/>");
		}
		if($comitar)
			$conexao->commit();
		else
			$conexao->rollback();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form id="importarServidor" name="importarServidor" enctype="multipart/form-data" method="post" action="">
  <label>
  <input name="ffImpSer" type="file" id="ffImpSer" size="55" />
  </label>
  <br />
  <label>
  <input name="btImportar" type="submit" id="btImportar" value="Importar" />
  </label>
</form>
</body>
</html>
