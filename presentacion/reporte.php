<?php
 if(isset($_POST["btnReporte"])){
	header("Location:index_excel.php");
	}
?>
<html>
<head>
<title>Sistema Bibliotecario UPS</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link href="/Registro_UPS/lib/template/style.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="76" background="/Registro_UPS/lib/template/images/index_01.gif"><table width="100%" border="0" cellspacing="10" cellpadding="0">
          <tr>
            <td width="20%" align="center"><a href="/Registro_UPS/presentacion/menuInicial.php" class="green-text"><strong>Inicio</strong></a></td>
            <td width="20%" align="center"><a href="#" class="green-text"><strong></strong></a></td>
            <td width="20%" align="center"><a href="#" class="green-text"><strong></strong></a></td>
            <td width="20%" align="center"><a href="#" class="green-text"><strong></strong></a></td>
            <td width="20%" align="center"><a href="#" class="green-text"><strong></strong></a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="37%" align="center"><table width="195" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="/Registro_UPS/lib/template/images/index_06.gif" width="195" height="26" alt=""></td>
              </tr>
              <tr>
                <td background="/Registro_UPS/lib/template/images/index_07.gif"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                  <tr>
                    <td><img src="/Registro_UPS/lib/template/images/index_09.gif" width="120" height="41" alt=""></td>
                  </tr>
                  <tr>
					<td class="white-text">Sistema para Registro de Personal. Desarrollado para:<a href="https://ofertaposgrados.ups.edu.ec/software" class="white-link-underline"> Maestría en Software </a></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td><img src="/Registro_UPS/lib/template/images/index_12.gif" width="195" height="25" alt=""></td>
              </tr>
            </table></td>
            <td width="63%" valign="top"><img src="/Registro_UPS/lib/template/images/index_03.jpg" width="504" height="286" alt=""></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="986" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="/Registro_UPS/lib/template/images/index_14.gif" width="986" height="26"></td>
          </tr>
          <tr>
            <td background="/Registro_UPS/lib/template/images/index_15.gif"><table width="100%" border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="33%" valign="center"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                  <tr>
				  <div align="center">
<?php
if (!isset($_SESSION))
    {
    	session_start();
    }
if ($_SESSION["autentificado"] != "SI") {
    //si no esta logueado lo envio a la pagina de autentificacion
    header("Location: index.php");
} else {
    //sino, calculamos el tiempo transcurrido
    $fechaGuardada = $_SESSION["last_access"];
    $ahora = date("Y-n-j H:i:s");
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
    //comparamos el tiempo transcurrido
     if($tiempo_transcurrido >= 600) {
     //si pasaron 10 minutos o mas
      session_destroy(); // destruyo la sesion
      header("Location: index.php"); //envio al usuario a la pag. de autenticacion
      //sino, actualizo la fecha de la sesion
    }else {
    $_SESSION["ultimoAcceso"] = $ahora;
   }
}
?>
<?php 
include_once"../dominio/usuario.php";
$_usua=new usuario();
$usu1=new usuario();
$usu2=new usuario();
$usu3=new usuario();
?>
<form id="form1" name="form1" method="post" action="">
<font color="#FFFFFF" size="4">Consulta Por Cedula:</font>
<input type="text" name="txtid" maxlength="10"/>
<input type="submit" name="btnBuscar" id="btnBuscar" value="Buscar"/>
<input type="submit" value="Excel" name="btnReporte" id="btnReporte"/>
<br>
<br>
<br>
<?php 
if(isset($_POST["btnBuscar"])){
$id=$_POST["txtid"];
$sumser=$usu1->resumen_visitasporservicio($id);
$sumdia=$usu2->resumen_visitaspordia($id);
$sumhor=$usu3->resumen_visitasporhorario($id);
echo '<table border="0" align="center"><caption><font size=4 color="#FFFFFF">Resumen de Asistencias</font></caption><tr>
<td><table width="286" border="1" cellspacing="1" cellpadding="1" bordercolor="#000000" bgcolor="#FFFFFF">
				  <tr>
					<td width="75%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">TIPO INGRESO</font></td>
					<td width="10%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">#</font></td>
					<td width="15%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">TOTAL</font></td>
				  </tr>';
  foreach($sumser as $fila4){
				  echo' <tr>
				<td><font color="#000000">'.$fila4["SERVICIO"].'</font></td>
				<td><font color="#000000">'.$fila4["VISITAS"].'</font></td>
				<td><font color="#000000">'.$fila4["PORCENTAJE"].'%</font></td>
			  </tr>';
	  }
	  echo  '</table></td>';
echo '<td><table width="286" border="1" cellspacing="1" cellpadding="1" bordercolor="#000000" bgcolor="#FFFFFF">
				  <tr>
					<td width="75%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">DIA DE LA SEMANA</font></td>
					<td width="10%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">#</font></td>
					<td width="15%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">TOTAL</font></td>
				  </tr>';
  foreach($sumdia as $fila5){
				  echo' <tr>
				<td><font color="#000000">'.$fila5["DIA"].'</font></td>
				<td><font color="#000000">'.$fila5["VISITAS"].'</font></td>
				<td><font color="#000000">'.$fila5["PORCENTAJE"].'%</font></td>
			  </tr>';
	  }
	  echo  '</table></td>';
echo '<td><table width="286" border="1" cellspacing="1" cellpadding="1" bordercolor="#000000" bgcolor="#FFFFFF">
				  <tr>
					<td width="75%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">HORARIO</font></td>
					<td width="10%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">#</font></td>
					<td width="15%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">TOTAL</font></td>
				  </tr>';
  foreach($sumhor as $fila6){
				  echo' <tr>
				<td><font color="#000000">'.$fila6["HORARIO"].'</font></td>
				<td><font color="#000000">'.$fila6["VISITAS"].'</font></td>
				<td><font color="#000000">'.$fila6["PORCENTAJE"].'%</font></td>
			  </tr>';
	  }
	  echo  '</table></td></tr></table> <br><br>';
?>
<table width="863" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<caption><font size=4 color="#FFFFFF">Detalle de Asistencias</font></caption>
				  <tr>
					<td width="10%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">NOMBRE</font></td>
                    <td width="10%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">CEDULA</font></td>
					<td width="8%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">FECHA</font></td>
					<td width="5%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">DIA</font></td>
					<td width="6%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">HORA</font></td>
					<td width="12%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">CATEGORIA</font></td>
					<td width="15%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">INSTITUCION</font></td>
					<td width="15%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">ESPECIALIDAD</font></td>
                    <td width="15%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">E-MAIL</font></td>
					<td width="29%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">REGISTRO</font></td>
				  </tr>
<?php 
$lisUsu=$_usua->lista_AsistenciasAcumuladas($id);
foreach($lisUsu as $fila3){
?>
 <tr>
    <td><font color="#000000"><?php echo $fila3["U.USU_NOMBRE"];?></font></td>
    <td><font color="#000000"><?php echo $fila3["U.USU_CEDULA"];?></font></td>
      <td><font color="#000000"><?php echo $fila3["DR.DET_FECHA"];?></font></td>
      <td><font color="#000000"><?php echo $fila3["DR.DET_DIA"];?></font></td>
      <td><font color="#000000"><?php echo $fila3["DET_HORA_ENTRADA"]; ?></font></td>
      <td><font color="#000000"><?php echo $fila3["C.CAT_NOMBRE"];?></font></td>
      <td><font color="#000000"><?php echo $fila3["I.INS_NOMBRE"]; ?></font></td>
      <td><font color="#000000"><?php echo $fila3["E.ESP_NOMBRE"];?></font></td>
      <td><font color="#000000"><?php echo $fila3["U.USU_MAIL"];?></font></td>
      <td><font color="#000000"><?php echo $fila3["S.SER_NOMBRE"]; ?></font></td>
    </tr>
<?php 
}
?>
<input type="hidden" name="txtid2" disabled="disabled" value="<?php echo $fila3["U.USU_CEDULA"];
$_SESSION["id2"]=$fila3["U.USU_CEDULA"];
?>" id="txtid2" />
<?php
}
?>
</table>
</form>
<?php
require("../lib/template/footer_inicio.php");
?>