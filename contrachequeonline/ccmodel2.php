<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
#table{
	border-top-style: ridge;
	border-right-style: ridge;
	border-bottom-style: ridge;
	border-left-style: ridge;
	border-top-width: medium;
	border-right-width: medium;
	border-bottom-width: medium;
	border-left-width: medium;
}
.style1 {font-family: Arial, Helvetica, sans-serif}
.style2 {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
	font-size: 14px;
}
.style3 {font-size: 12px}
.style4 {font-family: Georgia, "Times New Roman", Times, serif}
.style5 {font-size: 13px; font-family: Georgia, "Times New Roman", Times, serif; }
.style6 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
-->
</style>
</head>

<body>
<table width="595" border="1" cellpadding="0" cellspacing="0" id="table">
  <tr>
    <td width="638" class="style1"><table width="586">
      <tr>
      <td width="73"><div align="center"><img src="images/brasao_bw.png" width="59" height="71" /></div></td>
      <td width="375"><div align="center" class="style2">Prefeitura Municipal de Teresina<br />
    Secretaria Municipal de Administra&ccedil;&atilde;o</div></td><td width="122"><div align="right"><img src="images/fms_logo_bw.png" width="121" height="35" /></div></td>
    </tr></table>
    </td>
  </tr>
  <tr>
    <td><div align="center"><br />
        <span class="style5">Divis&atilde;o de folha de Pagameto - Nucleo de Informatica<br />
        Espelho do Contra-cheque referente ao mes de '.$this->appDateMaker($this->date1).'</span></div></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
        <tr>
          <td width="43" class="style5"><div align="right" class="style3">Nome </div></td>
          <td width="10" class="style5"><div align="center" class="style3">:</div></td>
          <td colspan="3" class="style5"><span class="style3">'.$infos[&quot;nome&quot;].'</span></td>
          <td width="62" class="style5"><div align="right" class="style3">Matr&iacute;cula:</div></td>
          <td width="125" class="style5"><span class="style3">'.$infos[&quot;matricula&quot;].'</span></td>
        </tr>
        <tr>
          <td class="style5"><div align="right" class="style3">'.$infos<br />
          ["lotac<br />
          ao"].'</div></td>
          <td class="style5"><div align="center" class="style3">-</div></td>
          <td width="248" class="style5"><span class="style3">'.$infos[&quot;secretaria&quot;].'</span></td>
          <td width="7" class="style5"><span class="style3">-</span></td>
          <td colspan="3" class="style5"><span class="style3">'.$infos[&quot;descricao_secretaria&quot;].'</span></td>
        </tr>
        <tr>
          <td class="style5"><div align="right" class="style3">Cargo </div></td>
          <td class="style5"><div align="center" class="style3">:</div></td>
          <td colspan="3" class="style5"><span class="style3">'.$infos[&quot;descricao_cargo&quot;].'</span></td>
          <td class="style5"><div align="right" class="style3">N&iacute;vel:</div></td>
          <td class="style5"><span class="style3">'.$infos[&quot;nivel&quot;].'</span></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="12%" class="style4"><div align="right" class="style6">'.$infos[0].'</div></td>
        <td width="2%" class="style4"> <div align="center" class="style6">-</div></td>
        <td width="54%" class="style6">'.$infos[1].'</td>
        <td width="32%" class="style6">R$ '.$infos[2].'</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="63%" class="style6"><div align="right">Proventos:</div></td>
        <td width="37%" class="style6">R$ '.$infos[&quot;proventos&quot;].'</td>
      </tr>
      <tr>
        <td class="style6"><div align="right">Descontos:</div></td>
        <td class="style6">R$ '.$infos[&quot;descontos&quot;].'</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="63%" class="style6"><div align="right">L&iacute;quido:</div></td>
        <td width="37%" class="style6">R$ '.$infos[&quot;liquido&quot;].'</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><div align="right"><br />
      <br />
      <br />
      <span class="style2">Gerado via WEB. </span></div></td>
  </tr>
</table>
</body>
</html>
