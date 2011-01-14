<?php
	session_start();
	if(isset($_SESSION["codigo"])){
		header("Location: utils/desconectar.php");
		die();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Servi&ccedil;o de Consigna&ccedil;&atilde;o</title>
		<style type="text/css">
			body{
				margin-left:0;
				margin-top:0;
			}
		</style>
		<script type="text/javascript" language="javascript">
			window.onload = function(){
				largura = screen.availWidth - 100;
				altura = screen.availHeight - 150;
				document.getElementById("main").style.width = largura+"px";
				document.getElementById("main").style.height = altura+"px";
				document.body.style.visibility = "visible";
			}
		</script>
	</head>
	
	<body style="visibility:hidden">
		<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td align="center" valign="middle"><iframe id="main" name="main" width="750" height="500" frameborder="0" src="main.php"></iframe></td>
		  </tr>
		</table>
	</body>
</html>
