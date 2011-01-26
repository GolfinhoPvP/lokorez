<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../utils/ConectarMySQL.class.php");
	$slAveRef = isset($_POST["slAveRef"]) ? $_POST["slAveRef"] : NULL;

	if($slAveRef != NULL){
		$conexao = new ConectarMySQL();
		include_once("../../dao/DAOAverbacao.class.php");
		include_once("../../dao/DAOLog.class.php");
		$dao = new DAOAverbacao( NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, "../../", $conexao);
		$log = new DAOLog($_SESSION["pessoa"], 7, $_SESSION["nivel"], $_SESSION["codigo"], 12, "id=\'".$slEmpRef."\'", "../../", $conexao);
		if($dao->deletar($slAveRef) && $log->cadastrar())
			$conexao->commit();
		else
			$conexao->rollback();
		header("Location: altAverbacao.php?can=ok");
		die();
	}
	$can = isset($_GET["can"]) ? $_GET["can"] : NULL;
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
			 	loadContent('../pesquisar/getAverbacoesSL.php', 'slAveRef', '../../');
			}
		</script>
	</head>
	<body>
		<?php
			if($can != NULL){
				$tipo = "can";
				$toRoot = "../../";
				include("../../includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
			
			$data = date("Y-m-d");
			$dataMenor = $data." 00:00:00";
			$dataMaior = $data."24:59:59";
			
			$conexao = new ConectarMySQL();
			$sql = "SELECT distinct pes.pes_nome, ser.ser_matricula, emp.emp_descricao, ave.ave_numero_parcelas, ave.ave_taxa_juros, ave.ave_montante, par.par_valor, ave.ave_numero_externo FROM averbacoes ave INNER JOIN servidores ser ON ave.pes_codigo = ser.pes_codigo INNER JOIN empresas emp ON ser.emp_codigo = emp.emp_codigo INNER JOIN pessoas pes ON ser.pes_codigo = pes.pes_codigo INNER JOIN parcelas par ON ave.ave_numero_externo = par.ave_numero_externo WHERE ave.ave_data_criacao > '".$dataMenor."' AND ave.ave_data_criacao < '".$dataMaior."'";
			$resultado = $conexao->selecionar($sql);
			while($linha = mysqli_fetch_array($resultado)){
				include("../modeloAverbacaoCancelar.php");
			}
			$conexao->commit();			
		?>
		<br/>
		<div id="alt" style="visibility:hidden; position:absolute">
		</div><div id="carregando">
		</div>
		<form id="empresaAlterar" name="empresaAlterar" method="post" action="#" onsubmit="javascript: return validarAlterarEmpresa('empresaAlterar');">
		  <div><span class="texto2">
		  Selecione a averva&ccedil;&atilde;o a ser cancelada:</span> 
		    <select name="slAveRef" class="tf1" id="slAveRef" >
		    <option value="---">-----------------------------</option>
	      </select></div>
		  <div align="center"><br />
		    <input name="btCancelar" type="submit" class="bt1" id="btCancelar" value="Cancelar" />
		    <br />
		    <br />
		    <br />
		    <br />
		    <br />
		    <br />
		    <br />
		    <br />
		    <br />
		  </div>
		</form>
	</body>
</html>
