<?php
	session_start();
	$nivelAcesso = "../:2:3:4";
	include_once("controladorAcesso.php");
	$ffImpSer = isset($_FILES["ffImpSer"]) ? $_FILES["ffImpSer"] : NULL;
	
	if($ffImpSer != NULL){
		$uri = "../uploads/";
		if(!ini_get('safe_mode')){ 
			set_time_limit(900);
		}
		if(empty($ffImpSer)){
			die("Arquivo vazio!");
		}
		$lowName = strtolower($ffImpSer["name"]);
		$chars = array("ç","~","^","]","[","{","}",";",":","´",",",">","<","-","/","|","@","$","%","ã","â","á","à","é","è","ó","ò","+","=","*","&","(",")","!","#","?","`","ã"," ","©");
		$newName = str_replace($chars,"",$lowName);
		$arquivoNome = $newName;
		if(!preg_match("/([a-z]|[A-Z]|[0-9]|\.|-|_| ){2,}\.[dbfDBF]{3,3}$/", $arquivoNome)){
			die("Formato inválido!");
		}
		if ($ffImpSer["size"] > 15242880) {//Limit: 15MB
			die("Arquivo muito grande!");
		}
		$uri .= $arquivoNome;
		if(move_uploaded_file($ffImpSer['tmp_name'],$uri)){
			chmod($uri, 0777);
		}else{
			die("Erro na importação");
		}
	
		include_once("ConectarDBF.class.php");
		$dbf = new ConectarDBF($uri,0);
		if(!$dbf->conectar())
			die("Erro ao abrir o arquivo");
		$nLinhas = $dbf->getNumeroRegistros();
		$nCampos = $dbf->getNumeroCampos();
		for($x=1; $x<=$nLinhas; $x++){
			$linha = $dbf->buscar($x);
			$matriz[$x-1] = $linha;
		}
		$dbf->destruir();	
			
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
			$pCPF 			= substr($campo[2], 0, 14);
			$sMatricula		= str_replace(" ", "", $campo[3]);
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
				$dao = new DAOServidor($pEmpresa, $pesCod, $sMatricula, $sAdmissao, $sCargo, $sVinculo, $sConsignavel, 0, $sConsignavel, "../", $conexao);
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
