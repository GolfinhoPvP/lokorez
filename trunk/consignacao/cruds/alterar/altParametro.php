<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	
	include_once("../../utils/funcoes.php");
	$slPer = isset($_POST["slPer"]) ? $_POST["slPer"] : NULL;
	$ffPlanilha = isset($_FILES["ffPlanilha"]) ? $_FILES["ffPlanilha"] : NULL;
	if($slPer != NULL){
		include_once("../../utils/ConectarDBF.class.php");
		$hash = getHash();
		$link = "downloads/".$slPer."-".$hash.".dbf";
		$uri = "../../".$link;
		$dbf = new ConectarDBF($uri, 1);
		$campos = array(
			array("periodo", 	"C", 8),
			array("empresa", 	"N", 6, 	0),
			array("matricula", 	"C", 20),
			array("totalpar", 	"N", 4, 	0),
			array("numeroext", 	"C", 120),
			array("numeropar", 	"N", 4, 	0),
			array("verba", 		"C", 10),
			array("valor", 		"N", 10, 	2),
			array("status", 	"N", 1, 	0)
		);
		$dbf->criar($campos);
		
		include_once("../../utils/ConectarMySQL.class.php");
		$mysql = new ConectarMySQL();
		$sql = "SELECT p.par_periodo_parcela, a.emp_codigo, a.ser_matricula, a.ave_numero_parcelas, a.ave_numero_externo, p.par_numero_parcela, v.ver_verba, p.par_valor, p.sta_codigo FROM parcelas p INNER JOIN averbacoes a ON p.ave_numero_externo=a.ave_numero_externo INNER JOIN verbas v ON v.ban_codigo=a.ban_codigo AND v.emp_codigo=a.emp_codigo AND v.pro_codigo=a.pro_codigo WHERE p.par_periodo_parcela='".$slPer."'";
		$resultado = $mysql->selecionar($sql);
		$comitar = false;
		while($linhaMySQL = mysqli_fetch_array($resultado)){
			$linhaDBF = array(
				$linhaMySQL["par_periodo_parcela"],
				$linhaMySQL["emp_codigo"],
				$linhaMySQL["ser_matricula"],
				$linhaMySQL["ave_numero_parcelas"],
				$linhaMySQL["ave_numero_externo"],
				$linhaMySQL["par_numero_parcela"],
				$linhaMySQL["ver_verba"],
				$linhaMySQL["par_valor"],
				$linhaMySQL["sta_codigo"]
			);
				
			if(!$dbf->adicionar($linhaDBF)){
				$comitar = false;
				die();
			}else{
				$comitar = true;
			}
		}
		$sql = "UPDATE parcelas SET sta_codigo = 2 WHERE par_periodo_parcela='".$slPer."'";
		if(!$mysql->executar($sql)){
			$comitar = false;
			die();
		}else{
			$comitar = true;
		}
		$sql = "UPDATE parametros SET sta_codigo = 3, par_link='".$link."' WHERE par_periodo='".$slPer."'";
		if(!$mysql->executar($sql)){
			$comitar = false;
			die();
		}else{
			$comitar = true;
		}
		
		include_once("../../dao/DAOLog.class.php");
		$log = new DAOLog($_SESSION["pessoa"], 4, $_SESSION["nivel"], $_SESSION["codigo"], 11, "Encerrou=\'".$slPer."\'", "../../", $mysql);
		$comitar = $log->cadastrar();
		
		$dbf->fechar();
		if($comitar = true){
			$mysql->commit();
		}else{
			$mysql->rollback();
		}
		header("Location: altParametro.php");
		die();
	}
	
	if($ffPlanilha != NULL){
		$uri = "../../uploads/";
		if(!ini_get('safe_mode')){ 
			set_time_limit(900);
		}
		if(empty($ffPlanilha)){
			die("Arquivo vazio!");
		}
		$lowName = strtolower($ffPlanilha["name"]);
		$chars = array("ç","~","^","]","[","{","}",";",":","´",",",">","<","-","/","|","@","$","%","ã","â","á","à","é","è","ó","ò","+","=","*","&","(",")","!","#","?","`","ã"," ","©");
		$newName = str_replace($chars,"",$lowName);
		$arquivoNome = $newName;
		$uri .= $arquivoNome;
		if(!preg_match("/([a-z]|[A-Z]|[0-9]|\.|-|_| ){2,}\.[dbfDBF]{3,3}$/", $arquivoNome)){
			die("Formato inválido!");
		}
		if($ffPlanilha["size"] > 15242880) {//Limit: 15MB
			die("Arquivo muito grande!");
		}
		if(move_uploaded_file($ffPlanilha['tmp_name'],$uri)){
			chmod($uri, 0777);
		}else{
			die("Erro na importação");
		}
	
		include_once("../../utils/ConectarDBF.class.php");
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
		
		include_once("../../utils/ConectarMySQL.class.php");
		$mysql = new ConectarMySQL();
		$comitar = true;
		include_once("../../dao/DAOLog.class.php");
		include_once("../../dao/DAOServidor.class.php");
		include_once("../../dao/DAOParcela.class.php");
		include_once("../../beans/Servidor.class.php");
		include_once("../../beans/Parcela.class.php");
		$servidor = new Servidor(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
		$parcela = new Parcela(NULL, NULL, NULL, NULL, NULL);
		
		for($x=0; $x<$nLinhas; $x++){
			$linha = $matriz[$x];
			$linha[2] = rtrim($linha[2]);
			$linha[4] = rtrim($linha[4]);
			if($linha[8] != 4)
				continue;
			
			$dao = new DAOParcela(NULL, NULL, NULL, NULL, NULL, "../../", $mysql);
			$parcela = $dao->getParcela($linha[5], $linha[4]);
			if($parcela->getStaCodigo() != 2)
				continue;
			
			$sql = "UPDATE parcelas SET sta_codigo = ".$linha[8]." WHERE par_numero_parcela=".$linha[5]." AND ave_numero_externo='".$linha[4]."'";
			if(!$mysql->executar($sql)){
				$comitar = false;
				echo("Erro ao alterar status parcela ne= ".$linha[4]);
			}else{
				$comitar = true;
			}
			/*$log = new DAOLog($_SESSION["pessoa"], 4, $_SESSION["nivel"], $_SESSION["codigo"], 13, "Log numExt= ".$linha[4], "../../", $mysql);
			if(!$log->cadastrar())
				$comitar = false;*/
			
			$dao = new DAOServidor(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, "../../", $mysql);
			$servidor = $dao->getServidor($linha[2]);
			$servidor->setUtilizada($servidor->getUtilizada()-$linha[7]);
			$servidor->setDisponivel($servidor->getDisponivel()+$linha[7]);
			$dao->setServidor($servidor);
			if(!$dao->alterar($servidor->getPesCodigo())){
				$comitar = false;
			}
			/*$log = new DAOLog($_SESSION["pessoa"], 4, $_SESSION["nivel"], $_SESSION["codigo"], 10, "Log matricula= ".$linha[2], "../../", $mysql);
			if(!$log->cadastrar())
				$comitar = false;*/
			
			if(($linha[3] == $linha[5]) && $linha[8] == 4){
				$sql = "UPDATE averbacoes SET sta_codigo = 3 WHERE ave_numero_externo='".$linha[4]."'";
				if(!$mysql->executar($sql)){
					$comitar = false;
					echo("Erro ao alterar status averbacao ne= ".$linha[4]);
				}else{
					$comitar = true;
				}
				/*$log = new DAOLog($_SESSION["pessoa"], 4, $_SESSION["nivel"], $_SESSION["codigo"], 12, "Log numExt=\'".$linha[4]."\'", "../../", $mysql);
				if(!$log->cadastrar())
					$comitar = false;*/
			}
		}
		if($comitar == true){
			$mysql->commit();
		}else{
			$mysql->rollback();
		}
		header("Location: altParametro.php?alt=ok");
		die();
	}
	$cad = isset($_GET["alt"]) ? $_GET["alt"] : NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Untitled Document</title>
		<style type="text/css">
			<!--
			@import url("../../scripts/css/geral.css");
			-->
		</style>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/ajax.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/parametro.js"></script>
		<script type="text/javascript" language="javascript">
			window.onload = function(){
				carregarAlteracoes();
			}
			function carregarAlteracoes(){
				xmlRequest = getXMLHttp();

				xmlRequest.open("GET",'../pesquisar/getParametrosSL.php',true);
				
				if (xmlRequest.readyState == 1) {
					document.getElementById("carregando").innerHTML = "<img src='../../imagens/rotating_arrow.gif' width='20px' height='20px' />";
				}
				xmlRequest.onreadystatechange = function () {
						if (xmlRequest.readyState == 4){
							document.getElementById("carregando").innerHTML = "";
							document.getElementById('slPer').innerHTML = xmlRequest.responseText;
							loadContent('../pesquisar/getLinks.php', 'links', '../../');
						}
				}
				xmlRequest.send(null);						
			}
		</script>
	</head>
	<body>
		<?php
			if($alt != NULL){
				$tipo = "alt";
				$toRoot = "../../";
				include("../../includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<div id="carregando">
		</div>
		<form id="periodoEncerrar" name="periodoEncerrar" method="post" action="" onsubmit="javascript: return validarParametroAltSubmit();">
		  <div><span class="texto2">Encerrar per&iacute;odo :</span> 
		  <select name="slPer" class="tf1" id="slPer" onchange="javascript: validarParametroForm('slPer');">
		    <option value="---">---</option>
          </select></div>
		  <div align="center"><br />
	        <input name="btEncerrar" type="submit" class="bt1" id="btEncerrar" value="Encerrar" />
	        </label>
          </div>
		</form>
		Modelo do arquivo de exporta&ccedil;&atilde;o e importa&ccedil;&atilde;o do arquivo das parcelas: <img src="../../imagens/pdf.png" alt="Download" width="50" height="77" style="cursor:pointer" onclick="javascript: window.location = '../../downloads/Manual-imp-exp-parcelas.pdf';"/><br/>
		<br/>
	<form id="plaImportar" name="plaImportar" enctype="multipart/form-data" method="post" action="">
		<div><span class="texto2">Importar informa&ccedil;&otilde;es:</span>
		  <input name="ffPlanilha" type="file" class="tf1" id="ffPlanilha" size="65" />
      </div>
	    <label> 
	    <div align="center"><br />
          <input name="btImportar" type="submit" class="bt1" id="btImportar" value="Importar" />
        </div>
	    </label>
	</form>
	<div><span class="tf1">Arquivos dos periodos encerrados:</span><br />
	  <br />
	  <br />
	  <div id="links"></div>
	</div>
	</body>
</html>
