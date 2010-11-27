<html>
<head>
<title>Relatorio de Atedimento</title>
</head>
<form name="form1" method="post" action="rac_salvar.php">
  <p> protocolo
    <input name="tf_protocolo" type="text" disabled id="tf_protocolo">
  </p>
  <p>
    cliente
    <input name="tf_cliente" type="text" disabled id="tf_cliente">
  </p>
  <p>
    status
      <select name="lm_status" id="lm_status">
            </select>
  </p>
  <p>
    reclamaçao
    <textarea name="ta_reclamaçao" disabled id="ta_reclamaçao"></textarea>
  </p>
  <p>soluçao
    <textarea name="textfield" id="textfield"></textarea>
</p>
  <p>anotaçoes
    <input type="text" name="textfield2" id="textfield2">
  </p>
  <p>
    <input type="button" name="editar" id="editar" value="editar">
    <input type="submit" name="enviar" id="enviar" value="enviar">
  </p>
</form>
</html>