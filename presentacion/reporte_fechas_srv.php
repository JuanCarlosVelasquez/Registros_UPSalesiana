<?php
 if(isset($_POST["btnReporte"])){
	header("Location:index_excel_fechas_srv.php"); }
?>
<html>
<head>
<title>Sistema Registro UPS</title>
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
include_once"../dominio/servicio.php";
$_usua=new usuario();
$usu1=new usuario();
$usu2=new usuario();
$usu3=new usuario();
$ser=new servicio();
$datServ=$ser->lista_servicios();
?>
<form id="form1" name="form1" method="post" action="">
<caption><font size=4 color="#FFFFFF">Escoja Tipo Registro, Fecha Y Hora:</font></caption>
<table width="345" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<tr>
<td width="60%" bgcolor="#0088AD"><font color="#FFFFFF" size="3">Tipo:</font></td>
<td width="40%"><label><select name="cbServ" id="cboServ" ><option value="-1">ELIJA UNA OPCION</option><option value="%">TODOS</option><?php 		
		foreach($datServ as $fila)
		{
		$c = $fila["SER_ID"];
		$n = $fila["SER_NOMBRE"];
			echo "<option value=$c>$n</option>";
		}
		?> </select></label></td>
</tr>
<tr>
<td width="60%" bgcolor="#0088AD"><font color="#FFFFFF" size="3">Desde:</font><font color="#FFFFFF" size="2">[DD/MM/AAAA]</font></td>
<td width="40%"><input type="date" name="fecha1" maxlength="10"/></td>
</tr>
<tr>
<td width="60%" bgcolor="#0088AD"><font color="#FFFFFF" size="3">Hasta:</font><font color="#FFFFFF" size="2">[DD/MM/AAAA]</font></td>
<td width="40%"><input type="date" name="fecha2" maxlength="10"></td>
</tr>
<tr>
<td width="60%" bgcolor="#0088AD"><font color="#FFFFFF" size="3">Desde:</font><font color="#FFFFFF" size="2">[HH(24H):MM:SS]</font></td>
<td width="40%"><input type="time" name="hora1" maxlength="8"/></td>
</tr>
<td width="60%" bgcolor="#0088AD"><font color="#FFFFFF" size="3">Hasta:</font><font color="#FFFFFF" size="2">[HH(24H):MM:SS]</font></td>
<td width="40%"><input type="time" name="hora2" maxlength="8"></td>
</tr>
<td width="60%"><div align="center"><input type="submit" name="btnBuscar" id="btnBuscar" value="Buscar"/></div></td>
<td width="40%"><div align="center"><input type="submit" value="Excel" name="btnReporte" id="btnReporte"/></div></td>
</tr>
</table>
<br>
<br>
<?php 
if(isset($_POST["btnBuscar"])){
$servicio=$_POST["cbServ"];
if ($servicio == -1){
		echo '<script language = javascript>
		alert("Por favor seleccione servicio a Utilizar")
		</script>'; }
$fecha1=$_POST["fecha1"];
$fecha2=$_POST["fecha2"];
$hora1=$_POST["hora1"];
$hora2=$_POST["hora2"];
if ($fecha1=="") {
  $fecha1="2010-01-01";
}
if ($fecha2=="") {
  $fecha2="2050-12-31";
}
if ($hora1=="") {
  $hora1="00:00:00";
}
if ($hora2=="") {
  $hora2="23:59:59";
}
if ($servicio=="" OR $servicio == -1) {
	$servicio = '%';
}
$_SESSION["servicio"]=$_POST["cbServ"];
$_SESSION["fecha1"]=$fecha1;
$_SESSION["fecha2"]=$fecha2;
$_SESSION["hora1"]=$hora1;
$_SESSION["hora2"]=$hora2;

$sumser=$usu1->resumen_viservfecser($fecha1, $fecha2, $hora1, $hora2, $servicio);
$sumdia=$usu2->resumen_visitaspordiafecser($fecha1, $fecha2, $hora1, $hora2, $servicio);
$sumhor=$usu3->resumen_visitasporhorfecser($fecha1, $fecha2, $hora1, $hora2, $servicio);
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
					<td width="10%" bgcolor="#0088AD"><font size=4 color="#FFFFFF">NOMBRE</font></td>
                    <td width="10%" bgcolor="#0088AD"><font size=4 color="#FFFFFF">CEDULA</font></td>
					<td width="8%" bgcolor="#0088AD"><font size=4 color="#FFFFFF">FECHA</font></td>
					<td width="5%" bgcolor="#0088AD"><font size=4 color="#FFFFFF">DIA</font></td>
					<td width="6%" bgcolor="#0088AD"><font size=4 color="#FFFFFF">HORA</font></td>
					<td width="12%" bgcolor="#0088AD"><font size=4 color="#FFFFFF">CATEGORIA</font></td>
					<td width="15%" bgcolor="#0088AD"><font size=4 color="#FFFFFF">INSTITUCION</font></td>
					<td width="15%" bgcolor="#0088AD"><font size=4 color="#FFFFFF">ESPECIALIDAD</font></td>
                    <td width="15%" bgcolor="#0088AD"><font size=4 color="#FFFFFF">E-MAIL</font></td>
					<td width="29%" bgcolor="#0088AD"><font size=4 color="#FFFFFF">REGISTRO</font></td>
				  </tr>
<?php 
$lisUsu=$_usua->lista_AsistenciasAcumuladasFechasServicio($fecha1, $fecha2, $hora1, $hora2, $servicio);
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
}
?>
</table>
</form>
<?php
require("../lib/template/footer_inicio.php");
?>