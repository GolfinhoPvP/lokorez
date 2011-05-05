<?php
	include("cadClienteInclude.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../../scripts/css/geral.css" rel="stylesheet" type="text/css" />
		<link href="../../scripts/css/cliente.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/funcoes.js"></script>
		<script type="text/javascript" language="javascript" src="../../scripts/javascript/cliente.js"></script>
		<script type="text/javascript" language="javascript">
			window.onload = function(){
				alternar();
			}
		</script>
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
		<div id="cadCliGer">
		<form id="cadastrar" name="cadastrar" method="post" action="cadCliente.php?cadastrar=sim" onsubmit="javascript: return validarCadastro();">
			<div class="texto3" id="cadCliNov">Contato novo? 
			  <input name="cbSel" type="checkbox" class="textField1" id="cbSel" onchange="javascript: alternar();" value="novo" />
			</div>
			<div class="texto3" id="cadCliPesRef">Selecione uma pessoa:
		  <select name="slPes" class="textField1" id="slPes">
		  		<?php
					include($toRoot."utils/getPessoaSL.php");
				?>
		  </select>
		  </div>
			<div id="cadCliPes">
			  <div class="texto3" id="cadCliPesNom">Nome: 
		      <input name="tfNom" type="text" class="textField1" id="tfNom" size="75" maxlength="150" onkeyup="javascript: validarForm('tfNom');" /></div>
			  <div class="texto3" id="cadCliPesRG">RG: 
		      <input name="tfRG" type="text" class="textField1" id="tfRG" size="30" maxlength="30" onkeyup="javascript: validarForm('tfRG');"/>
			  </div>
		      <div class="texto3" id="cadCliPesCPF">CPF: 
		      <input name="tfCPF" type="text" class="textField1" id="tfCPF" size="30" maxlength="14" onkeyup="javascript: validarForm('tfCPF');"/>
			  </div>
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
		      <input name="tfEmlNot" type="text" class="textField1" id="tfEmlNot" onkeyup="javascript: validarForm('tfEmlNot');" size="30" maxlength="50"/>
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
				include($toRoot."utils/getEmpresaSL.php");
				echo('</select>
				</div>
				<div id="cadCliFunCla">N&iacute;vel: 
					<select name="slCla" class="textField1" id="slCla">
					  <option value="---" selected="selected">------------</option>');
					  if($_SESSION["nivel"] != 3)
					  		echo('<option value="3">Master</option>');
					  echo('<option value="4">Simples</option>
					</select>
				</div>
			  </div>');
		  }
		  ?>
		  <div id="cadCliBut">
	      <input name="btCad" type="submit" class="botao2" id="btCad" value="Cadastrar" /></div>
		</form>
	</div>
	</body>
</html>