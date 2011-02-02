<?php
	include("adminMasterInclude.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="scripts/css/adminMaster.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" language="javascript" src="scripts/javascript/funcoes.js"></script>
		<script type="text/javascript" language="javascript" src="scripts/javascript/adminMaster.js"></script>
	</head>
	
<body>
		<?php
			if($alterar == "sim"){
				$tipo = "alt";
				include($toRoot."includes/confirmar.php");
			}else if($alterar == "nao"){
				$tipo = "alt";
				include($toRoot."includes/negar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<div id="voltar" title="Voltar"><img style="cursor:pointer" onclick="javascript: location.href = 'login.php';" src="imagens/desconectar.png" /></div>
		<div id="altBan">
			<form id="alterarBanco" name="alterarBanco" method="post" action="adminMaster.php?alterar=banco" onsubmit="javascript: return validarCadastro();">
						<div align="center" class="botao1">Alterar configura&ccedil;&atilde;o do Banco de Dados </div>
					  <div class="texto3" id="altBanHos">Host: 
			  <input name="tfBanHos" value="<?php echo($xml->bancoDeDados->host); ?>" type="text" class="textField1" id="tfBanHos" size="50" maxlength="100" onkeyup="javascript: validarForm('tfBanHos');" />
			  </div>
			  		<div class="texto3" id="altBanSen">Senha: 
						<input name="tfBanSen" value="<?php echo($xml->bancoDeDados->senha); ?>" type="password" class="textField1" id="tfBanSen" size="25" maxlength="30" onkeyup="javascript: validarForm('tfBanSen');"/>
					  </div>
					  <div class="texto3" id="altBanNomUsu">Nome de usu&aacute;rio : 
						<input name="tfBanNomUsu" value="<?php echo($xml->bancoDeDados->nomeUsuario); ?>" type="text" class="textField1" id="tfBanNomUsu" size="25" maxlength="50" onkeyup="javascript: validarForm('tfBanNomUsu');"/>
					  </div>
					  <div class="texto3" id="altBanNom">Nome do banco: 
						<input name="tfBanNomBan" value="<?php echo($xml->bancoDeDados->nomeBanco); ?>" type="text" class="textField1" id="tfBanNomBan" size="25" maxlength="30" onkeyup="javascript: validarForm('tfBanNomBan');"/>
			  </div>
					  <div class="texto3" id="altBanSenMas">Senha adm. master: 
						<input name="tfSenMas" value="<?php echo($xml->bancoDeDados->host); ?>" type="password" class="textField1" id="tfSenMas" size="30" maxlength="15" onkeyup="javascript: validarForm('tfSenMas');"/>
			  </div>
			    	<div id="altBanBut">
					  <input name="btAltBan" type="submit" class="botao2" id="btAltBan" value="Alterar" />
			  </div>
		  </form>      
</div>
<div id="altSta">
		<form id="alterarStatus" name="alterarStatus" method="post" action="adminMaster.php?alterar=status">
			<div align="center" class="botao1">Alterar status do Sistema </div>
		  	<div class="texto3" id="altStaVal">
		  	      Status:
		  	      <select name="slSta" class="textField1" id="slSta">
		  	        <option value="---" selected="selected">---</option>
		  	        <option value="online">Online</option>
		  	        <option value="offline">Offline</option>
              </select>
		  </div>
		  <div class="texto3" id="altStaSenMas">Senha adm. master: 
						<input name="tfSenMas" value="<?php echo($xml->bancoDeDados->host); ?>" type="password" class="textField1" id="tfSenMas" size="30" maxlength="15" onkeyup="javascript: validarForm('tfSenMas');"/>
		  </div>
			<div id="altStaBut">
					  <input name="btAltBan" type="submit" class="botao2" id="btAltBan" value="Alterar" />
		  </div>
	  	</form>
</div>
		  <div id="altMas">
		  <form id="alterarMaster" name="alterarMaster" method="post" action="adminMaster.php?alterar=master">
		  		<div align="center" class="botao1">Alterar Configura&ccedil;&atilde;o do administrador Master </div>
			  <div class="texto3" id="altMasNomUsu">Nome de usu&aacute;rio: 
	        <input name="tfNomUsu" type="text" class="textField1" id="tfNomUsu" size="75" maxlength="150" onkeyup="javascript: validarForm('tfNomUsu');"/>
		    </div>
			  <div class="texto3" id="altMasSen1">Senha: 
		      <input name="tfSen1" type="password" class="textField1" id="tfSen1" size="30" maxlength="15" onkeyup="javascript: validarForm('tfSen1');"/>
		    </div>
			  <div class="texto3" id="altMasSen2">Confirme a senha: 
		      <input name="tfSen2" type="password" class="textField1" id="tfSen2" size="30" maxlength="15" onkeyup="javascript: validarSenhas();"/>
		    </div>
			<div class="texto3" id="altMasSenMas">Senha adm. master: 
						<input name="tfSenMas" value="<?php echo($xml->bancoDeDados->host); ?>" type="password" class="textField1" id="tfSenMas" size="30" maxlength="15" onkeyup="javascript: validarForm('tfSenMas');"/>
		  </div>
			<div id="altMasBut">
					  <input name="btAltBan" type="submit" class="botao2" id="btAltBan" value="Alterar" />
		  </div>
         </form>
</div>
</body>
</html>
