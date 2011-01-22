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
    <form id="buscarCPF" name="buscarCPF" method="post" action="">
      <label>
        <input name="tfCPF" type="text" id="tfCPF" size="16" maxlength="14" />
      </label>
      <br />
      <br />
      <input name="btBusCPF" type="submit" id="btBusCPF" value="Buscar por CPF"/>
    </form>
</body>
</html>
