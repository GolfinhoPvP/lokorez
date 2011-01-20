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
		$dao = new DAOServidor(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, "../", $conexao);
		$dao->zerar();
		$conexao->commit();
		
		for($x=0; $x < $nLinhas; $x++){
			$conexao = new ConectarMySQL();
			$comitar = true;
			
			$campo = $matriz[$x];
			$pEmpresa		= $campo[0];
			$pNome 			= utf8_encode($campo[1]);
			$pCPF 			= substr($campo[3], 0, 14);
			$sMatricula		= str_replace(" ", "", $campo[2]);
			$sAdmissao		= substr($campo[4], 0, 4)."/".substr($campo[4], 4, 2)."/".substr($campo[4], 6, 2);
			$sCargo			= $campo[5];
			$sVinculo		= $campo[6];
			$sConsignavel	= $campo[7];
			
			$dao = new DAOPessoa($pNome, $pCPF , "S", "../", $conexao);
			
			$linha = mysqli_fetch_array($dao->pesquisar($pNome.":".$pCPF.":S"));
			$existe = $linha["pes_codigo"];
			if(strlen($existe) > 0){
				$log = new DAOLog($_SESSION["pessoa"], 4, $_SESSION["nivel"], $_SESSION["codigo"], 5, "nome=\'".$pNome."\'", "../", $conexao);
				if(!$dao->alterar($existe) /*|| !$log->cadastrar()*/){
					$comitar = false;
					//echo($campo[1]);
				}
			}else{
				$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 5, "nome=\'".$pNome."\'", "../", $conexao);
				if(!$dao->cadastrar() /*|| !$log->cadastrar()*/){
					$comitar = false;
					//echo($campo[1]);
				}
				$linha = mysqli_fetch_array($dao->pesquisar($pNome.":".$pCPF.":S"));
				$pesCod = $linha["pes_codigo"];
			}

			if(strlen($existe) > 0){
				$dao = new DAOServidor($pEmpresa, $existe, $sMatricula, $sAdmissao, $sCargo, $sVinculo, $sConsignavel, 0, $sConsignavel, "../", $conexao);
				$log = new DAOLog($_SESSION["pessoa"], 4, $_SESSION["nivel"], $_SESSION["codigo"], 10, "matricula=\'".$sMatricula."\'", "../", $conexao);
				if(!$dao->alterar($existe) /*|| !$log->cadastrar()*/){
					$comitar = false;
					//echo($campo[3]);
				}
			}else{
				$dao = new DAOServidor($pEmpresa, $pesCod, $sMatricula, $sAdmissao, $sCargo, $sVinculo, $sConsignavel, 0, 0, "../", $conexao);
				$log = new DAOLog($_SESSION["pessoa"], 3, $_SESSION["nivel"], $_SESSION["codigo"], 10, "matricula=\'".$sMatricula."\'", "../", $conexao);
				if(!$dao->cadastrar() /*|| !$log->cadastrar()*/){
					$comitar = false;
					//echo($campo[3]);
				}
			}
			if($comitar)
				$conexao->commit();
			else
				$conexao->rollback();
		}
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
