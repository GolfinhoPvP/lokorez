<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
	include_once("../../utils/funcoes.php");
?>
<table width="432" border="0" cellpadding="0" cellspacing="0" class="texto2">
  <tr>
	<td width="54" style="background-repeat:repeat-x"><span style="background-position:top; background-repeat:no-repeat"><img src="../../imagens/box2_c_1.png" width="53" height="22" /></span></td>
	<td width="657" height="19" background="../../imagens/box2_b_1.png" style="background-repeat:repeat-x">&nbsp;</td>
	<td width="25"><img src="../../imagens/box2_c_2.png" width="25" height="22" /></td>
  </tr>
  <tr>
	<td background="../../imagens/box2_b_4.png" style="background-repeat:repeat-y">&nbsp;</td>
	<td height="19" >Nome: <?php echo($pessoa->getNome()); ?>, CPF: <?php echo($pessoa->getCPF()); ?><br/>
	<?php
		switch($slTipo){
			case "admin" : 
				echo("Nome de usu�rio: ".$administrador->getNomeUsuario()."<br/>Senha: ".decodificar($administrador->getSenha()));
				break;
			case "contato" :
				echo("Contato do banco: ".$banco->getDescricao());
				break;
		}
		echo("<br/> N�mero de contato:");
		$sql = "SELECT tel_numero FROM telefones WHERE pes_codigo=".$pessoa->getCodigo();
		$resultado2 = $conexao->selecionar($sql);
		while($linha2 = mysqli_fetch_array($resultado2)){
			echo('<div>'.$linha2["tel_numero"].'</div>');
		}
	?>
	</td>
	<td background="../../imagens/box2_b_2.png" style="background-repeat:repeat-y">&nbsp;</td>
  </tr>
  <tr>
	<td rowspan="3" style="background-position:bottom; background-repeat:repeat-x;"><img src="../../imagens/box2_c_4.png" width="53" height="22" /></td>
	<td rowspan="3" background="../../imagens/box2_b_3.png" style="background-position:bottom; background-repeat:repeat-x;">&nbsp;</td>
	<td rowspan="3"><img src="../../imagens/box2_c_3.png" width="25" height="22" /></td>
  </tr>
  <tr>
  </tr>
</table>