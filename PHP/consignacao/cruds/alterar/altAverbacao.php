<?php
	session_start();
	$nivelAcesso = "../../:2:4";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../utils/funcoes.php");
	$slAveRef = antiSQL(isset($_POST["slAveRef"]) ? $_POST["slAveRef"] : NULL);

	if($slAveRef != NULL){
		include_once("../../utils/ConectarMySQL.class.php");
		include_once("../../dao/DAOParcela.class.php");
		include_once("../../dao/DAOServidor.class.php");
		include_once("../../dao/DAOLog.class.php");
		include_once("../../beans/Parcela.class.php");
		include_once("../../beans/Servidor.class.php");
		$comitar = true;
		$conexao = new ConectarMySQL();
		
		$sql = "UPDATE averbacoes SET sta_codigo = 3 WHERE ave_numero_externo = '".$slAveRef."'";
		$log = new DAOLog($_SESSION["pessoa"], 4, $_SESSION["nivel"], $_SESSION["codigo"], 12, "id=\'".$slEmpRef."\'", "../../", $conexao);
		if(!$log->cadastrar() || !$conexao->executar($sql))
			$comitar = false;
			
		$sql = "UPDATE parcelas SET sta_codigo = 4 WHERE ave_numero_externo = '".$slAveRef."'";
		$log = new DAOLog($_SESSION["pessoa"], 4, $_SESSION["nivel"], $_SESSION["codigo"], 13, "id=\'".$slEmpRef."\'", "../../", $conexao);
		if(!$log->cadastrar() || !$conexao->executar($sql))
			$comitar = false;
			
		$sql = "SELECT pes_codigo, ave_numero_parcelas FROM averbacoes WHERE ave_numero_externo = '".$slAveRef."'";
		$resultado = $conexao->selecionar($sql);
		$linha = mysqli_fetch_array($resultado);
			
		$dao = new DAOParcela(NULL, NULL, NULL, NULL, NULL, "../../", $conexao);
		$parcela = new Parcela(NULL, NULL, NULL, NULL, NULL);
		$parcela = $dao->getParcela("%", $slAveRef);

		$dao = new DAOServidor(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, "../../", $conexao);
		$servidor = new Servidor(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
		$servidor = $dao->getServidor($linha["pes_codigo"], "%");
		$servidor->setUtilizada($servidor->getUtilizada()-$parcela->getValor());
		$servidor->setDisponivel($servidor->getDisponivel()+$parcela->getValor());
		$dao->setServidor($servidor);
		if(!$dao->alterar($servidor->getPesCodigo().":".$servidor->getMatricula())){
			$comitar = false;
		}
		
		if($comitar == true)
			$conexao->commit();
		else
			$conexao->rollback();
		header("Location: altAverbacao.php?liq=ok");
		die();
	}
	$liq = antiSQL(isset($_GET["liq"]) ? $_GET["liq"] : NULL);
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
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/empresa.js"></script>
		<script type="text/javascript" language="javascript">
			 window.onload = function(){
			 	loadContent('../pesquisar/getAverbacoesSL.php?status=aberto', 'slAveRef', '../../');
			}
		</script>
	</head>
	<body>
		<?php
			if($liq != NULL){
				$tipo = "liq";
				$toRoot = "../../";
				include("../../includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}		
		?>
		<br/>
		<div id="alt" style="visibility:hidden; position:absolute">
		</div><div id="carregando">
		</div>
		<form id="empresaAlterar" name="empresaAlterar" method="post" action="#" onsubmit="javascript: return validarAlterarEmpresa('empresaAlterar');">
		  <div><span class="texto2">
		  Selecione a averva&ccedil;&atilde;o a ser liquidada:</span> 
		    <select name="slAveRef" class="tf1" id="slAveRef" >
		    <option value="---">-----------------------------</option>
	      </select></div>
		  <div align="center"><br />
		    <input name="btLiquidar" type="submit" class="bt1" id="btLiquidar" value="Liquidar" />
		  </div>
		</form>
	</body>
</html>
