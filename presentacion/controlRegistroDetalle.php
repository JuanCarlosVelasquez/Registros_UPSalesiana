<?php
require("../lib/template/header_inicio.php");
?>

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
     if($tiempo_transcurrido >= 20) {
     //si pasaron 10 minutos o mas
      session_destroy(); // destruyo la sesion
      header("Location: index.php"); //envio al usuario a la pag. de autenticacion
      //sino, actualizo la fecha de la sesion
    }else {
    $_SESSION["ultimoAcceso"] = $ahora;
   }
}

include_once"../dominio/usuario.php";
include_once"../dominio/servicio.php";
include_once"../dominio/detalleRegistro.php";

$ser=new servicio();
$datServ=$ser->lista_servicios();
$usu=new usuario();
$usucons=new usuario();
//$idUsuario=$_SESSION["idUsuario"];
$cedula=$_SESSION["cedula"];
$datosusu=$usucons->usuario_datos($cedula);
	foreach($datosusu as $fila4)
	{
		$idUsuario=$fila4["USU_ID"];
		}
?>

<?php
//funcion imprimir Registro
function imprimirRegistro(){
$usu=new usuario();
$usucons=new usuario();
$_servi=new servicio();
$deta=new detalle();
//$idUsulocal=$_SESSION["idUsuario"];
$cedulalocal=$_SESSION["cedula"];
$datosusu=$usucons->usuario_datos($cedulalocal);
	foreach($datosusu as $fila4)
	{
		$idUsulocal=$fila4["USU_ID"];
		}
if(isset($_POST["btnGuardar"]) && $_POST["cbServ"]!=-1)
{
	$NomSer="";
	$idServicio=$_POST["cbServ"];
	$datosUsu=$usu->lista_UsuarioXId($cedulalocal);
	$datosServ=$_servi->lista_serviciosXid($idServicio);
	foreach($datosServ as $fila2)
	{
		$NomSer=$fila2["SER_NOMBRE"];
		//$idServicio=$fila2["SER_ID"];
		}
	echo '<table width="500" align="center" border="1" cellspacing="1" cellpadding="1" bordercolor="#000000" bgcolor="#FFFFFF">
	<caption><font size=4 color="#FFFFFF">Registro Actual</font></caption>
	  <tr>
		<td width="14%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">FECHA</font></td>
		<td width="30%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">NOMBRE</font></td>
		<td width="12%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">HORA</font></td>
		<td width="12%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">DIA</font></td>
		<td width="32%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">SERVICIO</font></td>
	  </tr>';
	$fecha=date("d/m/Y");
	$hora=date("H:i:s");
	$dia=date("w");
switch($dia) { 
   case 0: $dia="Domingo"; 
              break; 
   case 1: $dia="Lunes"; 
              break; 
   case 2: $dia="Martes"; 
              break; 
   case 3: $dia="Mi&eacute;rcoles"; 
              break; 
   case 4: $dia="Jueves"; 
              break; 
   case 5: $dia="Viernes"; 
              break; 
   case 6: $dia="S&aacute;bado"; 
              break; 
}
			foreach($datosUsu as $fila){
				echo "<tr>
				<td><font color='#000000'>".$fecha."</font></td>
				<td><font color='#000000'>".$fila["U.USU_NOMBRE"]." ".$fila["U.USU_APELLIDO"]."</font></td>
				<td><font color='#000000'>".$hora."</font></td>
				<td><font color='#000000'>".$dia."</font></td>
				<td><font color='#000000'>".$NomSer."</font></td>
				</tr>";
					}
					echo "</table> </br>";
				$deta->guardar_detalleRegistro("INSERT INTO REGBIB_DETALLE_REGISTRO (USU_ID,SER_ID,DET_HORA_ENTRADA,DET_FECHA,DET_ESTADO,DET_DIA, USU_CEDULA) 
	VALUES($idUsulocal,$idServicio,GETDATE(),GETDATE(),'A','$dia','$cedulalocal')");
}
else{
	echo '<script language = javascript>
		alert("Por favor seleccione servicio a Utilizar")
		</script>';
	}
}

?>
<form id="form1" name="form1" method="post" action="">
<table width="843" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<caption><font size=4 color="#FFFFFF">Datos Personales</font></caption>
  <tr>
 <?php 
  $DatosUsuario=$usu->lista_UsuarioXId($cedula);
  foreach($DatosUsuario as $fila){
?>
    <td width="70" bgcolor="#0088AD"><label for="txtNombre"><font size=2 color="#FFFFFF">NOMBRE</font></label>
     </td>
    <td width="200"><font color="#000000"><?php echo $fila["U.USU_NOMBRE"]?></font></td>
    <td width="70" bgcolor="#0088AD"><font size=2 color="#FFFFFF">DIRECCION</font></td>
    <td width="200"><font color="#000000"><?php echo $fila["U.USU_DIRECCION"]?></font></td>
    <td width="70" bgcolor="#0088AD"><font size=2 color="#FFFFFF">ESPECIALIDAD</font></td>
    <td width="233"><font color="#000000"><?php echo $fila["E.ESP_NOMBRE"]?></font></td>
  </tr>
  <tr>
    <td bgcolor="#0088AD"><font size=2 color="#FFFFFF">APELLIDO</font></td>
    <td><font color="#000000"><?php echo $fila["U.USU_APELLIDO"]?></font></td>
    <td bgcolor="#0088AD"><font size=2 color="#FFFFFF">CATEGORIA</font></td>
    <td><font color="#000000"><?php echo $fila["C.CAT_NOMBRE"]?></font></td>
	<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">E-MAIL</font></td>
    <td><font color="#000000"><?php echo $fila["U.USU_MAIL"]?></font></td>
    <label for="cbxServicios"></label>
  </tr>
  <tr>
    <td bgcolor="#0088AD"><font size=2 color="#FFFFFF">TELEFONO</font></td>
    <td><font color="#000000"><?php echo $fila["U.USU_TELEFONO"]?></font></td>
    <td bgcolor="#0088AD"><font size=2 color="#FFFFFF">INSTITUCION</font></td>
    <td><font color="#000000"><?php echo $fila["I.INS_NOMBRE"]?></font></td>
    <td bgcolor="#0088AD"><font size=2 color="#FFFFFF">SERVICIO</font></td>
    <td><label>
        <select name="cbServ" id="cboServ" >
		<option value="-1">ELIJA UNA OPCION</option>
		<?php
		
		foreach($datServ as $fila)
		{
		$c = $fila["SER_ID"];
		$n = $fila["SER_NOMBRE"];
			echo "<option value=$c>$n</option>";
		}
		?>
        </select>
      </label></td>
  </tr>
<?php }?>
</table>
<br>
<?php imprimirRegistro();?>
<br>
<br>
<div id="divBoton" ><div align="center"><input type="submit" name="btnGuardar" value="Registrar Asistencia" ></div></div>
<br>
<br>
<?php
$id=$cedula;
$usu1=new usuario();
$usu2=new usuario();
$usu3=new usuario();
$sumser=$usu1->resumen_visitasporservicio($id);
$sumdia=$usu2->resumen_visitaspordia($id);
$sumhor=$usu3->resumen_visitasporhorario($id);
echo '<table border="0" align="center"><caption><font size=4 color="#FFFFFF">Resumen de Asistencia</font></caption><tr>
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
	  echo  '</table></td></tr></table> <br>';
?>
  <table width="920" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
  <caption><font size=4 color="#FFFFFF">Cuadro de Asistencias Acumuladas</font></caption>
    <tr>
      <td width="150" bgcolor="#0088AD"><font size=2 color="#FFFFFF">NOMBRE</font></td>
      <td width="59" bgcolor="#0088AD"><font size=2 color="#FFFFFF">FECHA</font></td>
      <td width="50" bgcolor="#0088AD"><font size=2 color="#FFFFFF">DIA</font></td>
      <td width="50" bgcolor="#0088AD"><font size=2 color="#FFFFFF">HORA</font></td>
      <td width="70" bgcolor="#0088AD"><font size=2 color="#FFFFFF">CATEGORIA</font></td>
      <td width="145" bgcolor="#0088AD"><font size=2 color="#FFFFFF">IINSTITUCION</font></td>
      <td width="193" bgcolor="#0088AD"><font size=2 color="#FFFFFF">ESPECIALIDAD</font></td>
      <td width="145" bgcolor="#0088AD"><font size=2 color="#FFFFFF">REGISTRO</font></td>
    </tr>
    <?php
    $datUsu=$usu->lista_AsistenciasAcumuladasxUsr($cedula);
	foreach($datUsu as $fila3){
	?>
    <tr>
    <td><font color="#000000"><?php echo $fila3["U.USU_NOMBRE"]." ".$fila3["U.USU_APELLIDO"];?></font></td>
      <td><font color="#000000"><?php echo $fila3["DR.DET_FECHA"];?></font></td>
      <td><font color="#000000"><?php echo $fila3["DR.DET_DIA"];?></font></td>
      <td><font color="#000000"><?php echo $fila3["DET_HORA_ENTRADA"]; ?></font></td>
      <td><font color="#000000"><?php echo $fila3["C.CAT_NOMBRE"];?></font></td>
      <td><font color="#000000"><?php echo $fila3["I.INS_NOMBRE"]; ?></font></td>
      <td><font color="#000000"><?php echo $fila3["E.ESP_NOMBRE"];?></font></td>
      <td><font color="#000000"><?php echo $fila3["S.SER_NOMBRE"]; ?></font></td>
      </tr>
   <?php }?>
  </table>
</form>

<?php
require("../lib/template/footer_inicio.php");
?>