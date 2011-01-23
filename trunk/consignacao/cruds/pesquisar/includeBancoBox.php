<?php
	session_start();
	$nivelAcesso = "../../:2:3:4";
	include_once("../../utils/controladorAcesso.php");
?>
<br/><table width="80%" border="0" cellpadding="0" cellspacing="0" class="texto2">
  <tr>
	<td width="54" style="background-repeat:repeat-x"><span style="background-position:top; background-repeat:no-repeat"><img src="../../imagens/box2_c_1.png" width="53" height="22" /></span></td>
	<td width="657" height="19" background="../../imagens/box2_b_1.png" style="background-repeat:repeat-x">&nbsp;</td>
	<td width="25"><img src="../../imagens/box2_c_2.png" width="25" height="22" /></td>
  </tr>
  <tr>
	<td background="../../imagens/box2_b_4.png" style="background-repeat:repeat-y">&nbsp;</td>
	<td height="19" ><div>C&oacute;digo: <?php echo($banco->getCodigo()); ?>, Nome: <?php echo($banco->getDescricao()); ?></div>
    <div>	<br/>
      <br />
      <?php 
					$sql = "SELECT p.pes_codigo, p.pes_nome, p.pes_cpf FROM bancos_pessoas bp INNER JOIN pessoas p ON bp.pes_codigo=p.pes_codigo WHERE bp.ban_codigo='".$slBancRef."'";
					$resultado = $conexao->selecionar($sql);
					echo('Contatos: <br/>');
					while($linha = mysqli_fetch_array($resultado)){
						echo('--------------------------<br/>
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
							  <tr>
								<td width="51%">Nome: '.$linha["pes_nome"].'</td>
								<td width="19%">CPF: '.$linha["pes_cpf"].'</td>
								<td width="30%">N&uacute;mero de Contato: ');
									$sql = "SELECT tel_numero FROM telefones WHERE pes_codigo=".$linha["pes_codigo"];
									$resultado2 = $conexao->selecionar($sql);
									while($linha2 = mysqli_fetch_array($resultado2)){
										echo('<div>'.$linha2["tel_numero"].'</div>');
								  	}
							  echo('</tr>
							</table>
						');
					} 
				?>
    </div></td>
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
