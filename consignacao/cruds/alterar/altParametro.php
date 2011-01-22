<?php
	session_start();
	include_once("../../utils/funcoes.php");
	$slPer = isset($_POST["slPer"]) ? $_POST["slPer"] : NULL;
	
	if($slPer != NULL){
		include_once("../../utils/ConectarDBF.class.php");
		$hash = getHash();
		$link = "downloads/".$hash."-".$slPer.".dbf";
		$uri = "../../".$link;
		$dbf = new ConectarDBF($uri, 1);
		$campos = array(
			array("periodo", 	"C", 8),
			array("empresa", 	"N", 6, 0),
			array("matricula", 	"C", 20),
			array("verba", 		"C", 10),
			array("valor", 		"N", 10, 2),
			array("status", 	"C", 10)
		);
		$dbf->criar($campos);
		
		include_once("../../utils/ConectarMySQL.class.php");
		$mysql = new ConectarMySQL();
		$sql = "SELECT p.par_periodo_parcela, a.emp_codigo, a.ser_matricula, v.ver_verba, p.par_valor, p.sta_codigo FROM parcelas p INNER JOIN averbacoes a ON p.ave_numero_externo=a.ave_numero_externo INNER JOIN verbas v ON v.ban_codigo=a.ban_codigo AND v.emp_codigo=a.emp_codigo AND v.pro_codigo=a.pro_codigo WHERE p.par_periodo_parcela='".$slPer."'";
		$resultado = $mysql->selecionar($sql);
		$comitar = false;
		while($linhaMySQL = mysqli_fetch_array($resultado)){
			$linhaDBF = array(
				$linhaMySQL["par_periodo_parcela"],
				$linhaMySQL["emp_codigo"],
				$linhaMySQL["ser_matricula"],
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
		$log = new DAOLog($_SESSION["pessoa"], 4, $_SESSION["nivel"], $_SESSION["codigo"], 11, "Encerrou=\'".$slPer."\'", "../../", $conexao);
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Untitled Document</title>
		<style type="text/css">
			<!--
			@import url("../../scripts/css/empresa.css");
			-->
		</style>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/ajax.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/parametro.js"></script>
		<script type="text/javascript" language="javascript">
			window.onload = function(){
				loadContent('../pesquisar/getParametrosSL.php', 'slPer', '../../');
				loadContent('../pesquisar/getLinks.php', 'links', '../../');
			}
		</script>
	</head>
	<body>
		<div id="carregando">
		</div>
		<form id="periodoEncerrar" name="periodoEncerrar" method="post" action="#" onsubmit="javascript: return validarParametroAltSubmit();">
		  <label>Encerrar per&iacute;odo : 
		  <select name="slPer" id="slPer">
		          <option value="---">--------</option>
          </select><br />
		  <input name="btEncerrar" type="submit" id="btEncerrar" value="Encerrar" />
		  </label>
    </form>
	<div>Arquivos dos periodos encerrados:<br />
	  <br />
	  <br />
	  <div id="links"></div>
	</div>
	</body>
</html>
