<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {font-family: "Times New Roman", Times, serif}
.style3 {font-size: 14px; }
.style4 {font-size: 14}
-->
</style>
</head>

<body>
<table width="595" border="1" bordercolor="#000000">
  <tr>
    <td width="638" class="style1"><div align="center">Prefeitura Municipal de Teresina<br />
    Secretaria Municipal de Administra&ccedil;&atilde;o</div></td>
  </tr>
  <tr>
    <td><div align="center"><br />
      Divis&atilde;o de folha de Pagameto - Nucleo de Informatica<br />
    Espelho do Contra-cheque referente ao mes de '.$this->appDateMaker($this->date1).'</div></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
        <tr>
          <td width="43"><div align="right" class="style3">Nome </div></td>
          <td width="10"><div align="center" class="style3">:</div></td>
          <td colspan="3"><span class="style3">'.$infos[&quot;nome&quot;].'</span></td>
          <td width="62"><div align="right" class="style3">Matr&iacute;cula:</div></td>
          <td width="125"><span class="style3">'.$infos[&quot;matricula&quot;].'</span></td>
        </tr>
        <tr>
          <td><div align="right" class="style3">'.$infos<br />
          ["lotac<br />
          ao"].'</div></td>
          <td><div align="center" class="style3">-</div></td>
          <td width="248"><span class="style3">'.$infos[&quot;secretaria&quot;].'</span></td>
          <td width="7"><span class="style3">-</span></td>
          <td colspan="3"><span class="style3">'.$infos[&quot;descricao_secretaria&quot;].'</span></td>
        </tr>
        <tr>
          <td><div align="right" class="style3">Cargo </div></td>
          <td><div align="center" class="style3">:</div></td>
          <td colspan="3"><span class="style3">'.$infos[&quot;descricao_cargo&quot;].'</span></td>
          <td><div align="right" class="style3">N&iacute;vel:</div></td>
          <td><span class="style3">'.$infos[&quot;nivel&quot;].'</span></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="12%" class="style4"><div align="right">'.$infos[0].'</div></td>
        <td width="2%" class="style4"> <div align="center">-</div></td>
        <td width="54%" class="style4">'.$infos[1].'</td>
        <td width="32%" class="style4">R$ '.$infos[2].'</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="63%" class="style4"><div align="right">Proventos:</div></td>
        <td width="37%" class="style4">R$ '.$infos[&quot;proventos&quot;].'</td>
      </tr>
      <tr>
        <td class="style4"><div align="right">Descontos:</div></td>
        <td class="style4">R$ '.$infos[&quot;descontos&quot;].'</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="63%" class="style4"><div align="right">L&iacute;quido:</div></td>
        <td width="37%" class="style4">R$ '.$infos[&quot;liquido&quot;].'</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><div align="right"><br />
      <br />
      <br />
    Gerado via WEB. </div></td>
  </tr>
</table>
</body>
</html>
