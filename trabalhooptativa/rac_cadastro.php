<?php
	include_once("classes/Conexao.class.php");
	include_once("utilitarios/funcoes.php");
	$conexao = new Conexao();    
	$comandoSQL = "SELECT * FROM cliente ORDER BY nome ASC";
	$resultado = $conexao->pesquisar($comandoSQL);
	
	$cadastrado = isset($_GET['cadastrado']) ? $_GET['cadastrado'] : NULL;
	$mensagem = NULL;
	
	if($cadastrado == "sim"){
		$mensagem = "RAC cadastrado com sucesso!";
	}else if($cadastrado == "nao"){
		$mensagem = "RAC não foi cadastrado!";
	}
?>

<html>
	<head>
		<title>Relatorio de Atedimento</title>
	</head>
<body>
<?php echo($mensagem); ?><!-- IMPRIMINDO A MENSAGEM PARA O USUÁRIO -->
<form name="form1" method="post" action="rac_salvar.php">
  <p> protocolo
    <input name="tf_protocolo" type="text" id="tf_protocolo" size="15" value="<?php echo(geradorProtocolo()); ?>" >
  </p>
  <p>
    cliente
    <select name="cbCliente" id="cbCliente">
	<?php
	while($dados = mysql_fetch_array($resultado)){
	   	echo('<option value="'.$dados['cliente_id'].'"> '.$dados['nome'].'</option>');
	}
	?>
    </select>
  </p>
  <p>
    status
    <input name="tf_status_id" type="text" disabled id="tf_status_id" value="Pendente">
  </p>
  <p>
    reclamaçao
    <textarea name="ta_reclamacao" id="ta_reclamacao"></textarea>
  </p>
  <p>
    <input type="submit" name="enviar" id="enviar" value="enviar">
    <input type="reset" name="limpar" id="limpar" value="Limpar">
  </p>
</form>
</body>
</html>