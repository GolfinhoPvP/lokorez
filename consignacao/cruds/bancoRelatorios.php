<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" language="javascript">
	function manipularPessoa(id){
		switch(id){
			case "btRelSintetico" : window.location = "pesquisar/getRelatorioSintetico.php"; break;
			case "btRelAnalitico" : window.location = "pesquisar/getRelatorioAnalitico.php"; break;
		}
	}
</script>
</head>

<body>
	<input name="btRelSintetico" type="submit" id="btRelSintetico" value="Ver relatório sintético" onclick="javascript: manipularPessoa('btRelSintetico');" />
  	<input name="btRelAnalitico" type="submit" id="btRelAnalitico" value="Ver relatório analítico" onclick="javascript: manipularPessoa('btRelAnalitico');" />
    <br />
    <br />
    <br />
    <form id="buscarCPF" name="buscarCPF" method="post" action="pesquisar/getRelatorioCPF.php">
      <label>
        <input name="tfCPF" type="text" id="tfCPF" size="16" maxlength="14" />
      </label>
      <br />
      <br />
      <input name="btBusCPF" type="submit" id="btBusCPF" value="Buscar por CPF"/>
    </form>
    <br />
    <br />
Relat&oacute;rio geral em .xls <img src="../imagens/xls.png" width="50" height="51" onclick="javascript: window.location = 'relatorioGeralXLS.php';" style="cursor:pointer"/>
<br />
Veja o esquema desse arquivo em PDF aqui <img src="../imagens/pdf.png" width="50" height="77" onclick="javascript: window.location = '../downloads/esquema-arquivo-xls.pdf';" style="cursor:pointer"/>
</body>
</html>
