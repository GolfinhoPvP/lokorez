<?php
	$banco = isset($_GET["banco"]) ? $_GET["banco"] : "*";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
		<script type="text/javascript" language="javascript">
			function manipularPessoa(id){
				switch(id){
					case "btCadContat" :
						window.location = "cadastrar/cadPessoa.php?tipo=contato&banco="+document.getElementById("valor").innerHTML;
						break;
					case "brAltContat" : break;
					case "brDelContat" : break;
				}
			}
		</script>
</head>

<body>
	<div id="valor" style="visibility:hidden"><?php echo($banco); ?></div>
  	<input name="btCadContat" type="submit" id="btCadContat" value="Cadastrar Contato!" onclick="javascript: manipularPessoa('btCadContat');" />
  	<input name="brAltContat" type="submit" id="brAltContat" value="Alterar Contato!" onclick="javascript: manipularPessoa('brAltContat');" />
  	<input name="brDelContat" type="submit" id="brDelContat" value="Deletar Contato!" onclick="javascript: manipularPessoa('brDelContat');" />
</body>
</html>
