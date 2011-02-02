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
			if($cadastrar == true){
				$tipo = "cad";
				include($toRoot."includes/confirmar.php");
			}else{
				echo('<div id="confirmar"></div>');
			}
		?>
		<div id="confirmar"></div>
		<div id="altBan">
			<form id="cadastrar" name="cadastrar" method="post" action="adminMaster.php?alterar=banco" onsubmit="javascript: return validarCadastro();">
						<div align="center" class="botao1">Alterar configura&ccedil;&atilde;o do Banco de Dados </div>
					  <div class="texto3" id="altBanHos">Host: 
						<input name="tfBanHos" value="<?php echo($xml->bancoDeDados->host); ?>" type="text" class="textField1" id="tfBanHos" size="75" maxlength="150" onkeyup="javascript: validarForm('tfNom');" /></div>
					  <div class="texto3" id="altBanNomUsu">Nome de usu&aacute;rio : 
						<input name="tfBanNomUsu" value="<?php echo($xml->bancoDeDados->nomeUsuario); ?>" type="text" class="textField1" id="tfBanNomUsu" size="50" maxlength="50" onkeyup="javascript: validarForm('tfRG');"/>
					  </div>
					  <div class="texto3" id="altBanSen">Senha: 
						<input name="tfBanSen" value="<?php echo($xml->bancoDeDados->senha); ?>" type="password" class="textField1" id="tfBanSen" size="50" maxlength="50" onkeyup="javascript: validarForm('tfCPF');"/>
					  </div>
					  <div class="texto3" id="altBanNom">Nome do banco: 
						<input name="tfBanNomBan" value="<?php echo($xml->bancoDeDados->nomeBanco); ?>" type="text" class="textField1" id="tfBanNomBan" size="50" maxlength="50" onkeyup="javascript: validarForm('tfCPF');"/>
					  </div>
					  <div class="texto3" id="altBanSenMas">Senha adm. master: 
						<input name="tfSenMas" value="<?php echo($xml->bancoDeDados->host); ?>" type="password" class="textField1" id="tfSenMas" size="30" maxlength="15" onkeyup="javascript: validarForm('tfCPF');"/>
			  </div>
			    	<div id="altBanBut">
					  <input name="btAltBan" type="submit" class="botao2" id="btAltBan" value="Alterar" />
			  </div>
		  </form>      
</div>
		  <div id="cadCliTel">
		  	<div class="texto3" id="cadCliTelNum">Telefone: 
	  	    <input name="tfFonNum" type="text" class="textField1" id="tfFonNum" size="30" maxlength="12" onkeyup="javascript: validarForm('tfFonNum');"/>
		  	</div>
			  <div class="texto3" id="cadCliTelNot">Nota: 
		      <input name="tfFonNot" type="text" class="textField1" id="tfFonNot" size="30" maxlength="30" onkeyup="javascript: validarForm('tfFonNot');"/>
		    </div>
		  </div>
		  <div id="cadCliEml">
		  	<div class="texto3" id="cadCliEmlURL">Email: <input name="tfEmlURL" type="text" class="textField1" id="tfEmlURL" size="30" maxlength="50" onkeyup="javascript: validarForm('tfEmlURL');"/>
		  	</div>
			  <div class="texto3" id="cadCliEmlNot">Nota: 
		      <input name="tfEmlNot" type="text" class="textField1" id="tfEmlNot" size="30" maxlength="50" onkeyup="javascript: validarForm('tfEmlNot');"/>
		    </div>
		  </div>
		  <div id="cadCli">
			  <div class="texto3" id="cadCliNomUsu">Nome de usu&aacute;rio: 
	        <input name="tfNomUsu" type="text" class="textField1" id="tfNomUsu" size="75" maxlength="150" onkeyup="javascript: validarForm('tfNomUsu');"/>
		    </div>
			  <div class="texto3" id="cadCliSen1">Senha: 
		      <input name="tfSen1" type="password" class="textField1" id="tfSen1" size="30" maxlength="15" onkeyup="javascript: validarForm('tfSen1');"/>
		    </div>
			  <div class="texto3" id="cadCliSen2">Confirme a senha: 
		      <input name="tfSen2" type="password" class="textField1" id="tfSen2" size="30" maxlength="15" onkeyup="javascript: validarSenhas();"/>
		    </div>
		  </div>
		  <?php
		  if($_SESSION["nivel"] != 1){
			  echo('
			  <div class="texto3" id="cadCliFun">
				<div id="cadCliFunEmpRel">Empresa relacionada: 
				<select name="slEmp" class="textField1" id="slEmp">');
				include($toRoot."utils/getEmpresasSL.php");
				echo('</select>
				</div>
				<div id="cadCliFunCla">N&iacute;vel: 
					<select name="slCla" class="textField1" id="slCla">
					  <option value="---" selected="selected">------------</option>
					  <option value="3">Master</option>
					  <option value="4">Simples</option>
					</select>
				</div>
			  </div>');
		  }
		  ?>
</body>
</html>
