<?php
	session_start();
	
	require_once("utils/Connect.class.php");
	include_once("beans/Variables.class.php");
	
	$variables = new Variables();
	$connect = new Connect($variables->dbHost, $variables->dbUser, $variables->dbPassword, $variables->dbName);
	$connect->start();

	$login	= "visible";
	$search = "hidden";
	if((isset($_GET["ok"]) == "true") && isset($_SESSION["user"])){
		$login	= "hidden";
		$search = "visible";
	}else{
		$mesage = "Acesso não permitido!";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<div><?php echo($mesage); ?></div>
<form id="desconectForm" name="desconectForm" method="post" action="actions/Logout.class.php">
	<label>
	<input name="desconect" type="submit" id="desconect" value="Desconectar" />
	</label>
</form>
<form id="login" name="form1" method="post" action="actions/UserLogin.class.php" style="visibility:<?php echo($login); ?>">
  <label>
  <select name="select">
	<option>Escolha</option>
	<?php
		$result = $connect->execute("SELECT nome FROM Folhas");
		
		while($row = mysql_fetch_assoc($result)) {
			echo("<option>".$row["nome"]."</option>");
		}
		
		$connect->close();
	?>
  </select><br />
  Matr&iacute;cula:
  <input name="tfMatricula" type="text" id="tfMatricula" size="20" maxlength="50" />
  </label>
  <br />
  <label>
  Senha: 
  <input name="tfPassword" type="password" id="tfPassword" size="20" maxlength="25" />
  </label>
  <p>
    <label>
    <input name="connect" type="submit" id="connect" value="Conectar" />
    </label>
  </p>
</form>
<p>&nbsp;</p>
<form id="search" name="form2" method="post" action="utils/ContrachequeMaker.class.php" style="visibility:<?php echo($search); ?>">
  <label>
  Contracheques a partir de:
  <input name="tfDate1" type="text" id="tfDate1" size="15" maxlength="10" />
  </label> 
  at&eacute; 
  <label>
  <input name="tfDate2" type="text" id="tfDate2" size="15" maxlength="10" />
  </label> 
  . 
  <label>
  <input name="search" type="submit" id="search" value="Pesquisar" />
  </label>
</form>
<p>&nbsp;</p>
</body>
</html>
