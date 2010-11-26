Creditos JavaScript ---> AJ
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script language="javascript" type="text/javascript">
	function verificar(){
		if((document.form1.operador2.value == 0) && (document.form1.div.value == "/") && (document.form1.operador2.value.trim() != '')) {
			alert("Erro: Divisao por 'ZERO'");
				return false;
		}else{
			document.formulario.submit;
				return true;
		}
	}
</script>
</head>
<?php

	$op1 	= @$_POST[operador1];
	$op2 	= @$_POST[operador2];
	
function verificar(){

}

function get_post_action($name)
{
    $params = func_get_args();
    
    foreach ($params as $name) {
        if (isset($_POST[$name])) {
            return $name;
        }
    }
}

function calcular( $op1, $op2){

switch (get_post_action('som', 'sub', 'mul', 'div', 'exp' )) {
    case 'som':
        $resultado = $op1 + $op2;
        break;    
    case 'sub':
        $resultado = $op1 - $op2;
        break;
    case 'mul':
		$resultado = $op1 * $op2;
        break;
	case 'div':
        if ($op2 === 0)
			return( "Erro div por 0");
		else
			$resultado = $op1 / $op2;
        break;
	case 'exp':
        $resultado = pow($op1, $op2);
        break;
    default:
		$resultado = 0;

}	
return($resultado);

}
?>
<body>

<p><a href="index.html">voltar</a></p>
<form id="form1" name="form1" method="post" action="#">
  <label> OP1
  <input name="operador1" type="text" id="operando1" size="10" maxlength="8" />
  </label>
  <label>
  <input type="submit" name="som" id="soma" value="+" />
  <input type="submit" name="sub" id="subtraçao" value="-" />
  <input type="submit" name="mul" id="multplicaçao" value="*" />
  </label>
  <p>OP2
    <label>
      <input name="operador2" type="text" id="operando2" size="10" maxlength="8" />
      </label>
      <label></label>
      <input type="submit" name="div" id="divisao" value="/" onmouseover="verificar()"/>
      <input type="submit" name="exp" id="exponenciaçao" value="x^y" />
  </p>
  <p>RES
    <input name="resultado" type="text" disabled="disabled" id="resultado" size="20" maxlength="20" 
    value = "
	<?php 
	 echo ("=".calcular($op1, $op2)) ;?>"/>
      <label></label>
      <input type="reset" name="button6" id="button6" value="Reset" />
  </p>
</form>
<p>&nbsp;</p>
<p>&nbsp; </p>
</body>
</html>
