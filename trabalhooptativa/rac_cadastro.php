<?php
	include_once("classes/Conexao.class.php");		
	// Eu queria fazer uma consulta e retornar num form a lista com os nomes dos clientes
	$conexao = new Conexao();    
	$comandoSQL = "SELECT * FROM cliente";
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
    <input type="text" name="tf_protocolo" id="tf_protocolo">
  </p>
  <p>
    cliente
    <input type="text" name="tf_cliente" id="tf_cliente">
    <select name="select" id="select">
	<?php
	//pegando os dados
	while($dados = mysql_fetch_array($resultado)){    //mostrando eles (dados) em forma de options
    echo('<option value="'.$dados['cliente_id'].'"> '.$dados['nome'].'</option>');
	}
	?> </select>
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